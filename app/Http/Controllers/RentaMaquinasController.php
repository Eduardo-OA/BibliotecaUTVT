<?php

namespace App\Http\Controllers;

use App\Models\Maquinas;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RentaMaquinasController extends Controller
{
    public function index() {
        //  Logica para mostrar maquinas por isla
        $islas = \DB::SELECT('SELECT isla FROM maquinas GROUP BY isla');
        $maquinas = Maquinas::all();
        
        return view('welcome', compact('islas', 'maquinas'));
    }
}
