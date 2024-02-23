<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maquinas;

class MaquinasController extends Controller
{
    public function index()
    {
        //
        $maquinas = Maquinas::all();
        return view('maquinas.index', compact('maquinas'));
    }

    public function store(Request $request)
    {
        $rules = [
            'isla' => 'required',
            'estatus' => 'required',

        ];
        $message = [
            'isla.required' => 'Asignación de la maquina a una isla es requerida',
            'estatus.required' => 'El estatus es requerido',
        ];

        $this->validate($request, $rules, $message);

        $maquina = new Maquinas([
            'isla' => $request->input('isla'),
            'estatus' => $request->input('estatus', 'D')
        ]);

        $maquina->save();
        return redirect()->route('maquinas.index')->with('success', 'Maquina añadida exitosamente');
    }

    mostrarAvisoDevolucion    public function update(Request $request, $id)
    {
        $rules = [
            'isla' => 'required',
            'estatus' => 'required',

        ];
        $message = [
            'isla.required' => 'Asignación de la maquina a una isla es requerida',
            'estatus.required' => 'El estatus es requerido',
        ];

        $this->validate($request, $rules, $message);

        $maquina = Maquinas::find($id);
        //$maquina->update($request->all());
        $maquina->isla = $request->input('isla');
        $maquina->estatus = $request->input('estatus');
        $maquina->save();
        return redirect()->route('maquinas.index')->with('success', 'Maquina actualizada exitosamente.');
    }

    public function destroy(Request $request, $id)
    {
        $maquina = Maquinas::find($id);

        $maquina->delete();
        return redirect()->route('maquinas.index')->with('success', 'Maquina eliminada exitosamente.');
    }

}

