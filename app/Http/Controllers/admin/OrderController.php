<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderPizza;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('pizzas')->get(); // Eager load pizzas with orders

        // Opzionale: convertire la collezione in array
        foreach ($orders as $order) {
            foreach ($order->pizzas as $pizza) {
                $pizza['quantity'] = $pizza->pivot->quantity;
                unset($pizza['pivot']);
            }
        }

        $orderPizzaArray = $orders->toArray();
        
        dd($orderPizzaArray);

        
    return;
    }
}
