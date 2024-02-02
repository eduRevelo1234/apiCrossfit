<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;
    protected $fillable = [
        'cl_nombre',
        'cl_fecha',
        'cl_hora',
        'cl_maximo',
        'cl_actual',
        'cl_rt_code',
    ];
}
