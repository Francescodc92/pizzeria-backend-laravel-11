<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $searchStatus = $request->query('status');

        $query = Order::orderBy('order_date', 'DESC');

        if (!empty($searchStatus)) {
            $query->where('status', 'like' ,'%' . $searchStatus . '%');
        }

        $orders = $query->paginate(10);

        $orders->appends(['status' => $searchStatus]);

        return view('admin.order.index', compact('orders', 'searchStatus'));
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
