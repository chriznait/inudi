<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registered;
use App\Models\Person;

use App\Models\Course;

//1: registrado
//2: matriculado
//3: certificado
//0: eliminado
class RegisteredController extends Controller
{
    
    public function index($id )
    {
        $curso = Course::find($id);
        $inscritos = Registered::join('people', 'people.id', '=', 'registereds.idPersona')
        ->where('registereds.idCurso', '=', $id)
        ->where('registereds.estado', '>=', '1')
        ->get([
            'registereds.id',
            'people.nroDocumento',
            'people.nombre',
            'people.apellido',
            'people.email',
            'people.telefono',
            'registereds.montoPagado',
            'registereds.fechaPago',
            'registereds.fechaMatricula',
            'registereds.estado',
            'registereds.fechaInscripcion']);

        return view('registered.index', [
            'curso' => $curso,
            'inscritos' => $inscritos
        ]);
    }

    public function destroy($id)
    {
        $inscrito = Registered::find($id);
        //dd($inscrito->idPersona);
        $inscrito->update([
            'estado' => '0'
        ]);
        return redirect()->route('registered.index', $inscrito->idCurso)->with('success-destroy', 'Se elimino la inscripcion exitosamente');
    }


    public function matricular($id){

        
        return redirect()->route('mail.send', $id)->with('success', 'Se envio el correo exitosamente');
    }

}
