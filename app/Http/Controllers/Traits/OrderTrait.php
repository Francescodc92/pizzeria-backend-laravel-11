<?php

namespace App\Http\Controllers\Traits;
use App\Models\Order;
use Illuminate\Http\Request;

trait OrderTrait
{
    public function index(Request $request)
    {
        $searchStatus = $request->query('status');
        $orderBy = $request->query('orderBy', 'DESC');

        
        $query = Order::orderBy('order_date', $orderBy);

        if (!empty($searchStatus)) {
            $query->where('status', 'like' ,'%' . $searchStatus . '%');
        }

        $orders = $query->paginate(10);

        $orders->appends(['status' => $searchStatus, 'orderBy' => $orderBy]);

        return view($this->getViewPrefix() .'.order.index', compact('orders'));
    }

    public function show(Order $order)
    {

        return view( $this->getViewPrefix() . '.order.show', compact('order'));
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

    protected abstract function getViewPrefix();
}
