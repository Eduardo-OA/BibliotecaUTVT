<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libros extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'autores',
        'genero',
        'editorial',
        'idioma',
        'cantidad',
        'disponibilidad',
        'ubicacion_fisica',
        'fecha_ad'
    ];

    public function Prestamolibros() {
        return $this->hasMany(Prestamolibros::class,'libros_id', 'id');
    }

    
}
