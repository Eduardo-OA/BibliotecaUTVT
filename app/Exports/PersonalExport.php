<?php

namespace App\Exports;
  
use App\Models\Rentamaquinas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
  
class PersonalExport implements FromCollection, WithHeadings, WithEvents
{
    protected $parametro1;
    protected $parametro2;

    public function __construct($parametro1, $parametro2)
    {
        $this->parametro1 = $parametro1;
        $this->parametro2 = $parametro2;
    }
  
    /**
    * @return \Illuminate\Support\Collection    
    */
    public function collection()
    {
        return Rentamaquinas::selectRaw('users.nombre AS nombre_usuario, users.app AS apellido_paterno, users.apm AS apellido_materno, rentamaquinas.maquina_id, DATE(rentamaquinas.created_at) AS dia_renta')
        ->selectRaw('COUNT(*) AS total_rentas')
        ->join('users', 'rentamaquinas.usuario_id', '=', 'users.id')
        ->where('users.rol_id', '=', 3)
        ->where('rentamaquinas.created_at', '>=', $this->parametro1)
        ->where('rentamaquinas.created_at', '<', $this->parametro2)
        ->groupBy('users.nombre', 'users.app', 'users.apm', 'rentamaquinas.maquina_id', 'dia_renta')
        ->get();
    
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Nombre usuario", "Apellido Paterno","Apellido Materno", "Maquina", "Fecha","Total de rentas"];
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
