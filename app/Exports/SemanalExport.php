<?php
  
namespace App\Exports;
  
use App\Models\User;
use App\Models\Maquinas;
use App\Models\Rentamaquinas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
  
class SemanalExport implements FromCollection, WithHeadings, WithEvents
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
        ->whereRaw('WEEK(rentamaquinas.created_at) = WEEK(CURDATE())')
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
  
                $event->sheet->getDelegate()->getStyle('A1:E1')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('FF9400D3');

                        $event->sheet->getColumnDimension('A')->setWidth(30);
                        $event->sheet->getColumnDimension('B')->setWidth(39);
                        $event->sheet->getColumnDimension('C')->setWidth(39);
                        $event->sheet->getColumnDimension('D')->setWidth(15); 
                        $event->sheet->getColumnDimension('E')->setWidth(15); 
 
  
            },
        ];
    }
}