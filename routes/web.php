<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\IndividuoController;
use App\Http\Controllers\IndividuoTecnicaController;
use App\Http\Controllers\ServiuController;
use App\Http\Controllers\IndividuoGrupalController;
use App\Http\Controllers\Auth\LoginController;

// Rutas de autenticación
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', fn() => view('welcome'))->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('custom.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 🔐 PORTAL CREA
Route::prefix('crea')->name('crea.')->middleware(['auth', 'portal.access'])->group(function () {
    Route::get('/home', [HomeController::class, 'indexCrea'])->name('home');
    Route::get('/individuos/grupales', [IndividuoGrupalController::class, 'index'])->name('individuos.grupales');

    Route::get('/grupos', function () {
        return view('crea.individuos.grupales', ['grupales' => collect([])]);
    });

    Route::get('/testdd', fn() => dd('Si ves esto, las rutas CREA sí están funcionando'));

    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('individuos', IndividuoController::class);


    Route::delete('/{portal}/individuos/{id}/{archivo}/eliminar', [IndividuoController::class, 'eliminarArchivo'])
    ->name('individuos.eliminarArchivo');
    Route::get('/tecnica', [IndividuoTecnicaController::class, 'index'])->name('tecnica.index');
    Route::get('/tecnica/{codigo_serviu}', [IndividuoTecnicaController::class, 'show'])->name('tecnica.show');
    Route::post('/tecnica/{codigo_serviu}/crear-carpeta', [IndividuoTecnicaController::class, 'crearCarpeta'])->name('tecnica.crearCarpeta');
    Route::delete('/tecnica/{codigo_serviu}/eliminar-carpeta', [IndividuoTecnicaController::class, 'eliminarCarpeta'])->name('tecnica.eliminarCarpeta');
    Route::post('/tecnica/{codigo_serviu}/upload', [IndividuoTecnicaController::class, 'upload'])->name('tecnica.upload');
    Route::delete('/tecnica/{codigo_serviu}/archivo', [IndividuoTecnicaController::class, 'eliminarArchivo'])->name('tecnica.eliminarArchivo');

    Route::post('/serviu/{codigo}/upload', [ServiuController::class, 'upload'])->name('serviu.upload');
    Route::delete('/serviu/{codigo}/{tipo}/eliminar', [ServiuController::class, 'eliminarArchivo'])->name('serviu.eliminar');
    Route::delete('crea/serviu/{codigo}/{archivo}/eliminar', [ServiuController::class, 'eliminarArchivo'])->name('crea.serviu.eliminar');


    Route::post('/profile/update', [UsuarioController::class, 'updateProfile'])->name('profile.update');
});

// 🔐 PORTAL EDIFICA
Route::prefix('edifica')->name('edifica.')->middleware(['auth', 'portal.access'])->group(function () {
    Route::get('/home', [HomeController::class, 'indexEdifica'])->name('home');
    Route::get('/individuos/grupales', [IndividuoGrupalController::class, 'index'])->name('individuos.grupales');

    Route::get('/grupos', function () {
        return view('edifica.individuos.grupales', ['grupales' => collect([])]);
    });

    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('individuos', IndividuoController::class);

    Route::delete('/{portal}/individuos/{id}/{archivo}/eliminar', [IndividuoController::class, 'eliminarArchivo'])
    ->name('individuos.eliminarArchivo');
    Route::get('/tecnica', [IndividuoTecnicaController::class, 'index'])->name('tecnica.index');
    Route::get('/tecnica/{codigo_serviu}', [IndividuoTecnicaController::class, 'show'])->name('tecnica.show');
    Route::post('/tecnica/{codigo_serviu}/crear-carpeta', [IndividuoTecnicaController::class, 'crearCarpeta'])->name('tecnica.crearCarpeta');
    Route::delete('/tecnica/{codigo_serviu}/eliminar-carpeta', [IndividuoTecnicaController::class, 'eliminarCarpeta'])->name('tecnica.eliminarCarpeta');
    Route::post('/tecnica/{codigo_serviu}/upload', [IndividuoTecnicaController::class, 'upload'])->name('tecnica.upload');
    Route::delete('/tecnica/{codigo_serviu}/archivo', [IndividuoTecnicaController::class, 'eliminarArchivo'])->name('tecnica.eliminarArchivo');

    Route::post('/serviu/{codigo}/upload', [ServiuController::class, 'upload'])->name('serviu.upload');
    Route::delete('/serviu/{codigo}/{tipo}/eliminar', [ServiuController::class, 'eliminarArchivo'])->name('serviu.eliminar');
    Route::delete('edifica/serviu/{codigo}/{archivo}/eliminar', [ServiuController::class, 'eliminarArchivo'])->name('edifica.serviu.eliminar');

    Route::post('/profile/update', [UsuarioController::class, 'updateProfile'])->name('profile.update');
});
