<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Cek apakah email terdaftar di database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Jika email ngasal, kasih error
            return back()->withInput($request->only('email'))
                         ->withErrors(['email' => 'Kami tidak dapat menemukan pengguna dengan alamat email tersebut.']);
        }

        // ALIH-ALIH KIRIM EMAIL: Generate Token dan Langsung Lempar ke Halaman Reset Password!
        $token = Password::broker()->createToken($user);
        
        return redirect()->route('password.reset', [
            'token' => $token,
            'email' => $request->email
        ]);
    }
}