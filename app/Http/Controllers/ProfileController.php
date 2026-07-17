<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

/**
     * Memperbarui foto profil pengguna (Upload & Crop via Base64).
     */
    public function updateAvatar(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'avatar' => 'required|string',
        ]);

        $user = $request->user();
        
        // Memecah format base64 dari JavaScript
        $image_parts = explode(";base64,", $request->avatar);
        $image_base64 = base64_decode($image_parts[1]);

        // Bikin nama file unik
        $filename = 'avatars/' . uniqid() . '.png';
        
        // Kalau user udah punya foto lokal sebelumnya, hapus yang lama biar server gak penuh
        if ($user->avatar && str_starts_with($user->avatar, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $user->avatar);
            \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
        }

        // Simpan foto baru ke folder storage/app/public/avatars
        \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $image_base64);

        // Update database user
        $user->avatar = '/storage/' . $filename;
        $user->save();

        return response()->json([
            'success' => true, 
            'avatar_url' => asset('storage/' . $filename)
        ]);
    }

    /**
     * Menghapus foto profil kembali ke inisial default.
     */
    public function deleteAvatar(\Illuminate\Http\Request $request)
    {
        $user = $request->user();
        
        if ($user->avatar && str_starts_with($user->avatar, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $user->avatar);
            \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
        }

        $user->avatar = null;
        $user->save();

        return back();
    }

}
