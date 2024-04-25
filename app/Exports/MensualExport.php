<?php
  
namespace App\Exports;
  
use App\Models\User;
use App\Models\Maquinas;
use App\Models\Rentamaquinas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
  
class MensualExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $rentas = Rentamaquinas::select(
            "users.nombre",
            "users.app",
            "users.apm", 
            "rentamaquinas.maquina_id", 
            "rentamaquinas.created_at"
        )
        ->join('users', 'rentamaquinas.usuario_id', '=', 'users.id')
        ->where('users.rol_id', '=', 3)
        ->whereRaw('MONTH(rentamaquinas.created_at) = MONTH(CURDATE())')
        ->get();
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Nombre usuario", "Apellido Paterno","Apellido Materno", "Maquina", "Fecha"];
    }
}