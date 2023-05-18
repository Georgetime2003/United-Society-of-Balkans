<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class registerOrganization extends Mailable
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

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->from('familiajordiescarra@gmail.com', 'Jordi Escarrà')
            ->subject('U. S. B. - New Registration User')
            ->view('mails.registerOrganization')
            ->with([
                'name' => $this->data['name'],
                'surnames' => $this->data['surnames'],
                'email' => $this->data['email'],
                'organization' => $this->data['organization'],
                'role' => $this->data['role'],
                'subject' => 'USB - New Organization Registration'
            ]);
    }
}
