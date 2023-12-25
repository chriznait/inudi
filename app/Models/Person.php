<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'nroDocumento',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'profesion',
        'gradoAcademico',
        'idPais',
        'idDepartamento',
        'idProvincia',
        'idDistrito',
    ];

    protected $attributes = [
        'tipoDocumento' => 'DNI',
    ];

}
