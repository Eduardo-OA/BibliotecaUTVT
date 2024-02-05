<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UsuariosController;
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
    return view('login.login');
})->name('login');


//  Login
Route::get('/login', [AuthController::class, 'show']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout']);

//  Acceso a rutas mientras el usuario este autenticado
Route::middleware('auth')->group(function () {
    Route::get('/inicio', function () {
        return view('welcome');
    });
});

//usuarios 
Route::resource('usuarios', UsuariosController::class); 
Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::POST('usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::delete('usuarios/delete/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');