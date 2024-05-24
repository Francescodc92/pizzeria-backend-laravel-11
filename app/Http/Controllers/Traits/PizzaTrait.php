<?php

namespace App\Http\Controllers\Traits;

use App\Models\Pizza;

trait PizzaTrait
{
    public function index()
    {
        $pizzas = Pizza::paginate(8);

        return view($this->getViewPrefix() .'.pizza.index', compact('pizzas'));
    }

    public function show(Pizza $pizza)
    {
        return view($this->getViewPrefix() .'.pizza.show', compact('pizza'));
    }

    protected abstract function getViewPrefix();
}
