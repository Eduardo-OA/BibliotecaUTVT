<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\UsuariosController;
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
    if(Auth::user()){
        return view('welcome');
    }else{
        return view('login.login');
    }
})->name('/');


//  Login
Route::get('/login', [AuthController::class, 'show'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout']);

//  Acceso a rutas mientras el usuario este autenticado
Route::middleware('auth')->group(function () {
    Route::get('/inicio', function () {
        return view('welcome');
    });

    //  Resourse usuarios 
    Route::resource('usuarios', UsuariosController::class);
    Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::POST('usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
    Route::delete('usuarios/delete/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

    // Resourse Libros
    Route::resource('libros', LibrosController::class);
    Route::get('libros', [LibrosController::class, 'index'])->name('libros.index');
    //Route::POST('libros/store', [LibrosController::class, 'store'])->name('libros.store');
    Route::delete('libros/delete/{id}', [LibrosController::class, 'destroy'])->name('libros.destroy');

    //  Vista Maquinas -> cambiar ruta de controlador
    Route::get('/maquinas', function () {
        return view('maquinas.index');
    });
});
