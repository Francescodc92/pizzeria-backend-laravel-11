<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserAddressRequest;
use App\Http\Resources\api\UserResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function updateUserAddress(UserAddressRequest $request)
    {
        $newAddress = $request->validated();
        $user = Auth::user()->load('addresses');

        $userAddress = $user->addresses()->where([
            ['road', $newAddress['road']],
            ['city', $newAddress['city']],
            ['country', $newAddress['country']],
            ['zip_code', $newAddress['zipCode']]
        ])->first();

        if ($userAddress === null) {
            $userAddress = $user->addresses()->create([
                'road' => $newAddress['road'],
                'city' => $newAddress['city'],
                'country' => $newAddress['country'],
                'zip_code' => $newAddress['zipCode']
            ]);
        } else { 
            return response()->json(['message' => 'Indirizzo esistente'], 400);
        }

        $user->load('addresses');

        return new UserResource($user);
    }

    public function deleteUserAddress($addressId)
    {
        $user = Auth::user()->load('addresses');

        $userAddress = $user->addresses()->whereId($addressId)->get()->first();

        if ($userAddress) {
            $userAddress->delete();
            return response()->json(['message' => 'Indirizzo eliminato'], 200);
        } else {
            return response()->json(['message' => 'Indirizzo non trovato'], 404);
        }
    }
}

