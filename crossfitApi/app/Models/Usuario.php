<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
