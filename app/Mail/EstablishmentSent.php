<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EstablishmentSent extends Mailable
{
    use Queueable, SerializesModels;
    public  $establishment;

    /**
     * Create a new message instance.
     */
    public function __construct($establishment)
    {
        $this->establishment =$establishment;
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
       return $this->view('FileManager.Mails.Establishment.Recieve')->with([
        'fname' => $this->establishment->fname,
        'sname' => $this->establishment->sname,
        'ticket' => $this->establishment->ticket,
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
