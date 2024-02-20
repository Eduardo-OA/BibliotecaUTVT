<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Maquinas;
use App\Models\Libros;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RentaMaquinasController extends Controller
{
    public function index() {
        //  Logica para mostrar maquinas por isla
        $islas = \DB::SELECT('SELECT isla FROM maquinas GROUP BY isla');
        // $libros = Libros::all();
        $usuarios = User::all();

           // Obtener los IDs de los libros que están alquilados actualmente
           $librosAlquilados = DB::table('prestamolibros')->pluck('libros_id')->all();

           // Obtener todos los libros que no están en la lista de libros alquilados
           $libros = Libros::whereNotIn('id', $librosAlquilados)->get();

        $maquinas = Maquinas::all();

        return redirect()->route('inicio', compact('islas', 'maquinas','libros','usuarios'));
    }
}
