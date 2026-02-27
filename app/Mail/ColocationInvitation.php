<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Colocation;

class ColocationInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $colocation;
    public $acceptUrl;

    public function __construct(Colocation $colocation, $token)
    {
        $this->colocation = $colocation;
        $this->acceptUrl = url('/invitations/' . $token . '/accept');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You have been invited to join: ' . $this->colocation->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invitation',
        );
    }
}
