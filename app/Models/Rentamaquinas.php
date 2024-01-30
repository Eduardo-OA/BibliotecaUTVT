<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentamaquinas extends Model
{
    use HasFactory;
    protected $fillable = [
        'usuario_id',
        'maquina_id',
        'hora_inicio',
        'hora_final'
    ];

    public function User() {
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function Maquinas() {
        return $this->belongsTo(Maquinas::class,'maquina_id');
    }
   
}
