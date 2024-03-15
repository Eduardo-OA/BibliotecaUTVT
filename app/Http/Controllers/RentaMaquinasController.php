<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Maquinas;
use App\Models\Rentamaquinas;
use App\Models\Libros;
use App\Models\Prestamolibros;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

date_default_timezone_set('America/Mexico_City');

class RentaMaquinasController extends Controller
{
    public function index()
    {
/////////////////////SELECTS//////////////////
   // Obtener la lista de carreras disponibles
   $carreras = User::select('carrera')->where('carrera', '!=', 'UTVT')->where('carrera', '!=', '')->distinct()->get();


//////////////////END SELECTS/////////////////


        //  Logica para mostrar maquinas por isla
        $islas = \DB::SELECT('SELECT isla FROM maquinas GROUP BY isla');
        // $libros = Libros::all();
        // $usuarios = User::all();
        $maquinas = Maquinas::all();
        $rentas = RentaMaquinas::all();
        $usuarios = User::all()->where('rol_id', 3);

        //  Consulta que se muestra unicamente en la tabla de 'Maquinas en renta'
        $rentaTable = \DB::SELECT('SELECT usuario.nombre, usuario.app, usuario.apm, usuario.matricula, maquina.isla, maquina.id AS maquina_id, renta.id, renta.hora_inicio, renta.hora_final
        FROM rentamaquinas AS renta
            INNER JOIN users AS usuario ON renta.usuario_id = usuario.id
            INNER JOIN maquinas AS maquina ON renta.maquina_id = maquina.id
        WHERE DATE(renta.updated_at) = CURDATE() ORDER BY renta.hora_inicio DESC');

        //  Consulta que se muestra como la cantidad de rentas activas
        $cantidadMaquinasRenta = count(Rentamaquinas::whereNull('hora_final')->get());

        ////////////////////////CONSULTAS DE WELCOME(RENTA DE LIBROS)/////////////////
        $cantidadLibrosRenta = count(Prestamolibros::where('status', 'rentado')->get());

        // Consulta para obtener los libros disponibles
        $librosDisponibles = Libros::where('cantidad', '>',  0)->get();

        // Consulta para obtener los libros alquilados
        $librosAlquilados = Prestamolibros::where('status', 'rentado')->get();

        //////*DEVOLVER******************************* */
        // Obtener la fecha actual
        $fechaActual = Carbon::now();

        // Obtener los libros que deben ser devueltos hoy o en los próximos días
        $librosDevolver = Prestamolibros::whereDate('fecha_devo', '>=', $fechaActual)
            ->where('fecha_devo', '<=', $fechaActual->addDays(3))
            ->where('status', 'rentado')
            ->get();


        // Generar HTML para los libros a devolver
        $htmlLibrosDevolver = '';
        foreach ($librosDevolver as $libro) {
            $fechaDevoCarbon = Carbon::parse($libro->fecha_devo);
            $htmlLibrosDevolver .= 'El libro:       ' .  $libro->libro->titulo . ' - Devolver el ' . $fechaDevoCarbon->toDateString();
        }

        return view('welcome', compact(
            'islas',
            'carreras',
            'maquinas',
            'rentas',
            'usuarios',
            'rentaTable',
            'cantidadMaquinasRenta',
            'cantidadLibrosRenta',
            'librosDevolver',
            'librosDisponibles',
            'librosAlquilados',
            'htmlLibrosDevolver'
        ));
    }

    public function rentarmaquina(Request $request)
    {
        // dd($request->all());

        //  Validaciones
        $messages = [
            'alumnos.required' => 'Es necesario seleccionar un usuario.',
            'maquina_id.required' => 'Es necesario seleccionar una maquina.',
        ];

        $request->validate([
            'alumnos' => ['required', 'string'],
            'maquina_id' => ['required', 'string'],
        ], $messages);

        RentaMaquinas::create(array(
            'usuario_id' => $request->input('alumnos'),
            'maquina_id' => $request->input('maquina_id'),
            'hora_inicio' => date("H:i"),
        ));

        $maquina = Maquinas::find($request->input('maquina_id'));
        $maquina->estatus = 'O';
        $maquina->save();

        return redirect('/')->with('success', 'Renta exitosa');
    }

    public function update(RentaMaquinas $id, Request $request)
    {
        //  Fin de la renta
        //  Actualización de el campo 'hora_final' en BD
        $query = RentaMaquinas::find($id->id);
        $query->hora_final = date("H:i:s");
        $query->save();

        //  Regresar el estado de la maquina a 'Disponible'
        $query = Maquinas::find($request->input('maquina_id'));
        $query->estatus = 'D';
        $query->save();

        return redirect('/')->with('success', 'Termino de renta exitosa');
    }

    public function mostrarAvisoDevolucion()
    {
        // Obtener la fecha actual
        $fechaActual = Carbon::now();

        // Obtener los libros que deben ser devueltos h oy o en los próximos días
        $librosDevolver = Prestamolibros::where('fecha_devo', '>=', $fechaActual)
            ->where('fecha_devo', '<=', $fechaActual->addDays(3))
            ->get();
        // dd($_request->all());
        return view('welcome', ['librosDevolver' => $librosDevolver]);
    }
}
