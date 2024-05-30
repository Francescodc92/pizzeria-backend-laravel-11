<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\PizzaResource;
use App\Models\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::where('available','!=', 0)->orderByDesc('discount_percent')->paginate(10);

        return PizzaResource::collection($pizzas);
    }

    public function pizzasWithDiscount()
    {
        $pizzas = Pizza::where('discount_percent', '>', 0)->paginate(10);  

        return PizzaResource::collection($pizzas);
    }
    
    public function show(Pizza $pizza){
        return new PizzaResource($pizza);
    }
}
