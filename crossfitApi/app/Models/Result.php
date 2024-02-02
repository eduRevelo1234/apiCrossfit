<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'rl_fecha',
        'rl_observacion',
        'rl_rondas',
        'rl_repeticion',
        'rl_peso',
        'rl_unidad',
        'rl_us_codigo',
        'rl_ej_codigo',
    ];
}
