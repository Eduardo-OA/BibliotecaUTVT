<?php

namespace App\Http\Controllers;

use App\Models\Carreras;
use Illuminate\Http\Request;

class CarrerasController extends Controller
{
    public function index()
    {

        $carreras = Carreras::all();

        return view('carreras.index', compact('carreras'));
    }

    public function create(Request $request)
    {
        //  Validaciones
        $messages = [
            'nombre.required' => 'Es necesario colocar un nombre a la carrera.',
            'activo.required' => 'Es necesario colocar un estatus inicial de la carrera.'
        ];

        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'activo' => ['required']
        ], $messages);

        if($request->input('activo') === "true"){
            $activo = true;
        }else if($request->input('activo') === "false"){
            $activo = false;
        }

        $carreras = new Carreras([
            'nombre' => $request->input('nombre'),
            'activo' => $activo
        ]);

        $carreras->save();
        return redirect()->route('carreras.index')->with('success', 'Carrera creada exitosamente!');
    }

    public function update(Request $request, $id)
    {
        //  Validaciones
        $messages = [
            'nombre.required' => 'Es necesario colocar un nombre a la carrera.',
            'activo.required' => 'Es necesario colocar un estatus inicial de la carrera.'
        ];

        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'activo' => ['required']
        ], $messages);

        $carrera = Carreras::find($id);

        if($carrera){

            if($request->input('activo') === "true"){
                $activo = true;
            }else if($request->input('activo') === "false"){
                $activo = false;
            }

            $carrera->nombre = $request->input('nombre');
            $carrera->activo = $activo;

            $carrera->save();
            return redirect()->route('carreras.index')->with('success', 'Carrera actualizada exitosamente!');
        }else{
            return redirect()->route('carreras.index')->with('error', 'Algo ocurrio, por favor verifique los datos ingresados!');
        }

    }

    public function destroy($id)
    {
        $carrera = Carreras::findOrFail($id);
        $carrera->delete();
        
        return redirect()->route('carreras.index')->with('success', 'Carrera eliminada exitosamente.');
    }
}
