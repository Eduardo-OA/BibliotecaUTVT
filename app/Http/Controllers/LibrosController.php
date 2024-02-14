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
        $rules = [
            'titulo' => 'required',
            'autores' => 'required',
            'genero' => 'required',
            'editorial' => 'required',
            'idioma' => 'required',
            'cantidad'=> 'required',
            'disponibilidad'=>'required',
            'ubicacion' =>'required',
            'fechaadqui' =>'required'

        ];

        $message = [
            'titulo.required' => 'El titulo es requerido',
            'autores.required' => 'Los autores son requeridos',
            'genero.required' => 'El genero del libro es requerido',
            'editorial.required' => 'La editorial es requerida',
            'idioma.required' => 'El idioma es requerido',
            'cantidad.required' => 'La cantidad de libros es requerida',
            'disponibilidad.required' => 'La disponibilidad es requerida',
            'ubicacion.required' => 'La ubicación es requerida',
            'fechaadqui.required' => 'La fecha de adquisición es requerida',

        ];

        $this->validate($request, $rules, $message);

       
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
        $rules = [
            'titulo' => 'required',
            'autores' => 'required',
            'genero' => 'required',
            'editorial' => 'required',
            'idioma' => 'required',
            'cantidad'=> 'required',
            'disponibilidad'=>'required',
            'ubicacion' =>'required',
            'fechaadqui' =>'required'

        ];

        $message = [
            'titulo.required' => 'El titulo es requerido',
            'autores.required' => 'Los autores son requeridos',
            'genero.required' => 'El genero del libro es requerido',
            'editorial.required' => 'La editorial es requerida',
            'idioma.required' => 'El idioma es requerido',
            'cantidad.required' => 'La cantidad de libros es requerida',
            'disponibilidad.required' => 'La disponibilidad es requerida',
            'ubicacion.required' => 'La ubicación es requerida',
            'fechaadqui.required' => 'La fecha de adquisición es requerida',
        ];

        $this->validate($request, $rules, $message);
        
        $libro = Libros::findOrFail($id);
    
       
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
