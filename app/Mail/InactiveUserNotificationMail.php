<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InactiveUserNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inactiveCount;
    public $roleName;

    public function __construct($inactiveCount, $roleName)
    {
        $this->inactiveCount = $inactiveCount;
        $this->roleName = $roleName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pemberitahuan: Tinjauan Akun Warga Tidak Aktif',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.inactive_notification',
        );
    }
}