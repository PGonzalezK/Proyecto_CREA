<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\IndividuoController;
use App\Http\Controllers\IndividuoTecnicaControllerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('blogs', BlogController::class);
    Route::get('/individuos/grupales', [\App\Http\Controllers\IndividuoGrupalController::class, 'index'])->name('individuos.grupales');
    Route::post('/serviu/{codigo}/upload', [App\Http\Controllers\ServiuController::class, 'upload'])->name('serviu.upload');
    Route::get('/tecnica', [App\Http\Controllers\IndividuoTecnicaController::class, 'index'])->name('tecnica.index');
    Route::get('/tecnica/{codigo_serviu}', [App\Http\Controllers\IndividuoTecnicaController::class, 'show'])->name('tecnica.show');
    Route::post('/tecnica/{codigo_serviu}/crear-carpeta', [App\Http\Controllers\IndividuoTecnicaController::class, 'crearCarpeta'])->name('tecnica.crearCarpeta');
    Route::delete('/tecnica/{codigo_serviu}/eliminar-carpeta', [App\Http\Controllers\IndividuoTecnicaController::class, 'eliminarCarpeta'])->name('tecnica.eliminarCarpeta');
    Route::post('/tecnica/{codigo_serviu}/upload', [App\Http\Controllers\IndividuoTecnicaController::class, 'upload'])->name('tecnica.upload');
    Route::post('/profile/update', [UsuarioController::class, 'updateProfile'])->name('profile.update');


    Route::resource('individuos', IndividuoController::class);

});