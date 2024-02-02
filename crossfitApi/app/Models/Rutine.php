<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutine extends Model
{
    use HasFactory;
    protected $fillable = [
        'rt_nombre',
        'rt_descripcion',
    ];
}
