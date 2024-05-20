<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\User;
use Braintree\Gateway;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function generateFrontToken( Gateway $gateway)
    {
        $token = $gateway->ClientToken()->generate();
        $data= [
            'token' => $token
        ];

        return response()->json($data);
    }

    // todo create OrderRequest
    public function makePayment(Request $request, Gateway $gateway)
    {

        $pizzasArray = $request->pizzas;
        $requestAddress = $request->userAddress;  // deve essere un array [road, city, country, zip_code]
        $amount = 0;


        $user = User::find(1); // cambiare con lo user autenticato appena fatto il login da api
        // $user = auth()->user();
        $userAddress = $user->addresses()->where([
            ['road', $requestAddress['road']],
            ['city', $requestAddress['city']],
            ['country', $requestAddress['country']],
            ['zip_code', $requestAddress['zip_code']]
        ])->first();

        if ($userAddress == null) {
            $userAddress = $user->addresses()->create([
                'road' => $requestAddress['road'],
                'city' => $requestAddress['city'],
                'country' => $requestAddress['country'],
                'zip_code' => $requestAddress['zip_code']
            ]);
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

}
