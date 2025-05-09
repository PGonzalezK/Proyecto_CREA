<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    session(['portal' => 'crea']); // si entra a crea
    session(['portal' => 'edifica']); // si entra a edifica
    
    // Mostrar la vista de login (opcional si ya usas route()->view)
    public function showLoginForm()
    {
        return view('welcome'); // Asegúrate que esta vista exista
    }

    public function login(Request $request)
    {
        // Validar
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'portal_selected' => 'required|in:crea,edifica',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();
            $portal = $request->input('portal_selected');

            // Validar acceso según empresa
            if (
                ($user->id_empresa == 1 && $portal === 'edifica') ||
                ($user->id_empresa == 2 && $portal === 'crea')
            ) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'No tienes permiso para acceder a este portal.');
            }

            // Redirige según portal
            return redirect()->route($portal . '.home');
        }

        return redirect()->back()->with('error', 'Credenciales incorrectas.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
