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
        $orders = Order::orderBy('order_date', 'DESC')->paginate(10);

        $orders->load('user', 'pizzas');

        foreach ($orders as $order) {
            foreach ($order->pizzas as $pizza) {
                $pizza['quantity'] = $pizza->pivot->quantity;
                unset($pizza['pivot']);
            }
        }
    
        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('pizzas', 'user', 'address');


        return view('admin.order.show', compact('order'));
    }
}
