<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EstablishmentHodRecieved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The establishment instance.
     *
     * @var mixed
     */
    public $establishment;

    /**
     * Create a new message instance.
     *
     * @param mixed $establishment
     */
    public function __construct($establishment)
    {
        $this->establishment = $establishment;
    }

    /**

     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'FileManager.Mails.Establishment.HodRecieved',
            with: [
                'fname' => $this->establishment->fname,
                'sname' => $this->establishment->sname,
                'ticket' => $this->establishment->ticket,
                'url' => route('file.activate', ['id' => $this->establishment->id]),
            ]
        );
    }
    public function build()
    {
        return $this->view('FileManager.Mails.Establishment.HodRecieved')->with([
            'fname' => $this->establishment->fname,
            'sname' => $this->establishment->sname,
            'ticket' => $this->establishment->ticket,
            'created_at' => $this->establishment->created_at,
            'url' => route('file.activate', ['id' => $this->establishment->id]),
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
