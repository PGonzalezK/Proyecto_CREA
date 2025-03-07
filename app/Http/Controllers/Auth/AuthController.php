<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('landing'); // Usa el helper global
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/inicio'); // Usa el helper global
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas']); // Corrección de Back::withErrors()
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/'); // Usa el helper global
    }
}
