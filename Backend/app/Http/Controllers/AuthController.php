<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        // return $credentials;
        $token = Auth::attempt($credentials, true);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ], 200);
    }
    public function register(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        // return $credentials;
        $token = Auth::attempt($credentials, true);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ], 200);
    }
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
        ], 200);
    }
}
