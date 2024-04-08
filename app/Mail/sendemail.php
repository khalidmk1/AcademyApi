<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendemail extends Mailable
{
    use Queueable, SerializesModels;

    public $requestemail;

    /**
     * Create a new message instance.
     */
    public function __construct($requestemail)
    {
        $this->requestemail = $requestemail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('admin@contact.com', 'John Lennon'),
            subject: $this->requestemail['Subject'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Component.email.sendemail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {


        $attachment = $this->attach($this->requestemail['attachment']->getRealPath(), [
            'as' => $this->requestemail['attachment']->getClientOriginalName(),
            'mime' => $this->requestemail['attachment']->getClientMimeType()
        ]);

        return $attachment;
    }
}
