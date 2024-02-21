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
        // Obtener los IDs de los libros que están alquilados actualmente
        $librosAlquilados = DB::table('prestamolibros')->pluck('libros_id')->all();

        // Obtener todos los libros que no están en la lista de libros alquilados
        $libros = Libros::whereNotIn('id', $librosAlquilados)->get();

        // Obtener los préstamos de libros activos (es decir, no devueltos)
        $prestamos = Prestamolibros::whereNull('fecha_devo')->get();

        // Obtener los IDs de los libros que están actualmente prestados
        $alquilados = DB::table('prestamolibros')->pluck('libros_id')->all();

        // Obtener los libros que no están en la lista de libros prestados
        $libros_Stock = Libros::whereNotIn('id', $alquilados)->get();

        $librosAlquilados = Prestamolibros::with('Libro', 'User')->get();

        //////********************DEVOLVER******************************** */
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
                // dd($librosDevolver);
        return view('welcome', compact(
            'islas',
            'maquinas',
            'librosDevolver',
            'librosAlquilados',
            'libros',
            'usuarios',
            'htmlLibrosDevolver'
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
