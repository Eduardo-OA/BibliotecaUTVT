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
        $libros = Libros::all();
        // return view('modalesInicio', compact('libros'));
            // return view('modalesInicio')
        // ->with(['libros' => $libros]);
        // return view('libros.create');
        // return view('libros.create');
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
        return redirect()->route('libros.index')->with('success', 'Libro agregado exitosamente');
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
            return redirect()->route('libros.index')->with('success', 'Libro eliminado exitosamente.');
        } else {
            return redirect()->route('libros.index')->with('error', 'Libro no encontrado.');
        }
    }

    public function reporteslibros()
    {
        //
        $libros = Libros::all();
        $semanal = \DB::select('SELECT DATE(prestamolibros.created_at) AS dia_renta,
        COUNT(*) AS total_rentas
        FROM prestamolibros
        JOIN users ON prestamolibros.usuario_id = users.id
        WHERE users.rol_id = 3
        AND WEEK(prestamolibros.created_at) = WEEK(CURDATE()) -- Selecciona las rentas de la semana actual
        GROUP BY dia_renta;');
        $mensual =\DB::select(' SELECT DATE(prestamolibros.created_at) AS dia_renta,
        COUNT(*) AS total_rentas
        FROM prestamolibros
        JOIN users ON prestamolibros.usuario_id = users.id
        WHERE users.rol_id = 3
        AND MONTH(prestamolibros.created_at) = MONTH(CURDATE()) -- Selecciona las rentas del mes actual
        GROUP BY dia_renta');
        $cuatrimestral=\DB::select('SELECT DATE(prestamolibros.created_at) AS dia_renta,
       COUNT(*) AS total_rentas
       FROM prestamolibros
       JOIN users ON prestamolibros.usuario_id = users.id
       WHERE users.rol_id = 3
       AND prestamolibros.created_at >= DATE_SUB(CURDATE(), INTERVAL 4 MONTH) -- Selecciona las rentas de los últimos 4 meses
       GROUP BY dia_renta;');
        $carreras=\DB::select('SELECT users.carrera, COUNT(*) AS total_rentas
        FROM prestamolibros
        JOIN users ON prestamolibros.usuario_id = users.id
        GROUP BY users.carrera;');
        $solicitado=\DB::select('SELECT prestamolibros.libros_id, libros.titulo, COUNT(*) AS cantidad_solicitudes
        FROM prestamolibros
        JOIN libros ON prestamolibros.libros_id = libros.id
        GROUP BY prestamolibros.libros_id, libros.titulo
        ORDER BY cantidad_solicitudes DESC;');
        return view('libros.reporteslibros')
        ->with(['mensual' => $mensual])
        ->with(['cuatrimestral' => $cuatrimestral])
        ->with(['carreras' => $carreras])
        ->with(['solicitado' => $solicitado])
        ->with(['semanal' => $semanal]);
    }
}
