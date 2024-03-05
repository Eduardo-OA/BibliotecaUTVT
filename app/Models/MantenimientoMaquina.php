<?php

// app/Models/MantenimientoMaquina.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MantenimientoMaquina extends Model
{
    use HasFactory;
    
    protected $table = 'mantenimientomaquina'; // Establece el nombre correcto de la tabla

    protected $fillable = [
        'maquina_id',
        'detalle',
    ];

    public function Maquinas() {
        return $this->belongsTo(Maquinas::class, 'maquina_id');
    }
}

