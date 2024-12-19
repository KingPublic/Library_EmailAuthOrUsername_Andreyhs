<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Ganti dengan nama view form login Anda
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email_or_username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard'); // Redirect ke dashboard setelah login berhasil
        }

        return back()->with('error', 'Invalid credentials');
    }
}

