<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Maquinas;
use App\Models\Libros;
use App\Models\Prestamolibros;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RentaMaquinasController extends Controller
{
    public function index()
    {
        //  Logica para mostrar maquinas por isla
        $islas = \DB::SELECT('SELECT isla FROM maquinas GROUP BY isla');
        // $libros = Libros::all();
        $usuarios = User::all();
        $maquinas = Maquinas::all();
// Consulta para obtener los libros disponibles
$librosDisponibles = Libros::where('cantidad', '>',  0)->get();

// Consulta para obtener los libros alquilados
$librosAlquilados = Prestamolibros::where('status', 'rentado')->get();

// Puedes acceder a los detalles de los libros disponibles y alquilados de la siguiente manera:
// foreach ($librosDisponibles as $libro) {
//     echo "Título: " . $libro->titulo . ", Autores: " . $libro->autores . ", Género: " . $libro->genero . ", Editorial: " . $libro->editorial . "\n";
// }

// foreach ($librosAlquilados as $prestamo) {
//     $libro = $prestamo->libro;
//     echo "Título: " . $libro->titulo . ", Autores: " . $libro->autores . ", Género: " . $libro->genero . ", Editorial: " . $libro->editorial . "\n";
// }
        //////*DEVOLVER******************************* */
        // Obtener la fecha actual
        $fechaActual = Carbon::now();

        // Obtener los libros que deben ser devueltos hoy o en los próximos días
            $librosDevolver = Prestamolibros::whereDate('fecha_devo', '>=', $fechaActual)
                ->where('fecha_devo', '<=', $fechaActual->addDays(3))
                ->get();


                // Generar HTML para los libros a devolver
                $htmlLibrosDevolver = '';
                foreach ($librosDevolver as $libro) {
                    $fechaDevoCarbon = Carbon::parse($libro->fecha_devo);
                    $htmlLibrosDevolver .= 'El libro:       '.  $libro->libro->titulo . ' - Devolver el ' . $fechaDevoCarbon->toDateString();
                }
                // dd($librosRentados);
        return view('welcome', compact(
            'islas',
            'maquinas',
            // 'librosRentados',
            'librosDevolver',
            'librosDisponibles',
            'librosAlquilados',
            // 'libros',
            'usuarios',
            'htmlLibrosDevolver',
            // 'librosPrestados'
        ));
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
