<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquinas extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'isla'
    ];

    public function Rentamaquinas() {
        return $this->hasMany(Rentamaquinas::class,'maquina_id','id');
    }
}
