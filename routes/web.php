<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Rutas Login
Route::get('/', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/', [AuthController::class, 'login'])->name('auth.login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', function () {
        return view('inicio');
    })->name('inicio');

    Route::resource('seccion/personas', PersonaController::class);

    Route::middleware(['auth'])->group(function () {
        Route::get('/perfil', [UserController::class, 'show'])->name('perfil.show');
        Route::put('/perfil', [UserController::class, 'update'])->name('perfil.update');
    });
    
});

