<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        // Lógica para mostrar todos los usuarios
        $usuarios = User::all();
        $estudiantes = User::all()->where('rol_id', '3');
        $docentes = User::all()->where('rol_id', '4');
        $biblioteca = \DB::table('users')->where('rol_id', '1')->orWhere('rol_id', '2')->get();
        $roles = Roles::all();
        return view('usuarios.index', compact('usuarios', 'estudiantes', 'docentes', 'biblioteca', 'roles'));
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
                'tipo_estudiante' => ['required', 'string'],
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
                'tipo_estudiante' => $request->input('tipo_estudiante'),
                'direccion' => $request->input('direccion'),
                'celular' => $request->input('celular'),
                'email' => $request->input('email'),
                'pasword' => $request->input('pasword'),
            ]);
        }else if($request->input('rol_id') == 4){
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'app' => ['required', 'string', 'max:255'],
                'apm' => ['required', 'string', 'max:255'],
                'genero' => ['required', 'string'],
                'direccion' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'unique:' . User::class]
            ], $messages);
            $usuario = new User([
                'nombre' => $request->input('nombre'),
                'app' => $request->input('app'),
                'apm' => $request->input('apm'),
                'genero' => $request->input('genero'),
                'rol_id' => $request->input('rol_id'),
                'direccion' => $request->input('direccion'),
                'email' => $request->input('email'),
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
            'tipo_estudiante' => 'Es necesario colocar un tipo de estudiante.',
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
                    'email' => ['email'],
                ], $messages);
            } elseif ($user->rol_id == 3) { // Estudiante
                $request->validate([
                    'nombre' => ['required', 'string', 'max:255'],
                    'app' => ['required', 'string', 'max:255'],
                    'apm' => ['required', 'string', 'max:255'],
                    'genero' => ['required', 'string'],
                    'matricula' => ['required', 'string'],
                    'tipo_estudiante' => ['required', 'string'],
                    'direccion' => ['required', 'string'],
                    'celular' => ['required', 'string'],
                ], $messages);
            } elseif ($user->rol_id == 4) {
                $request->validate([
                    'nombre' => ['required', 'string', 'max:255'],
                    'app' => ['required', 'string', 'max:255'],
                    'apm' => ['required', 'string', 'max:255'],
                    'genero' => ['required', 'string'],
                    'direccion' => ['required', 'string'],
                    'email' => ['required', 'email'],
                ], $messages);
            }

            // Actualiza los campos del usuario
            $user->nombre = $request->input('nombre');
            $user->app = $request->input('app');
            $user->apm = $request->input('apm');
            $user->genero = $request->input('genero');

            // Actualiza campos específicos según el rol
            if ($user->rol_id == 1 || $user->rol_id == 2) { // Admin y auxiliar
                $user->email = $request->input('email');
                $user->password = Hash::make($request->input('password'));
            } elseif ($user->rol_id == 3) { // Estudiante
                $user->matricula = $request->input('matricula');
                $user->tipo_estudiante = $request->input('tipo_estudiante');
                $user->direccion = $request->input('direccion');
                $user->celular = $request->input('celular');
            } elseif($user->rol_id == 4) {
                $user->direccion = $request->input('direccion');
                $user->email = $request->input('email');
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
