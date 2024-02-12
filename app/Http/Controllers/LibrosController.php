<?php

namespace App\Http\Controllers;

use App\Models\Libros;
use Illuminate\Http\Request;

class LibrosController extends Controller
{
    public function index()
    {
        // Lógica para mostrar todos los usuarios
        $libros = Libros::all();
        return view('libros.index', compact('libros'));
    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación de usuario
        return view('libros.create');
    }

    public function store(Request $request)
    {

       
        $libro = new Libros();
        $libro->titulo = $request->input('titulo');
        $libro->autores = $request->input('autores');
        $libro->genero = $request->input('genero');
        $libro->editorial = $request->input('editorial');
        $libro->idioma = $request->input('idioma');
        $libro->cantidad = $request->input('cantidad');
        $libro->disponibilidad = $request->input('disponibilidad');
        $libro->ubicacion = $request->input('ubicacion');
        $libro->fechaadqui = $request->input('fechaadqui');
        $libro->save();
        return redirect()->route('libros.index')->with('success', 'Usuario creado exitosamente');
    }

    public function update(Request $request, $id)
    {
      
        // Busca el libro a actualizar por su ID
        $libro = Libros::findOrFail($id);

        // Actualiza los campos del libro con los datos proporcionados
        $libro->titulo = $request->input('titulo');
        $libro->autores = $request->input('autores');
        $libro->genero = $request->input('genero');
        $libro->editorial = $request->input('editorial');
        $libro->idioma = $request->input('idioma');
        $libro->cantidad = $request->input('cantidad');
        $libro->disponibilidad = $request->input('disponibilidad');
        $libro->ubicacion = $request->input('ubicacion');
        $libro->fechaAdqui = $request->input('fechaAdqui');
        $libro->save();

        // Redirecciona a alguna ruta después de actualizar el libro
        return redirect()->route('libros.index');
    }

    public function destroy($id)
    {
        $libro = Libros::find($id);

        if ($libro) {
            $libro->delete();
            return redirect()->route('libros.index')->with('success', 'Usuario eliminado exitosamente.');
        } else {
            return redirect()->route('libros.index')->with('error', 'Usuario no encontrado.');
        }
    }
}
