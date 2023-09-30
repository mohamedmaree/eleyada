<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $token = auth()->user()->createToken('authToken')->plainTextToken;
            return response()->json([
                'user' => auth()->user(),
                'token' => $token
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            //log user out
            auth()->user()->tokens()->delete();

            return response()->json('', 204);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['result' => 'Error while logging you out'], 500);
        }
    }
}
