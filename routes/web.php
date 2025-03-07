<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// Página de login
Route::get('/', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/', [AuthController::class, 'login'])->name('auth.login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Agrupar rutas protegidas con el middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', function () {
        return view('inicio'); // Asegúrate de tener esta vista en resources/views/inicio.blade.php
    })->name('inicio');
});
