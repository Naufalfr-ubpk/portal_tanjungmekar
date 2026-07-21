<?php

namespace App\Mail;

use App\Models\Faq;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FaqNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $faq;
    public $roleName;

    public function __construct(Faq $faq, $roleName = 'Admin', $isCopy = false)
    {
        $this->faq = $faq;
        $this->roleName = $roleName;
        $this->isCopy = $isCopy;
    }

    public function envelope(): Envelope
    {
        $subjectPrefix = $this->isCopy ? '[COPY] ' : '';
        return new Envelope(
            subject: $subjectPrefix . 'Pemberitahuan: Ada Pengajuan FAQ Baru!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.faq_notification',
        );
    }
}