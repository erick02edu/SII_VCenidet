<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Nette\Utils\Arrays;
use PhpParser\Node\Expr\Cast\Array_;

class HorarioCreado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $Periodo;
    public $Profesor;

    public function __construct(array $Periodo, array $Profesor)
    {
        $this->Profesor=$Profesor;
        $this->Periodo=$Periodo;
    }



    public function build()
    {


        //dd($this->Periodo);

        return $this->view('emails.NotificacionHorario')->with([
            'Profesor' => $this->Profesor,
            'periodo' => $this->Periodo,
        ])
        ->subject('Horario creado');
    }


    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Horario Creado',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
