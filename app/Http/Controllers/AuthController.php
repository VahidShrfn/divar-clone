<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = AuthService::make()
            ->setName($request->name)
            ->setEmail($request->email)
            ->setPassword($request->password)
            ->setAddressId($request->address_id)
            ->setPhoneNumber($request->phone_number)
            ->register();
        return response()
            ->json([
                'data' => $user,
                'message' => 'Register successfully'
            ],201);
    }
    public function login(LoginRequest $request)
    {
        $user = AuthService::make()
            ->setEmail($request->email)
            ->setPassword($request->password)
            ->login();
        return response()
            ->json([
                'data' => $user,
                'message' => 'Login successfully'
            ],200);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()
            ->json([
                'message' => 'Logged out successfully'
            ], 200);
    }
}
