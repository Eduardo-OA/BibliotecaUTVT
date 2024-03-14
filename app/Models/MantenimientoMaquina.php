<?php

// app/Models/MantenimientoMaquina.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class MantenimientoMaquina extends Model
{
    use HasFactory;
    
    protected $table = 'mantenimientomaquina';

    protected $fillable = [
        'maquina_id',
        'detalle',
        'maquina_eliminada',
    ];

    public function maquina()
    {
        return $this->belongsTo(Maquina::class, 'maquina_id')->withTrashed(); // Relación con posible máquina eliminada
    }
}

