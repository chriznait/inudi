<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\RegistroEmail;
use App\Mail\EnvioCertificado;
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

    public function sendCertificado($id)
    {
        //dd($id); 
        $inscrito = Registered::find($id);
        
        $correo = Person::find($inscrito->idPersona);
        $emailPersona =$correo->email;
        /*$mailData = [
            'title' => 'Correo de INUDI - Envio de certificado',
            'body' => 'Puede descargar su certificado en el siguiente link '.$inscrito->idPersona,
        ];*/
        //dd($id);
        Mail::to($emailPersona)->send(new EnvioCertificado($id));
        $registro = Registered::where('id', '=', $id);
        $registro->update([
            'estado' => '8',
            'fechaCertificado' => date('Y-m-d'),
        ]);

        return redirect()->route('certificados.verLista', $inscrito->idCurso)->with('success', 'Se envio el correo exitosamente');

        //dd($inscrito->idPersona);
    }
}