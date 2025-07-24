<?php
namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;



use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailables\Headers;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Header\UnstructuredHeader;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        //
        $this->user = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // subject: 'Contact Form Mail',
           from: new Address(address: $this->user['email']),
           replyTo:[
            new Address($this->user['email'],$this->user['fullname']),
            new Address('tumuhimiseallan@gmail.com','Allan Tomuhimise')
           ],
           subject:  $this->user['subject'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'template.client.contactform',
        );
    }

    public function build()
    {
        return $this->from('noreply@domain.com')
            ->markdown('template.client.contactform')
            ->attachFromStorage($this->user['screenshoot'])
            ->with([
                'subject'      => $this->user['subject'],
                'message'      => $this->user['message'],
                'email'        => $this->user['email'],
                'telephone' => $this->user['telephone'],
                'fullname'     => $this->user['fullname'],
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
