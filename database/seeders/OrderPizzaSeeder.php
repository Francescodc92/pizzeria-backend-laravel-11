<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderPizza;
use App\Models\Pizza;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderPizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $orders = Order::all();
        $pizzas = Pizza::all();

        foreach ($orders as $order) {
            $numberOfPizzas = rand(1, 5);

            for ($i = 0; $i < $numberOfPizzas; $i++) {
                $pizza = $pizzas->random();

                $quantity = rand(1, 3);

                $orderPizza = new OrderPizza([
                    'pizza_id' => $pizza->id,
                    'quantity' => $quantity,
                ]);

                $order->orderPizzas()->save($orderPizza);
            }
        }
    }
}
