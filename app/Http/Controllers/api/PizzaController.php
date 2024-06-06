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
        $pizzas = Pizza::where('available','!=', 0)->orderByDesc('discount_percent')->paginate(8);

        return PizzaResource::collection($pizzas);
    }

    public function pizzasWithDiscount()
    {
        $pizzas = Pizza::where('discount_percent', '>', 0)->get();  

        return PizzaResource::collection($pizzas);
    }
    
    public function show(Pizza $pizza){
        if($pizza->available == 0){
            abort(404);
        }
        return new PizzaResource($pizza);
    }
}
