<?php

namespace App\Http\Controllers;

use App\Models\Maquinas;
use App\Models\Rentamaquinas;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
date_default_timezone_set('America/Mexico_City');

class RentaMaquinasController extends Controller
{
    public function index()
    {
        //  Logica para mostrar maquinas por isla
        $islas = \DB::SELECT('SELECT isla FROM maquinas GROUP BY isla');
        $maquinas = Maquinas::all();
        $rentas = RentaMaquinas::all();
        $usuarios = User::all()->where('rol_id', 3);
        return view('welcome', compact('islas', 'maquinas', 'rentas', 'usuarios'));
    }

    public function rentarmaquina(Request $request)
    {
        // dd($request->all());

        RentaMaquinas::create(array(
            'usuario_id' => $request->input('usuario_id'),
            'maquina_id' => $request->input('maquina_id'),
            'hora_inicio' => date("H:i"),
        ));

        $maquina = Maquinas::find($request->input('maquina_id'));
        $maquina->estatus = 'O';
        $maquina->save();

        return redirect('/');
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

        return redirect('/');
    }
}
