<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maquinas;
use App\Models\MantenimientoMaquina;
use Illuminate\Support\Facades\DB;
use App\Exports\SemanalExport;
use App\Exports\MensualExport;
use App\Exports\AnualExport;
use App\Exports\CarreraExport;
use App\Exports\PersonalExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;




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

        if ($estado == 'M') {
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

        if ($estado == 'M') {
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
        $mensual = \DB::select('SELECT DATE(rentamaquinas.created_at) AS dia_renta,
        COUNT(*) AS total_rentas
        FROM rentamaquinas
        JOIN users ON rentamaquinas.usuario_id = users.id
        WHERE users.rol_id = 3
        AND MONTH(rentamaquinas.created_at) = MONTH(CURDATE()) -- Selecciona las rentas del mes actual
        GROUP BY dia_renta');
        $cuatrimestral = \DB::select('SELECT DATE(rentamaquinas.created_at) AS dia_renta,
        COUNT(*) AS total_rentas
        FROM rentamaquinas
        JOIN users ON rentamaquinas.usuario_id = users.id
        WHERE users.rol_id = 3
        AND rentamaquinas.created_at >= DATE_SUB(CURDATE(), INTERVAL 4 MONTH) -- Selecciona las rentas de los últimos 4 meses
        GROUP BY dia_renta;');
        $carreras = \DB::select('SELECT users.carrera, COUNT(*) AS total_rentas
        FROM rentamaquinas
        JOIN users ON rentamaquinas.usuario_id = users.id
        GROUP BY users.carrera;');
        return view('maquinas.reportes')
            ->with(['semanal' => $semanal])
            ->with(['mensual' => $mensual])
            ->with(['carreras' => $carreras])
            ->with(['cuatrimestral' => $cuatrimestral]);
    }



    public function buscar(Request $request)
    {
        //dd($request->all());


        $parametro1 =  $request->input('fecha_inicial');
        $parametro2 =  $request->input('fecha_final');

     
        $maquinas = 'SELECT DATE(rentamaquinas.created_at) AS dia_renta,
        COUNT(*) AS total_rentas
        FROM rentamaquinas
        JOIN users ON rentamaquinas.usuario_id = users.id
        WHERE users.rol_id = 3 AND rentamaquinas.created_at >= ? AND rentamaquinas.created_at < ?
        GROUP BY dia_renta;';

        $resultados = DB::select($maquinas, [$parametro1, $parametro2]);

        //dd($resultados);
        // Procesar los resultados obtenidos
        // foreach ($resultados as $resultado) {
        //     $conteo = $resultado->conteo; // Acceder a la propiedad 'conteo'
        //     $mes = $resultado->mes;
        //      // Acceder a la propiedad 'mes'

        //     echo " $mes,  $conteo <br>";
        // }
        return view("maquinas.buscarsemanal")
        
            ->with(['resultados' => $resultados,
            'parametro1' => $parametro1,
            'parametro2' => $parametro2]);
            
    }



    // public function buscarmensual(Request $request)
    // {
    //     //dd($request->all());


    //     $parametro1 =  $request->input('fecha_inicial');
    //     $parametro2 =  $request->input('fecha_final');

    //     $maquinas = 'SELECT DATE(rentamaquinas.created_at) AS mes_renta,
    //     COUNT(*) AS total_rentas
    //     FROM rentamaquinas
    //     JOIN users ON rentamaquinas.usuario_id = users.id
    //     WHERE users.rol_id = 3 AND rentamaquinas.created_at >= ? AND rentamaquinas.created_at < ?
    //     GROUP BY mes_renta;';

    //     $resultado = DB::select($maquinas, [$parametro1, $parametro2]);

    //     //dd($resultados);
    //     // Procesar los resultados obtenidos
    //     // foreach ($resultados as $resultado) {
    //     //     $conteo = $resultado->conteo; // Acceder a la propiedad 'conteo'
    //     //     $mes = $resultado->mes;
    //     //      // Acceder a la propiedad 'mes'

    //     //     echo " $mes,  $conteo <br>";
    //     // }


    //     return view("maquinas.buscarmensual")
    //         ->with(['resultado' => $resultado]);
    // }



    // public function buscaranual(Request $request)
    // {
    //     //dd($request->all());


    //     $parametro1 =  $request->input('fecha_inicial');
    //     $parametro2 =  $request->input('fecha_final');

    //     $maquinas = 'SELECT DATE(rentamaquinas.created_at) AS cuatri_renta,
    //     COUNT(*) AS total_rentas
    //     FROM rentamaquinas
    //     JOIN users ON rentamaquinas.usuario_id = users.id
    //     WHERE users.rol_id = 3 AND rentamaquinas.created_at >= ? AND rentamaquinas.created_at < ?
    //     GROUP BY cuatri_renta;';

    //     $resultado = DB::select($maquinas, [$parametro1, $parametro2]);

    //     //dd($resultados);
    //     // Procesar los resultados obtenidos
    //     // foreach ($resultados as $resultado) {
    //     //     $conteo = $resultado->conteo; // Acceder a la propiedad 'conteo'
    //     //     $mes = $resultado->mes;
    //     //      // Acceder a la propiedad 'mes'

    //     //     echo " $mes,  $conteo <br>";
    //     // }


    //     return view("maquinas.buscaranual")
    //         ->with(['resultado' => $resultado]);
    // }



    // public function buscarcarrera(Request $request)
    // {
    //     //dd($request->all());


    //     $parametro1 =  $request->input('fecha_inicial');
    //     $parametro2 =  $request->input('fecha_final');

    //     $maquinas =  'SELECT users.carrera as carrera, COUNT(*) AS total_rentas
    //     FROM rentamaquinas
    //     JOIN users ON rentamaquinas.usuario_id = users.id
    //     WHERE rentamaquinas.created_at >= ? AND rentamaquinas.created_at < ?
    //     GROUP BY users.carrera;';

    //     $resultado = DB::select($maquinas, [$parametro1, $parametro2]);

    //     //dd($resultados);
    //     // Procesar los resultados obtenidos
    //     // foreach ($resultados as $resultado) {
    //     //     $conteo = $resultado->conteo; // Acceder a la propiedad 'conteo'
    //     //     $mes = $resultado->mes;
    //     //      // Acceder a la propiedad 'mes'

    //     //     echo " $mes,  $conteo <br>";
    //     // }


    //     return view("maquinas.buscarcarrera")
    //         ->with(['resultado' => $resultado]);
    // }

    public function export() 
    {
        return Excel::download(new SemanalExport, 'Semanal.xlsx');
    }
    public function exportm() 
    {
        return Excel::download(new MensualExport, 'Mensual.xlsx');
    }
    public function exporta() 
    {
        return Excel::download(new AnualExport, 'Cuatrimestral.xlsx');
    }
    public function exportc() 
    {
        return Excel::download(new CarreraExport, 'Carreras.xlsx');
    }
  
    public function exportper($parametro1, $parametro2) 
    {
        return Excel::download(new PersonalExport($parametro1, $parametro2), 'Personalizado.xlsx');
    }
    
  
}
