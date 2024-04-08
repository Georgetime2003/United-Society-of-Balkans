<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class registerUSB extends Mailable
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
            ->subject('U. S. B. - New Volunteer')
            ->view('mails.registerUSB')
            ->with([
                'name' => $this->data['name'],
                'surnames' => $this->data['surnames'],
                'password' => $this->data['password'],
                'email' => $this->data['email'],
                'start_date' => $this->data['start_date'],
                'end_date' => $this->data['end_date'],
                'volunteer_code' => $this->data['volunteer_code'],
                'hosting' => $this->data['hosting'],
                'sending' => $this->data['sending'],
                'role' => $this->data['role'],
                'subject' => 'USB - New User'
            ]);
    }
}
