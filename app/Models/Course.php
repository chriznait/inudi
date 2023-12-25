<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable=[
        'nombreCurso',
        'abrCurso',
        'descripcionCurso',
        'cupo',
        'fechaInicio',
        'fechaFin',
        'fechaInicioInscripcion',
        'fechaFinInscripcion',
        'estado',
    ];

    protected $attributes = [
        'estado' => '1',
    ];
    
}
