<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderPizza;
use App\Models\Pizza;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderPizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $users = User::inRandomOrder()->get();
        $statuses = ['pending', 'processing', 'shipped', 'completed'];
        $totalOrders = 0;
        $minTotalOrders = 1000;

        while ($totalOrders < $minTotalOrders) {
            foreach ($users as $user) {
                $randomNumberOrders = rand(2, 3);

                for ($i = 0; $i < $randomNumberOrders; $i++) {
                    $userAddresses = $user->addresses;
                    $userAddress = $userAddresses->random();
                    $status = $statuses[array_rand($statuses)];

                    $order = new Order([
                        'user_id' => $user->id,
                        'address_id' => $userAddress->id,
                        'order_date' => Carbon::now()->subDays(rand(0, 1460)), // From today to 4 years ago
                        'status' => $status,
                        'order_price' => 0, 
                    ]);

                    $order->save();

                    $numberOfPizzas = rand(2, 5);
                    $pizzaIds = Pizza::all()->random($numberOfPizzas)->pluck('id');

                    $order->pizzas()->attach($pizzaIds, ['quantity' => rand(1, 3)]);

                    $orderPrice = 0;

                    foreach ($order->pizzas as $pizza) {
                        $discountPercent = $pizza->discount_percent; 
                        $discountAmount = $pizza->price * ($discountPercent / 100);

                        $orderPrice += $pizza->pivot->quantity * ($pizza->price - $discountAmount);
                    }

                    $order->update(['order_price' => number_format($orderPrice, 2)]);
                    
                    $totalOrders++;

                    if ($totalOrders >= $minTotalOrders) {
                        break 2;
                    }
                }
            }
        }
    }
}
