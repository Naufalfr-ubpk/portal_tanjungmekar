<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        Faq::create(['pertanyaan' => 'Bagaimana cara mendaftar akun di Portal Tanjungmekar?', 'jawaban' => 'Klik tombol Sign Up di pojok kanan atas. Anda bisa mendaftar dengan mengetikkan email dan password secara manual, atau menggunakan akun Google.', 'status' => 'dipublikasi', 'is_bawaan' => true, 'nama_penanya' => 'Sistem Web']);
        Faq::create(['pertanyaan' => 'Apa saja jenis sampah yang diterima?', 'jawaban' => 'Warga dapat membawa sampah non-organik (plastik, kardus) dan sampah organik tertentu yang telah dipilah ke lokasi.', 'status' => 'dipublikasi', 'is_bawaan' => true, 'nama_penanya' => 'Sistem Web']);
        Faq::create(['pertanyaan' => 'Apakah data pribadi saya aman?', 'jawaban' => 'Sangat aman. Sistem kami dilengkapi enkripsi password dan privasi ketat.', 'status' => 'dipublikasi', 'is_bawaan' => true, 'nama_penanya' => 'Sistem Web']);
        Faq::create(['pertanyaan' => 'Apa saja fitur yang ada di website portal tanjungmekar?', 'jawaban' => 'Website ini dilengkapi dengan fitur Peta Wilayah, Pusat FAQ, Layanan Pengaduan, dan Dashboard Informasi yang dapat diakses oleh seluruh warga.', 'status' => 'dipublikasi', 'is_bawaan' => true, 'nama_penanya' => 'Sistem Web']);
        Faq::create(['pertanyaan' => 'Bagaimana cara mengganti password?', 'jawaban' => 'Anda dapat menuju halaman Profil, kemudian pilih opsi Ubah Password untuk memperbarui kata sandi Anda.', 'status' => 'dipublikasi', 'is_bawaan' => true, 'nama_penanya' => 'Sistem Web']);
        Faq::create(['pertanyaan' => 'Bagaimana cara mengganti icon profil?', 'jawaban' => 'Buka menu Profil Anda, lalu klik ikon kamera atau tombol Edit pada foto profil untuk mengunggah gambar baru.', 'status' => 'dipublikasi', 'is_bawaan' => true, 'nama_penanya' => 'Sistem Web']);
    }
}