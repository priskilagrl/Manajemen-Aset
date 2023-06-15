<?php

namespace App\Http\Controllers\AUTH;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
     public function showLoginForm()
    {
        return view('auth.login');
    }
    protected $redirectTo = RouteServiceProvider::HOME;
    
    public function login(Request $request)
    {
        $baseUrl = 'http://127.0.0.1:8000'; // Replace with your API base URL

        // Prepare the login request data
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Send the login request to the API endpoint
        $response = Http::post($baseUrl . '/api/auth/login', $data);
        // dd($response);


        // Check if the request was successful
        if ($response->successful()) {
            // Retrieve the response data
            $responseData = $response->json();
            // dd($responseData);

            // Do something with the response data
            // For example, store the access token in a variable or session
            $accessToken = $responseData['authorisation']['token'];
            $Auth = $responseData['user'];
            $request->session()->put('bearer-token', $accessToken);
            $request->session()->put('user', $Auth);
            return redirect('/');
        }

        // Request failed, handle the error
        return response()->json(['error' => 'Login failed'], $response->status());
    }
}
