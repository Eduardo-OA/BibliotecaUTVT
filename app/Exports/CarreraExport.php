<?php
  
namespace App\Exports;
  
use App\Models\User;
use App\Models\Maquinas;
use App\Models\Rentamaquinas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
  
class CarreraExport implements FromCollection, WithHeadings, WithEvents
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
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
  
                $event->sheet->getDelegate()->getStyle('A1:F1')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('FF9400D3');

                        $event->sheet->getColumnDimension('A')->setWidth(30);
                        $event->sheet->getColumnDimension('B')->setWidth(39);
                        $event->sheet->getColumnDimension('C')->setWidth(39);
                        $event->sheet->getColumnDimension('D')->setWidth(15); 
                        $event->sheet->getColumnDimension('E')->setWidth(15); 
                        $event->sheet->getColumnDimension('F')->setWidth(17);   
  
            },
        ];
    }
}