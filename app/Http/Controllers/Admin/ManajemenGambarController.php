<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Cloudinary\Cloudinary; // Pakai SDK asli Cloudinary

class ManajemenGambarController extends Controller
{
    public function index()
    {
        $cloudinaryUrl = Cache::get('hero_image_url');
        
        $hasCustomImage = !empty($cloudinaryUrl);
        $currentImage = $hasCustomImage ? $cloudinaryUrl : asset('images/kelurahan.png');

        return view('admin.manajemen-gambar.index', compact('currentImage', 'hasCustomImage'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate(['cropped_image' => 'required']);

            // Setup Cloudinary Native dengan fallback URL lu (Anti-Gagal di Vercel)
            $cloudinaryUrl = env('CLOUDINARY_URL', 'cloudinary://768151755937498:MMjRJ0_OHOYvpzGESVcBHrvxfMY@hcqjbg1u');
            $cloudinary = new Cloudinary($cloudinaryUrl);

            // Upload langsung pakai SDK asli (Aman 100% nerima Base64 dari Cropper.js)
            $upload = $cloudinary->uploadApi()->upload($request->cropped_image, [
                'folder' => 'portal_tanjungmekar/ui',
                'public_id' => 'hero_image',
                'overwrite' => true,
            ]);

            // Ambil URL aman dari response Cloudinary
            $uploadedFileUrl = $upload['secure_url'];

            // Simpan link URL ke dalam Cache Database TiDB
            Cache::forever('hero_image_url', $uploadedFileUrl);

            return back()->with('success', 'Gambar Hero berhasil diperbarui dan tersimpan aman di Cloudinary!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan gambar: ' . $e->getMessage());
        }
    }

    public function destroy()
    {
        try {
            $cloudinaryUrl = env('CLOUDINARY_URL', 'cloudinary://768151755937498:MMjRJ0_OHOYvpzGESVcBHrvxfMY@hcqjbg1u');
            $cloudinary = new Cloudinary($cloudinaryUrl);
            
            // Hapus gambar fisik dari server Cloudinary
            $cloudinary->uploadApi()->destroy('portal_tanjungmekar/ui/hero_image');
            
            // Hapus link URL dari Cache Database
            Cache::forget('hero_image_url');
            
            return back()->with('success', 'Gambar berhasil dihapus. Kembali menggunakan gambar bawaan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus gambar: ' . $e->getMessage());
        }
    }
}