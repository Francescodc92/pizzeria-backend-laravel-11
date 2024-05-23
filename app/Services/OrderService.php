<?php

namespace App\Services;

use App\Models\Order;
use Carbon\Carbon;

class OrderService
{
    public function getOrdersLastWeek($today)
    {
        $dateLastWeek = $today->copy()->subDays(6);
        $ordersLastWeek = Order::whereBetween('order_date', [$dateLastWeek->startOfDay(), $today->endOfDay()])->get();

        $ordersCountByDayLastWeek = $ordersLastWeek->groupBy(function ($order) {
            return Carbon::parse($order->order_date)->format('Y-m-d');
        })->map(function ($dayOrders) {
            return $dayOrders->count();
        });
    
        $ordersPerDayLastWeek = [];
    
        for ($date = $dateLastWeek->copy(); $date->lte($today); $date->addDay()) {
            $dateString = $date->format('Y-m-d');
            $dayName = $date->locale('it')->dayName;
            $ordersPerDayLastWeek[$dayName] = $ordersCountByDayLastWeek->get($dateString, 0);
        }

    
        return $ordersPerDayLastWeek;
    }

    public function getOrdersThisMonth($today)
    {
        $dateStartOfMonth = $today->copy()->startOfMonth();
        $ordersThisMonth = Order::whereBetween('order_date', [$dateStartOfMonth, $today])->get();
    
        $ordersCountByDayThisMonth = $ordersThisMonth->groupBy(function ($order) {
            return Carbon::parse($order->order_date)->format('Y-m-d');
        })->map(function ($dayOrders) {
            return $dayOrders->count();
        });
    
        $ordersPerDayThisMonth = [];
        for ($date = $dateStartOfMonth->copy(); $date->lte($today); $date->addDay()) {
            $dateString = $date->format('Y-m-d');
            $formattedDate = $date->format('d-m');
            $ordersPerDayThisMonth[$formattedDate] = $ordersCountByDayThisMonth->get($dateString, 0);
        }

        return $ordersPerDayThisMonth;
    }

    public function getOrdersLastYear($today)
    {
        $dateStartOfYear = $today->copy()->startOfYear();
        $ordersThisYear = Order::whereBetween('order_date', [$dateStartOfYear, $today])->get();
    
        $ordersCountByMonth = $ordersThisYear->groupBy(function ($order) {
            return Carbon::parse($order->order_date)->format('F');
        })->map(function ($monthOrders) {
            return $monthOrders->count();
        });
    
        $ordersPerMonth = [];
        for ($month = $dateStartOfYear->copy(); $month->lte($today); $month->addMonth()) {
            $monthString = $month->format('F');
            $ordersPerMonth[$monthString] = $ordersCountByMonth->get($monthString, 0);
        }

        return $ordersPerMonth;
    }

    public function getOrdersLastFiveYears($today)
    {
        $dateStartOfLastFiveYears = $today->copy()->subYears(5)->startOfYear();
        $ordersLastFiveYears = Order::whereBetween('order_date', [$dateStartOfLastFiveYears, $today])->get();

        $ordersCountByYear = $ordersLastFiveYears->groupBy(function ($order) {
            return Carbon::parse($order->order_date)->format('Y');
        })->map(function ($yearOrders) {
            return $yearOrders->count();
        });

        $ordersPerYear = [];
        for ($year = $dateStartOfLastFiveYears->copy(); $year->lte($today); $year->addYear()) {
            $yearString = $year->format('Y');
            $ordersPerYear[$yearString] = $ordersCountByYear->get($yearString, 0);
        }

        return $ordersPerYear;
    }

    // Funzioni per la somma dell'order_price
    public function getOrderPriceSumLastWeek($today)
    {
        $dateLastWeek = $today->copy()->subDays(6);
        $ordersLastWeek = Order::whereBetween('order_date', [$dateLastWeek, $today])->get();

        $orderPriceSumByDay = $ordersLastWeek->groupBy(function ($order) {
            return Carbon::parse($order->order_date)->format('Y-m-d');
        })->map(function ($dayOrders) {
            return $dayOrders->sum('order_price');
        });

        $orderPriceSumPerDay = [];
        for ($date = $dateLastWeek->copy(); $date->lte($today); $date->addDay()) {
            $dateString = $date->format('Y-m-d');
            $dayName = $date->locale('it')->dayName;
            $orderPriceSumPerDay[$dayName] = $orderPriceSumByDay->get($dateString, 0);
        }

        return $orderPriceSumPerDay;
    }

    public function getOrderPriceSumThisMonth($today)
    {
        $dateStartOfMonth = $today->copy()->startOfMonth();
        $ordersThisMonth = Order::whereBetween('order_date', [$dateStartOfMonth, $today])->get();

        $orderPriceSumByDay = $ordersThisMonth->groupBy(function ($order) {
            return Carbon::parse($order->order_date)->format('Y-m-d');
        })->map(function ($dayOrders) {
            return $dayOrders->sum('order_price');
        });

        $orderPriceSumPerDay = [];
        for ($date = $dateStartOfMonth->copy(); $date->lte($today); $date->addDay()) {
            $dateString = $date->format('Y-m-d');
            $formattedDate = $date->format('d-m');
            $orderPriceSumPerDay[$formattedDate] = $orderPriceSumByDay->get($dateString, 0);
        }

        return $orderPriceSumPerDay;
    }

    public function getOrderPriceSumLastYear($today)
    {
        $dateStartOfYear = $today->copy()->startOfYear();
        $ordersThisYear = Order::whereBetween('order_date', [$dateStartOfYear, $today])->get();

        $orderPriceSumByMonth = $ordersThisYear->groupBy(function ($order) {
            return Carbon::parse($order->order_date)->locale('it')->monthName;
        })->map(function ($monthOrders) {
            return $monthOrders->sum('order_price');
        });

        $orderPriceSumPerMonth = [];
        for ($month = $dateStartOfYear->copy(); $month->lte($today); $month->addMonth()) {
            $monthString = $month->locale('it')->monthName;
            $orderPriceSumPerMonth[$monthString] = $orderPriceSumByMonth->get($monthString, 0);
        }

        return $orderPriceSumPerMonth;
    }

    public function getOrderPriceSumLastFiveYears($today)
    {
        $dateStartOfFiveYears = $today->copy()->subYears(5)->startOfYear();
        $ordersLastFiveYears = Order::whereBetween('order_date', [$dateStartOfFiveYears, $today])->get();

        $orderPriceSumByYear = $ordersLastFiveYears->groupBy(function ($order) {
            return Carbon::parse($order->order_date)->format('Y');
        })->map(function ($yearOrders) {
            return $yearOrders->sum('order_price');
        });

        $orderPriceSumPerYear = [];
        for ($year = $dateStartOfFiveYears->copy(); $year->lte($today); $year->addYear()) {
            $yearString = $year->format('Y');
            $orderPriceSumPerYear[$yearString] = $orderPriceSumByYear->get($yearString, 0);
        }

        return $orderPriceSumPerYear;
    }
}