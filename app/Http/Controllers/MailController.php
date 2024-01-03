<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\RegistroEmail;
use App\Models\Registered;
use App\Models\Person;

class MailController extends Controller
{
    public function sendEmail($id)
    {
        //dd($id); 9
        $inscrito = Registered::find($id);
        
        $correo = Person::find($inscrito->idPersona);
        $emailPersona =$correo->email;
        $mailData = [
            'title' => 'Correo de INUDI - Registro al curso',
            'body' => 'Tu registro al curso se ha realizado con exito'.$inscrito->idPersona,
        ];
        
        Mail::to($emailPersona)->send(new RegistroEmail($id));
        $registro = Registered::where('id', '=', $id)->first();
        $registro->update([
            'estado' => '2',
            'fechaMatricula' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('registered.index', $inscrito->idCurso)->with('success', 'Se envio el correo exitosamente');

        //dd($inscrito->idPersona);
    }
}