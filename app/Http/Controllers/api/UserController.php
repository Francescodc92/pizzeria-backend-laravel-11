<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserAddressRequest;
use App\Http\Resources\api\UserResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function createUserAddress(UserAddressRequest $request)
    {
        $newAddress = $request->validated();
        $user = User::where('id', Auth::user()->id)->with('addresses')->firstOrFail();

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
        $user = User::where('id', Auth::user()->id)->with('addresses')->firstOrFail();

        $userAddress = $user->addresses()->where('id', $addressId)->first();

        if ($userAddress) {
            $userAddress->delete();
            return response()->json(['message' => 'Indirizzo eliminato'], 200);
        } else {
            return response()->json(['message' => 'Indirizzo non trovato'], 404);
        }
    }
}

