<?php

namespace Database\Seeders;

use App\Models\Pizza;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Pizza::truncate();
        });

        $pizzas = config('data_pizzas');

        foreach ($pizzas as $pizzaElement) {
            $pizza = new Pizza();
            $pizza->name = $pizzaElement['name'];
            $pizza->image = $pizzaElement['image'];
            $pizza->description = $pizzaElement['description'];
            $pizza->price = $pizzaElement['price'];
            $pizza->discount_percent = $pizzaElement['discount_percent'];
            $pizza->available = $pizzaElement['available'];

            $pizza->save();
        }
    }
}
