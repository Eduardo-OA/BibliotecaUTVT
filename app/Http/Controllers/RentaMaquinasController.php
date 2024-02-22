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

        //  Consulta que se muestra unicamente en la tabla de 'Maquinas en renta'
        $rentaTable = \DB::SELECT('SELECT usuario.nombre, usuario.app, usuario.apm, usuario.matricula, maquina.isla, maquina.id AS maquina_id, renta.id, renta.hora_inicio, renta.hora_final 
        FROM rentamaquinas AS renta 
            INNER JOIN users AS usuario ON renta.usuario_id = usuario.id
            INNER JOIN maquinas AS maquina ON renta.maquina_id = maquina.id
        WHERE DATE(renta.updated_at) = CURDATE() ORDER BY renta.hora_inicio DESC');

        //  Consulta que se muestra como la cantidad de rentas activas
        $cantidadMaquinasRenta = count(Rentamaquinas::whereNull('hora_final')->get());

        return view('welcome', compact('islas', 'maquinas', 'rentas', 'usuarios', 'rentaTable', 'cantidadMaquinasRenta'));
    }

    public function rentarmaquina(Request $request)
    {
        // dd($request->all());

        //  Validaciones
        $messages = [
            'usuario_id.required' => 'Es necesario seleccionar un usuario.',
            'maquina_id.required' => 'Es necesario seleccionar una maquina.',
        ];

        $request->validate([
            'usuario_id' => ['required', 'string'],
            'maquina_id' => ['required', 'string'],
        ], $messages);

        RentaMaquinas::create(array(
            'usuario_id' => $request->input('usuario_id'),
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
}
