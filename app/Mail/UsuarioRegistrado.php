<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Inertia\Inertia;

class UsuarioRegistrado extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user=$user;
    }

    /**
     * Get the message envelope.
     */



    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Usuario Registrado',
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

    public function build()
    {
        return $this->view('emails.CorreoRegistro')->with([
            'username' => $this->user->name,
            'email' => $this->user->email,
            'password' => $this->user->password,
            'Imagen'=>asset('img/IconoTec.png')
        ])
        ->subject('Bienvenido al SII CENIDET');
    }

}
