<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManajemenGambarController extends Controller
{
    public function index()
    {
        // Cek apakah ada custom gambar di storage
        $hasCustomImage = Storage::disk('public')->exists('ui/hero_image.png');
        
        // Kasih parameter time() biar browser gak nge-cache gambar lama pas habis diupdate
        $currentImage = $hasCustomImage ? asset('storage/ui/hero_image.png') . '?v=' . time() : asset('images/kelurahan.png');

        return view('admin.manajemen-gambar.index', compact('currentImage', 'hasCustomImage'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate(['cropped_image' => 'required']);

            // Decode base64 dari Cropper.js
            $image_parts = explode(";base64,", $request->cropped_image);
            $image_base64 = base64_decode($image_parts[1]);

            // Simpan/Timpa ke storage/app/public/ui/hero_image.png
            Storage::disk('public')->put('ui/hero_image.png', $image_base64);

            return back()->with('success', 'Gambar Hero berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan gambar: ' . $e->getMessage());
        }
    }

    public function destroy()
    {
        try {
            if (Storage::disk('public')->exists('ui/hero_image.png')) {
                Storage::disk('public')->delete('ui/hero_image.png');
            }
            return back()->with('success', 'Gambar berhasil dihapus. Kembali menggunakan gambar bawaan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus gambar: ' . $e->getMessage());
        }
    }
}