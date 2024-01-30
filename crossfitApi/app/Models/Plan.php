<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'pl_nombre',
        'pl_numero_clase',
        'pl_estado',
        'pl_costo_inscripcion',
        'pl_costo_mensual',
    ];
}
