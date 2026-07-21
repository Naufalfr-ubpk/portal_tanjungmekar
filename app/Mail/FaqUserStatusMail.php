<?php

namespace App\Mail;

use App\Models\Faq;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FaqUserStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $faq;

    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pembaruan Status Pengajuan Pertanyaan Anda',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.faq_user_status',
        );
    }
}