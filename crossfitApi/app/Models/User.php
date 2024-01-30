<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'us_cedula',
        'us_nombre',
        'us_apellidos',
        'us_contraseña',
        'us_estado',
        'us_email',
        'us_fregistro',
        'us_telefono',
        'us_celular',
        'us_fnacimiento',
        'us_direccion',
        'us_sexo',
        'us_rl_codigo',
    ];
}
