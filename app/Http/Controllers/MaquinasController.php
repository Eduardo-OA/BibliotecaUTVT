<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maquinas;
use App\Models\MantenimientoMaquina;



class MaquinasController extends Controller
{
    public function index()
    {
        //
        $maquinas = Maquinas::all();
        $mant = MantenimientoMaquina::all();
        return view('maquinas.index', compact('maquinas', 'mant'));
    }

    public function store(Request $request)
    {
        $rules = [
            'isla' => 'required',
            'estatus' => 'required',
            'alias' => 'required',

        ];
        $message = [
            'isla.required' => 'Asignación de la maquina a una isla es requerida',
            'estatus.required' => 'El estatus es requerido',
            'alias.required' => 'Agregue un alias a la maquina',
        ];

        $this->validate($request, $rules, $message);

        $maquina = new Maquinas([
            'isla' => $request->input('isla'),
            'estatus' => $request->input('estatus', 'Disponible'),
            'alias' => $request->input('alias'),
        ]);

        $maquina->save();

        $nmaquinas = Maquinas::count();
        $estado = $request->input('estatus');

        if($estado == 'M'){
            $mdetalles = new MantenimientoMaquina([
                'maquina_id' => $nmaquinas,
                'detalle' => $request->input('detalle_mantenimiento')
            ]);
            $mdetalles->save();
        }
        
        return redirect()->route('maquinas.index')->with('success', 'Maquina añadida exitosamente');
    }

    public function update(Request $request, $id)
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

        $estado = $request->input('estatus');

        if($estado == 'M'){
            $mdetalles = new MantenimientoMaquina([
                'maquina_id' => $maquina->id,
                'detalle' => $request->input('detalle_mantenimiento')
            ]);
            
            $mdetalles->save();
        }

        return redirect()->route('maquinas.index')->with('success', 'Maquina actualizada exitosamente.');
    }

    public function destroy(Request $request, $id)
    {
        // Obtener la máquina que se va a eliminar
        $maquina = Maquinas::findOrFail($id);
        MantenimientoMaquina::where('maquina_id', $id)->update(['id_maquina_eliminada' => $id]);

        // Marcar la máquina como eliminada o cambiar su estado según tus necesidades
        $maquina->delete();
        // Actualizar el estatus o hacer cualquier otro cambio necesario
        // Actualizar los registros de MantenimientoMaquina relacionados

        return redirect()->route('maquinas.index')->with('success', 'Máquina eliminada exitosamente.');
    }

    public function reportes()
    {
        //
        $maquinas = Maquinas::all();
            $semanal = \DB::select('SELECT DATE(rentamaquinas.created_at) AS dia_renta,
            COUNT(*) AS total_rentas
            FROM rentamaquinas
            JOIN users ON rentamaquinas.usuario_id = users.id
            WHERE users.rol_id = 3
            AND WEEK(rentamaquinas.created_at) = WEEK(CURDATE()) -- Selecciona las rentas de la semana actual
            GROUP BY dia_renta;');
        $mensual =\DB::select('SELECT DATE(rentamaquinas.created_at) AS dia_renta,
        COUNT(*) AS total_rentas
        FROM rentamaquinas
        JOIN users ON rentamaquinas.usuario_id = users.id
        WHERE users.rol_id = 3
        AND MONTH(rentamaquinas.created_at) = MONTH(CURDATE()) -- Selecciona las rentas del mes actual
        GROUP BY dia_renta');
        $cuatrimestral=\DB::select('SELECT DATE(rentamaquinas.created_at) AS dia_renta,
        COUNT(*) AS total_rentas
        FROM rentamaquinas
        JOIN users ON rentamaquinas.usuario_id = users.id
        WHERE users.rol_id = 3
        AND rentamaquinas.created_at >= DATE_SUB(CURDATE(), INTERVAL 4 MONTH) -- Selecciona las rentas de los últimos 4 meses
        GROUP BY dia_renta;');
        $carreras=\DB::select('SELECT users.carrera, COUNT(*) AS total_rentas
        FROM rentamaquinas
        JOIN users ON rentamaquinas.usuario_id = users.id
        GROUP BY users.carrera;');
        return view('maquinas.reportes')
            ->with(['semanal' => $semanal])
            ->with(['mensual'=>$mensual])
            ->with(['carreras'=>$carreras])
            ->with(['cuatrimestral'=>$cuatrimestral]);
    }
}
