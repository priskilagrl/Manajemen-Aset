<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Memeriksa apakah pengguna memiliki peran 'admin'
        $this->authorize('admin');

        // Logika bisnis untuk dashboard admin

        // Mengembalikan respon JSON
        return response()->json(['message' => 'Welcome to the admin dashboard']);
    }
}
