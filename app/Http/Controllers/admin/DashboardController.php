<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {   $today = Carbon::now();
        // Ottieni il numero di ordini
        $ordersPerDayLastWeek = $this->orderService->getOrdersLastWeek($today);
        $ordersPerDayThisMonth = $this->orderService->getOrdersThisMonth($today);
        $ordersPerMonth = $this->orderService->getOrdersLastYear($today);
        $ordersLastFiveYears = $this->orderService->getOrdersLastFiveYears($today);

        // Ottieni la somma dell'order_price
        $orderPriceSumPerDayLastWeek = $this->orderService->getOrderPriceSumLastWeek($today);
        $orderPriceSumPerDayThisMonth = $this->orderService->getOrderPriceSumThisMonth($today);
        $orderPriceSumPerMonth = $this->orderService->getOrderPriceSumLastYear($today);
        $ordersPriceLastFiveYears = $this->orderService->getOrderPriceSumLastFiveYears($today);

        return view('admin.dashboard.index', compact(
            'ordersPerDayLastWeek', 
            'ordersPerDayThisMonth', 
            'ordersPerMonth', 
            'ordersLastFiveYears',
            'orderPriceSumPerDayLastWeek',
            'orderPriceSumPerDayThisMonth',
            'orderPriceSumPerMonth',
            'ordersPriceLastFiveYears'
        ));
    }
}
