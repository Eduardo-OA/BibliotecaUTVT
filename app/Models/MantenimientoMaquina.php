<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MantenimientoMaquina extends Model
{
    use HasFactory;
    protected $fillable = [
        'maquina_id',
        'detalle',
    ];
    
    public function Maquinas() {
        return $this->belongsTo(Maquinas::class,'maquina_id');
    }
}
