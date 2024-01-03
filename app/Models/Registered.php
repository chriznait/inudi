<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registered extends Model
{
    use HasFactory;

    protected $fillable=[
        'idCurso',
        'idPersona',
        'montoPagado',
        'fechaPago',
        'idUsuario',
        'estado',
        'fechaInscripcion',
        'fechaMatricula',
    ];
}
