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
        $maquina = new Maquinas([
            'isla' => $request->input('isla'),
            'estatus' => $request->input('estatus', 'D')
        ]);

        $maquina->save();
        return redirect()->route('maquinas.index')->with('success', 'Maquina añadida exitosamente');
    }

    public function update(Request $request, $id)
    {
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

