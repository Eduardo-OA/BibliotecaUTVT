<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show() {
        if(Auth::check()) {
            return redirect('/home');
        }
        return view('login.login');
    }

    public function login(LoginRequest $request) {
        $credentials = $request->getCredentials();
        if(!Auth::validate($credentials)) {
            return redirect()->to('/login')->withErrors('Error en alguno de los campos, intente nuevamente.');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        // dd($user->rol_id);

        if($user->rol_id == 1 || $user->rol_id == 2) {
            Auth::login($user);
            return $this->authenticated($request, $user);   
        }else{
            return redirect()->to('/login')->withErrors('Este usuario no tiene los permisos para ingresar al sistema. Pruebe con otro correo.');
        }
    }

    public function authenticated(Request $request, $user) {
        return redirect('/home');
    }
}
