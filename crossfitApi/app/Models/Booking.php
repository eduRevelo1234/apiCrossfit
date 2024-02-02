<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'rs_asistencia',
        'rs_us_codigo',
        'rs_cl_codigo',
    ];
}
