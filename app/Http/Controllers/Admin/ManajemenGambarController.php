<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ManajemenGambarController extends Controller
{
    public function index()
    {
        // Ambil URL gambar dari Cache Database
        $cloudinaryUrl = Cache::get('hero_image_url');
        
        $hasCustomImage = !empty($cloudinaryUrl);
        $currentImage = $hasCustomImage ? $cloudinaryUrl : asset('images/kelurahan.png');

        return view('admin.manajemen-gambar.index', compact('currentImage', 'hasCustomImage'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate(['cropped_image' => 'required']);

            // Cloudinary sangat canggih, dia bisa langsung membaca teks Base64 dari Cropper.js
            // Kita upload dan timpa (overwrite) file di Cloudinary dengan nama ID yang sama
            $uploadedFileUrl = Cloudinary::upload($request->cropped_image, [
                'folder' => 'portal_tanjungmekar/ui',
                'public_id' => 'hero_image',
                'overwrite' => true,
            ])->getSecurePath();

            // Simpan link URL Cloudinary secara permanen ke dalam Cache Database TiDB lu
            Cache::forever('hero_image_url', $uploadedFileUrl);

            return back()->with('success', 'Gambar Hero berhasil diperbarui dan tersimpan aman di Cloudinary!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan gambar: ' . $e->getMessage());
        }
    }

    public function destroy()
    {
        try {
            // Hapus gambar fisik dari server Cloudinary
            Cloudinary::destroy('portal_tanjungmekar/ui/hero_image');
            
            // Hapus link URL dari Cache Database
            Cache::forget('hero_image_url');
            
            return back()->with('success', 'Gambar berhasil dihapus. Kembali menggunakan gambar bawaan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus gambar: ' . $e->getMessage());
        }
    }
}