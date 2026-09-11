<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Cloudinary\Cloudinary;

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

        // Hapus juga foto profilnya di Cloudinary kalau akunnya dihapus permanen
        if ($user->avatar && !str_starts_with($user->avatar, '/storage/')) {
            try {
                $cloudinaryUrl = env('CLOUDINARY_URL', 'cloudinary://768151755937498:MMjRJ0_OHOYvpzGESVcBHrvxfMY@hcqjbg1u');
                $cloudinary = new Cloudinary($cloudinaryUrl);
                $publicId = 'portal_tanjungmekar/avatars/user_' . $user->id . '_avatar';
                $cloudinary->uploadApi()->destroy($publicId);
            } catch (\Exception $e) {}
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Memperbarui foto profil pengguna (Upload & Crop via Base64 ke Cloudinary).
     */
    public function updateAvatar(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'avatar' => 'required|string',
        ]);

        $user = $request->user();

        try {
            // Setup Native SDK
            $cloudinaryUrl = env('CLOUDINARY_URL', 'cloudinary://768151755937498:MMjRJ0_OHOYvpzGESVcBHrvxfMY@hcqjbg1u');
            $cloudinary = new Cloudinary($cloudinaryUrl);

            // Bikin ID statis per user agar otomatis menimpa (overwrite) foto lama di Cloudinary
            $publicId = 'user_' . $user->id . '_avatar';

            // Upload Base64 langsung ke Cloudinary
            $upload = $cloudinary->uploadApi()->upload($request->avatar, [
                'folder' => 'portal_tanjungmekar/avatars',
                'public_id' => $publicId,
                'overwrite' => true,
            ]);

            // Update database user dengan URL Cloudinary
            $user->avatar = $upload['secure_url'];
            $user->save();

            return response()->json([
                'success' => true, 
                'avatar_url' => $user->avatar
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload gambar: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus foto profil kembali ke inisial default.
     */
    public function deleteAvatar(\Illuminate\Http\Request $request)
    {
        $user = $request->user();
        
        // Cek jika gambar bukan dari /storage/ lokal bawaan Vercel yang udah mati
        if ($user->avatar && !str_starts_with($user->avatar, '/storage/')) {
            try {
                $cloudinaryUrl = env('CLOUDINARY_URL', 'cloudinary://768151755937498:MMjRJ0_OHOYvpzGESVcBHrvxfMY@hcqjbg1u');
                $cloudinary = new Cloudinary($cloudinaryUrl);
                
                // Eksekusi tembak hapus ke server Cloudinary
                $publicId = 'portal_tanjungmekar/avatars/user_' . $user->id . '_avatar';
                $cloudinary->uploadApi()->destroy($publicId);
            } catch (\Exception $e) {
                // Biarkan lanjut reset database meskipun hapus fisik gagal
            }
        }

        // Reset database
        $user->avatar = null;
        $user->save();

        return back();
    }
}