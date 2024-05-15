<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::inRandomOrder()->get();

       foreach ($users as $user) {

            $randomNumberOrders = rand(1, 5);
            $statuses = ['pending', 'processing', 'shipped', 'completed'];

            for ($i = 0; $i < $randomNumberOrders; $i++) {
                $userAddresses = $user->addresses;
                $userAddress = $userAddresses->random();
                $status = $statuses[array_rand($statuses)];

                $orderPrice = rand(10, 100);

                $order = new Order([
                    'user_id' => $user->id,
                    'address_id' => $userAddress->id,
                    'order_date' => now(),
                    'status' => $status,
                    'order_price' => $orderPrice,
                ]);
 
                $order->save();
            }

       }

    }
}
