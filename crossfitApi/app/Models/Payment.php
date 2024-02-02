<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'pg_nombre',
        'pg_tipo',
        'pg_fecha',
        'pg_resplado',
        'pg_monto',
        'pg_sc_codigo',
    ];
}
