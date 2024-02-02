<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'sc_finicio',
        'sc_ffin',
        'sc_estado',
        'sc_observacion',
        'sc_periodo',
        'sc_us_codigo',
        'sc_pl_codigo',
    ];
}
