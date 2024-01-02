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
        dd($correo->email);
       /* $mailData = [
            'title' => 'Correo de INUDI - Registro al curso',
            'body' => 'Tu registro al curso se ha realizado con exito'.$inscrito->idPersona,
        ];
        
        Mail::to("admin@inudi.edu.pe")->send(new RegistroEmail($inscrito->idPersona));
*/
        //dd($inscrito->idPersona);
    }
}