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

        //  Validaciones
        $messages = [
            'nombre.required' => 'Es necesario colocar un nombre.',
            'app.required' => 'Es necesario colocar el primer apellido.',
            'apm.required' => 'Es necesario completar el campo.',
            'genero.required' => 'Es necesario seleccionar una opción.',
            'carrera.required' => 'Es necesario seleccionar una opción.',
            'matricula.required' => 'Es necesario colocar la matricula.',
            'direccion.required' => 'Es necesario colocar una dirección.',
            'celular.required' => 'Es necesario proporcionar este contacto.',
            'email.required' => 'Es necesario colocar un correo.',
            'password.required' => 'Genere una contraseña',
        ];

        if ($request->input('rol_id') == 1 || $request->input('rol_id') == 2) {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'app' => ['required', 'string', 'max:255'],
                'apm' => ['required', 'string', 'max:255'],
                'genero' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:' . User::class],
                'password' => ['required']
            ], $messages);

            $usuario = new User([
                'nombre' => $request->input('nombre'),
                'app' => $request->input('app'),
                'apm' => $request->input('apm'),
                'genero' => $request->input('genero'),
                'rol_id' => $request->input('rol_id'),
                'email' => $request->input('email'),
                'pasword' => $request->input('pasword'),
            ]);
        } else if ($request->input('rol_id') == 3) {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'app' => ['required', 'string', 'max:255'],
                'apm' => ['required', 'string', 'max:255'],
                'genero' => ['required', 'string'],
                'carrera' => ['required', 'string'],
                'matricula' => ['required', 'string'],
                'direccion' => ['required', 'string'],
                'celular' => ['required', 'string']
            ], $messages);
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
    
        }

        
        $usuario->save();
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente');
    }

    public function update(Request $request, $id)
    {

        //  Mensajes de validación
        $messages = [
            'nombre.required' => 'Es necesario colocar un nombre.',
            'app.required' => 'Es necesario colocar el primer apellido.',
            'apm.required' => 'Es necesario completar el campo.',
            'genero.required' => 'Es necesario seleccionar una opción.',
            'carrera.required' => 'Es necesario seleccionar una opción.',
            'matricula.required' => 'Es necesario colocar la matricula.',
            'direccion.required' => 'Es necesario colocar una dirección.',
            'celular.required' => 'Es necesario proporcionar este contacto.',
            'email.required' => 'Es necesario colocar un correo.',
            'password.required' => 'Genere una contraseña',
        ];

        $user = User::find($id);

        if ($user) {
            //  Validaciones
            if ($user->rol_id == 1 || $user->rol_id == 2) {  // Admin y auxiliar
                $request->validate([
                    'nombre' => ['required', 'string', 'max:255'],
                    'app' => ['required', 'string', 'max:255'],
                    'apm' => ['required', 'string', 'max:255'],
                    'genero' => ['required', 'string'],
                    'email' => ['email', 'unique:' . User::class],
                ], $messages);
            } elseif ($user->rol_id == 3) { // Estudiante
                $request->validate([
                    'nombre' => ['required', 'string', 'max:255'],
                    'app' => ['required', 'string', 'max:255'],
                    'apm' => ['required', 'string', 'max:255'],
                    'genero' => ['required', 'string'],
                    'carrera' => ['required', 'string'],
                    'matricula' => ['required', 'string'],
                    'direccion' => ['required', 'string'],
                    'celular' => ['required', 'string'],
                ], $messages);
            }

            // Actualiza los campos del usuario
            $user->nombre = $request->input('nombre');
            $user->app = $request->input('app');
            $user->apm = $request->input('apm');
            $user->genero = $request->input('genero');

            // Actualiza campos específicos según el rol
            if ($user->rol_id == 1 || $user->rol_id == 2) { // Admin y auxiliar
                // dd("Registro de tipo Auxiliar o admin", $user->rol_id);
                $user->email = $request->input('email');
                $user->password = bcrypt($request->input('password'));
            } elseif ($user->rol_id == 3) { // Estudiante
                // dd("Registro de tipo estudiante", $user->rol_id);
                // $user->carrera = $request->input('carrera');
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
