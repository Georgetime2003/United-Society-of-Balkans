<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     private $data = [];
     public function __construct($data)
     {
         $this->data = $data;
     }
     
    public function build()
    {
        return $this->from('familiajordiescarra@gmail.com', 'Jordi Escarrà')
            ->subject('U. S. B. - Regenarate Password')
            ->view('mails.regeneratePassword')
            ->with([
                'name' => $this->data['name'],
                'surnames' => $this->data['surnames'],
                'password' => $this->data['password'],
                'email' => $this->data['email'],
                'role' => $this->data['role'],
                'subject' => 'USB - Regenerate Password'
            ]);
    }
}

