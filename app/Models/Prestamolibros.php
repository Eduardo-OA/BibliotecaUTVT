<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamolibros extends Model
{
    use HasFactory;
    protected $fillable = [
        'libros_id',
        'usuario_id',
        'fecha_pres',
        'fecha_devo',
        'notas'
    ];
    public function Libro() {
        return $this->belongsTo(Libros::class,'libros_id');
    }

    public function User() {
        return $this->belongsTo(User::class,'usuario_id');
    }
    public function Devolucion($fecha_devo)
    {
        $this->fecha_devo = $fecha_devo;
        $this->save();
    }

}
