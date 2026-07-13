<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleController extends Controller
{
    // Mengarahkan user ke halaman login Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Menangani kembalian data dari Google setelah user login/daftar
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah email user sudah ada di database
            $existingUser = User::where('email', $googleUser->getEmail())->first();

            if ($existingUser) {
                // Kalau udah ada (Otomatis Log In)
                $existingUser->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
                Auth::login($existingUser);
            } else {
                // Kalau belum ada (Otomatis Sign Up)
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'role' => 'user', // Set default role warga
                    'password' => null // Password kosongin aja
                ]);
                Auth::login($newUser);
            }

            return redirect()->intended('dashboard');

        } catch (Exception $e) {
            return redirect('/login')->withErrors(['email' => 'Gagal login menggunakan Google. Silakan coba lagi.']);
        }
    }
}