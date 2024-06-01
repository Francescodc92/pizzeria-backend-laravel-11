<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Http\Resources\api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return  new  UserResource($user);
        }

        return response()->json(['error' => 'Le credenziali inserite non sono corrette!'], 400);
    }

    public function register(RegisterUserRequest $request)
    {
        User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ])->assignRole('user');

        return response()->json(['message' => 'Utente creato con successo!'], 201);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout effettuato con successo!'], 200);
    }

    public function user(Request $request)
    {
        $user = Auth::user();
        return  new  UserResource($user);
    }

}
