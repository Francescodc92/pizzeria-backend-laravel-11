<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed',
        ]);

        try {
            $order->update($request->only('status'));

            return back()->with('message', 'Ordine modificato con successo!');
        } catch (\Exception $e) {
            return back()->with('error', 'Si è verificato un errore durante l\'aggiornamento dell\'ordine.');
        }
    }
}
