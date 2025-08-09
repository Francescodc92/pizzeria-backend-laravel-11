<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\MakePaymentRequest;
use App\Http\Resources\api\OrderResource;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\User;
use Braintree\Gateway;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function generateFrontToken(Gateway $gateway)
    {
        $token = $gateway->ClientToken()->generate();
        $data = [
            'token' => $token
        ];

        return response()->json($data);
    }

    public function makePayment(MakePaymentRequest $request, Gateway $gateway)
    {

        $pizzasArray = $request->pizzas;
        $requestAddress = $request->userAddress;

        $amount = 0;

        $user = User::where('id', Auth::user()->id)->with('addresses')->firstOrFail();

        $userAddress = $user->addresses()->whereId($requestAddress['id'])->get()->first();


        if ($userAddress === null) {
            return response()->json(['success' => false, 'message' => 'Indirizzo non trovato'], 400);
        }

        foreach ($pizzasArray as $pizzaReq) {
            $pizzaIndex = $pizzaReq['pizza'];
            $quantity = $pizzaReq['quantity'];
            $pizza = Pizza::find($pizzaIndex);

            if ($pizza === null) {
                return response()->json(['success' => false, 'message' => 'Pizza non trovata'], 400);
            }

            $amount += $pizza->price_after_discount * $quantity;
        }

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if (!$result->success) {
            $errorMessages = $result->message;
            if (isset($result->errors)) {
                foreach ($result->errors->deepAll() as $error) {
                    $errorMessages .= ' ' . $error->message;
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'Errore nell\'esecuzione della transazione: ' . $errorMessages
            ], 401);
        }

        $order = new Order([
            'user_id' => $user->id,
            'address_id' => $userAddress->id,
            'order_price' => $amount,
        ]);

        $order->save();

        foreach ($pizzasArray as $pizzaReq) {
            $pizzaIndex = $pizzaReq['pizza'];
            $quantity = $pizzaReq['quantity'];

            $order->pizzas()->attach($pizzaIndex, ['quantity' => $quantity]);
        }

        $data = [
            'success' => true,
            'message' => 'Transazione eseguita con successo',
            'transaction' => [
                'id' => $result->transaction->id,
                'amount' => $result->transaction->amount,
                'status' => $result->transaction->status,
                'created_at' => $result->transaction->createdAt->format('Y-m-d H:i:s')
            ]
        ];

        return response()->json($data, 200);
    }

    public function getUserOrders()
    {
        $userOrders = User::findOrFail(Auth::id())
            ->orders()
            ->with(['address' => function ($query) {
                $query->withTrashed();
            }, 'pizzas'])
            ->orderByDesc('order_date')
            ->paginate(10);

        return OrderResource::collection($userOrders);
    }

    public function stripeIntentPayment(MakePaymentRequest $request)
    {
        $pizzasArray = $request->pizzas;
        $requestAddress = $request->userAddress;
        $user = User::where('id', Auth::user()->id)->with('addresses')->firstOrFail();

        $userAddress = $user->addresses()->whereId($requestAddress['id'])->get()->first();


        if ($userAddress === null) {
            return response()->json(['error' => 'Indirizzo non trovato'], 400);
        }

        $amount = 0;
        $lineItems = [];
        foreach ($pizzasArray as $pizzaReq) {
            $pizzaId = $pizzaReq['pizza'];
            $quantity = $pizzaReq['quantity'];
            $pizza = Pizza::find($pizzaId);

            if (!$pizza) {
                return response()->json(['error' => "Pizza con ID $pizzaId non trovata"], 400);
            }

            $amount += $pizza->price_after_discount * $quantity;

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $pizza->name,
                    ],
                    'unit_amount' => intval($pizza->price_after_discount * 100)
                ],
                'quantity' => $quantity,
            ];
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => $lineItems,
            'success_url' => env('FRONTEND_URL') . '/checkout/success/{CHECKOUT_SESSION_ID}',
            'cancel_url' => env('FRONTEND_URL') . '/checkout/cancel',
            'payment_intent_data' => [
                'metadata' => [
                    'user_id' => $user->id,
                    'address_id' => $userAddress->id,
                    'cart' => json_encode($pizzasArray),
                    'cart_amount' => $amount
                ]
            ]
        ]);

        return response()->json(['session_id' => $session->id], 200);
    }


    public function stripeWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET'); // Impostalo nel .env!

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endpointSecret
            );
        } catch (SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        } catch (\UnexpectedValueException $e) {
            return response('Invalid payload', 400);
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $metadata = $paymentIntent->metadata;


                $order = new Order([
                    'user_id' => $metadata->user_id,
                    'address_id' => $metadata->address_id,
                    'order_price' => $metadata->cart_amount,
                ]);

                $order->save();

                $cart = json_decode($metadata->cart, true);
                foreach ($cart as $cart_item) {
                    $pizzaIndex = $cart_item['pizza'];
                    $quantity = $cart_item['quantity'];

                    $order->pizzas()->attach($pizzaIndex, ['quantity' => $quantity]);
                }

                break;

            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                $errorMessage = $paymentIntent->last_payment_error ? $paymentIntent->last_payment_error->message : 'Errore di pagamento sconosciuto';
                Log::error('Pagamento fallito: ' . $paymentIntent->id . ' Errore: ' . $errorMessage);
                break;


            default:
                break;
        }

        return response('', 200);
    }
}
