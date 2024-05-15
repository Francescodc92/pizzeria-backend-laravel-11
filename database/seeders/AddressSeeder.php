<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        
        foreach ($users as $user) {

            $numberAddresses = rand(1, 3);

            for($i = 0; $i < $numberAddresses; $i++){
                Address::create([
                    'user_id' => $user->id,
                    'road' => fake()->streetAddress(),
                    'city' => fake()->city(),
                    'country' => fake()->country(),
                    'zip_code' => fake()->postcode()
                ]);
                
            }
            
        }
    }
}
