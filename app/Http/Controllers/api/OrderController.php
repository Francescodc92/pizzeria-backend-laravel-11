<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\MakePaymentRequest;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\User;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function generateFrontToken(Gateway $gateway)
    {
        $token = $gateway->ClientToken()->generate();
        $data= [
            'token' => $token
        ];

        return response()->json($data);
    }

    // todo create OrderRequest
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
        $user = User::where('id', Auth::user()->id)->with('orders')->firstOrFail();

        $data = $user->orders;

        return response()->json($data, 200);
    }

}
