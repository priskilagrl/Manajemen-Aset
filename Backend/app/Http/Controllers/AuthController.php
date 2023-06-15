<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
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
    public function register(RegisterRequest $request)
    {
        // Validate user input
        $validatedData = $request->validated();
        // Create a new user
        $user = User::create([
            'uuid' => Str::uuid(),
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'remember_token' => Str::random(60), // Generate a random API token for the user
        ]);
        $user->save();

        // Return a response with the created user and a success message
        return response()->json([ // 'user' => $user,
            'message' => 'Registration successful!'
        ], 201);
    }
    

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
        ], 200);
    }

    public function profile()
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }
}
