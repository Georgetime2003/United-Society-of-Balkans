<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class newOrganizationReport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
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
            ->subject('U. S. B. - New Organization Report')
            ->view('mails.newOrganizationReport')
            ->with([
                'organizationName' => $this->data['organizationName'],
                'organizationEmail' => $this->data['organizationEmail'],
                'volunteerName' => $this->data['volunteerName'],
                'volunteerEmail' => $this->data['volunteerEmail'],
            ]);
    }
}
