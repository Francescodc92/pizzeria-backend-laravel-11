<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserAddressRequest;
use App\Http\Resources\api\UserResource;

class UserController extends Controller
{
    public function updateUserAddress(UserAddressRequest $request)
    {
        $newAddress = $request;
        $user = auth()->user();

        $userAddress = $user->addresses()->where([
            ['road', $newAddress['road']],
            ['city', $newAddress['city']],
            ['country', $newAddress['country']],
            ['zip_code', $newAddress['zip_code']]
        ])->first();

        if ($userAddress == null) {
            $userAddress = $user->addresses()->create([
                'road' => $newAddress['road'],
                'city' => $newAddress['city'],
                'country' => $newAddress['country'],
                'zip_code' => $newAddress['zipCode']
            ]);
        }

        return new UserResource($user);
    }
}
