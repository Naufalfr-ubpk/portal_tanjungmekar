<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\InactiveUserNotificationMail;

class CheckInactiveUsers extends Command
{
    protected $signature = 'users:check-inactive';
    protected $description = 'Cek warga yang tidak aktif 30 hari dan kirim email ke Admin & Operator';

    public function handle()
    {
        $inactiveCount = User::where('role', 'user')
            ->where('last_seen_at', '<=', now()->subDays(30))
            ->count();

        if ($inactiveCount > 0) {
            // Kirim ke Admin (Pakai sapaan 'Admin')
            $admin = User::where('role', 'admin')->first();
            if ($admin) {
                Mail::to($admin->email)->send(new InactiveUserNotificationMail($inactiveCount, 'Admin'));
            }

            // Kirim ke Operator (Pakai sapaan 'Operator')
            $operator = User::where('role', 'operator')->first();
            if ($operator) {
                Mail::to($operator->email)
                ->bcc($admin->email) // <-- Tambahin baris ini buat tembusan rahasia ke Admin
                ->send(new InactiveUserNotificationMail($inactiveCount, 'Operator'));
            }

            $this->info("Email dikirim! Total $inactiveCount user tidak aktif.");
        } else {
            $this->info("Semua user masih aktif.");
        }
    }
}