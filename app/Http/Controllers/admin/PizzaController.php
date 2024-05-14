<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pizza;
use Illuminate\Http\Request;


class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::paginate(8);

        $pizzas->each(function ($pizza) {
            $price_after_discount = $pizza->price;
    
            if ($pizza->discount_percent) {
                $price_after_discount = $pizza->price - ($pizza->price * $pizza->discount_percent / 100);
            }
    
            $pizza->price_after_discount = $price_after_discount;
        });


        return view('admin.pizza.index', compact('pizzas'));
    }
}
