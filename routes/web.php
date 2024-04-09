<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\MaquinasController;
use App\Http\Controllers\RentaMaquinasController;
use App\Http\Controllers\RentaLibroController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//  Primer Pagina
Route::get('/', function () {
    if (Auth::user()) {
        return route('inicio');
    } else {
        return route('login');
    }
})->name('/');

//  Login
Route::get('/login', [AuthController::class, 'show'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout']);

//  Acceso a rutas mientras el usuario este autenticado
Route::middleware('auth')->group(function () {
    Route::get('/', [RentaMaquinasController::class, 'index'])->name('inicio');

    //  Resourse usuarios
    Route::resource('usuarios', UsuariosController::class);
    Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index')->middleware('role:1');
    Route::POST('usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store')->middleware('role:1');
    Route::delete('usuarios/delete/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy')->middleware('role:1');

    // Resourse Libros ---- Prestamo de libros comentado (descomentar en caso de ser solicitado)
    // Route::resource('libros', LibrosController::class)->middleware('role:1');
    // Route::get('libros', [LibrosController::class, 'index'])->name('libros.index')->middleware('role:1');
    // Route::POST('libros/store', [LibrosController::class, 'store'])->name('libros.store')->middleware('role:1');
    // Route::delete('libros/delete/{id}', [LibrosController::class, 'destroy'])->name('libros.destroy')->middleware('role:1');
    // Route::name('reporteslibros')->get('reporteslibros',[LibrosController::class, 'reporteslibros']);

    //  Resource Maquinas
    Route::resource('maquinas', MaquinasController::class)->middleware('role:1');
    Route::put('/maquinas/{id}', 'MaquinasController@update')->name('maquinas.update')->middleware('role:1');
    Route::DELETE('/maquinas/{id}', 'MaquinasController@destroy')->name('maquinas.destroy')->middleware('role:1');
    Route::name('reportes')->get('reportes',[MaquinasController::class, 'reportes']);

    //  Renta de maquinas
    Route::name('rentarmaquina')->post('rentarmaquina', [RentaMaquinasController::class, 'rentarmaquina']);
    Route::put('rentaMaquina.update/{id}', [RentaMaquinasController::class, 'update'])->name('rentaMaquina.update');
    
    //  RUTAS de renta LIBROS
    Route::resource('renta-libros', RentaLibroController::class);
    Route::get('/mostrar-aviso-devolucion', [RentaMaquinasController::class, 'mostrarAvisoDevolucion'])->name('mostrar.aviso.devolucion');

});
