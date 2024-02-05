<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        // Lógica para mostrar todos los usuarios
        $usuarios = User::all();
        $roles = Roles::all();
        return view('usuarios.index', compact('usuarios', 'roles'));
    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación de usuario
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        

       
        $usuario = new User([
            'nombre' => $request->input('nombre'),
            'app' => $request->input('app'),
            'apm' => $request->input('apm'),
            'genero' => $request->input('genero'),
            'rol_id' => $request->input('rol_id'),
            'carrera' => $request->input('carrera'),
            'matricula' => $request->input('matricula'),
            'direccion' => $request->input('direccion'),
            'celular' => $request->input('celular'),
            'email' => $request->input('email'),
            'pasword' => $request->input('pasword'),
            
            
        ]);
        $usuario->save();

       
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente');
    }

    public function update(Request $request, $id)
    {
    
        $user = User::find($id);

        if ($user) {
            // Actualiza los campos del usuario
            $user->nombre = $request->input('nombre');
            $user->app = $request->input('app');
            $user->apm = $request->input('apm');
            $user->genero = $request->input('genero');
            $user->rol_id = $request->input('rol_id');

            // Actualiza campos específicos según el rol
            if ($request->input('rol_id') == 1) { // Admin
                $user->email = $request->input('email');
                $user->password = bcrypt($request->input('password'));
            } elseif ($request->input('rol_id') == 2) { // Estudiante
                $user->carrera = $request->input('carrera');
                $user->matricula = $request->input('matricula');
                $user->direccion = $request->input('direccion');
                $user->celular = $request->input('celular');
            }

            $user->save();

           
            return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
        } else {
            
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
        }
    }
    public function destroy($id)
    {
    
        $user = User::find($id);

        if ($user) {
            $user->delete();

            return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
        } else {
            
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
        }
    }
}