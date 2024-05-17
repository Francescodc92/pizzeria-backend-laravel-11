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
        
        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {

        return view('admin.order.show', compact('order'));
    }

    public function update()
    {
        dd('ci sono');
    }
}
