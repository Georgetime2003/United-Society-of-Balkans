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
     private $type = [];
     public function __construct($data, $type)
     {
         $this->data = $data;
         $this->type = $type;
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
                'type' => $this->type,
                'subject' => 'USB - Regenerate Password'
            ]);
    }
}

