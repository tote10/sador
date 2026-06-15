<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Generic admin-authored reply. Used for both applicant and contact replies —
 * the admin supplies the subject and body, optionally pre-filled from a template.
 */
class AdminReply extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $recipientName,
        public string $subjectLine,
        public string $bodyContent,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectLine,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-reply',
            with: [
                'recipientName' => $this->recipientName,
                'subjectLine' => $this->subjectLine,
                'bodyContent' => $this->bodyContent,
            ],
        );
    }
}
