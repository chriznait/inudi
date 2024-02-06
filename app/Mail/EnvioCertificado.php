<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use App\Models\Registered;
use App\Models\Person;
use App\Models\Course;

class EnvioCertificado extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    /**
     * Create a new message instance.
     */
    public function __construct($mailData)
    {
        $this->id = $mailData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('admin@inudi.edu.pe','INUDI - PERU'),
            subject: 'INUDI - ENVIO DE CERTIFICADO',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $registro = Registered::where('id', '=', $this->id)->first();
        $persona = Person::find($registro->idPersona);
        //$registroPer = Registered::where('idPersona', '=', $this->idPersona)->first();
        $curso = Course::find($registro->idCurso);

        return new Content(
            view: 'emails.certificado',
            with: [
                'persona' => $persona,
                'curso' => $curso,
                'matricula'=> $registro,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $nombre = Registered::where('id', '=', $this->id)->first();
        $archivo = $nombre->codigoCertificado;
        //dd(public_path('certificados/'.$archivo.'.pdf'));
        return [
            //Attachment::fromStorage('path/to/file'),
            Attachment::fromPath('certificados/'.$archivo.'.pdf')
            ->withMime('application/pdf')
            ->as($archivo.'.pdf'),
        ];
    }
}
