<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            return (new MailMessage)
                ->subject('Pemberitahuan Reset Password - Portal Tanjungmekar')
                ->greeting('Halo!')
                ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.')
                ->action('Reset Password', route('password.reset', ['token' => $token, 'email' => $notifiable->getEmailForPasswordReset()]))
                ->line('Link reset password ini akan kedaluwarsa dalam 60 menit.')
                ->line('Jika Anda tidak meminta reset password, abaikan email ini dan akun Anda akan tetap aman.')
                ->salutation('Salam Hangat, Admin Tanjungmekar');
        });
    }
}