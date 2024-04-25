<?php
  
namespace App\Exports;
  
use App\Models\User;
use App\Models\Maquinas;
use App\Models\Rentamaquinas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
  
class CarreraExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $rentas = Rentamaquinas::select(
            "users.carrera",
            \DB::raw('MAX(users.nombre) as nombre'),
            \DB::raw('MAX(users.app) as app'),
            \DB::raw('MAX(users.apm) as apm'),
            \DB::raw('MAX(rentamaquinas.maquina_id) as maquina'),
            \DB::raw('MAX(rentamaquinas.created_at) as fecha')
        )
        ->join('users', 'rentamaquinas.usuario_id', '=', 'users.id')
        ->groupBy('users.carrera')
        ->get();
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Carrera","Nombre usuario", "Apellido Paterno","Apellido Materno","Carrera","Maquina", "Fecha"];
    }
}