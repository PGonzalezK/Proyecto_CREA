<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GruposController;

// Rutas Login
Route::get('/', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/', [AuthController::class, 'login'])->name('auth.login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', [DashboardController::class, 'index'])->name('inicio');

    Route::resource('seccion/personas', PersonaController::class);
    Route::resource('seccion/grupos', GruposController::class);
    Route::resource('seccion/cuentas', CuentasController::class);

    Route::get('/perfil', [UserController::class, 'show'])->name('perfil.show');
    Route::put('/perfil', [UserController::class, 'update'])->name('perfil.update');
});



