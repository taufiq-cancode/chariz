<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Auth\Events\Registered;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;

            return response()->json([
                'message' => 'User logged in successfully.',
                'token' => $token,
                'user' => new UserResource($user),
            ], 200);
        }

        return response()->json(['error' => 'Incorrect login details'], 401);
    }
}
