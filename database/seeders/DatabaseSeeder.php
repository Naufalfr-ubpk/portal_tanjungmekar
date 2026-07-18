<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Location; // WAJIB NAMBAHIN INI BIAR LOKASI BISA DIBACA
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. AKUN SISTEM
        User::create([
            'name' => 'Admin Naufal',
            'email' => 'naufal@admin.com',
            'password' => Hash::make('portal-tm-2026@#$'),
            'role' => 'admin', 
        ]);

        User::create([
            'name' => 'Operator Kelurahan',
            'email' => 'pakaji@operator.com',
            'password' => Hash::make('operator990#$%'),
            'role' => 'operator', 
        ]);

        // 2. DATA LOKASI AWAL (Dummy yang jadi Data Asli)
        
        // Data Kelurahan
        Location::create([
            'type' => 'kelurahan',
            'title' => 'Kantor Kelurahan Tanjungmekar',
            'manager_label' => 'Lurah',
            'manager_name' => 'Bapak Aji',
            'contact_label' => 'Resepsionis',
            'contact_number' => '0812-XXXX-XXXX',
            'koordinat' => '-6.272770, 107.271302',
            'gmaps_link' => '',
            'gmaps_button_text' => 'Buka di Google Maps',
            'address' => 'Jl. Raya Tanjungmekar No.1, Karawang Barat, Jawa Barat'
        ]);

        // Data RW
        Location::create([
            'type' => 'rw',
            'title' => 'RW 01',
            'manager_label' => 'Ketua RW',
            'manager_name' => 'Bapak Budi',
            'contact_label' => 'Kontak',
            'contact_number' => '0811-XXXX-XXXX',
            'koordinat' => '-6.275000, 107.272000',
            'gmaps_link' => '',
            'gmaps_button_text' => 'Buka di Google Maps',
            'address' => 'Pos Keamanan RW 01, Jalan Pangkalan Perjuangan'
        ]);

        // Data Bank Sampah
        Location::create([
            'type' => 'banksampah',
            'title' => 'Bank Sampah (RW 04)',
            'manager_label' => 'Pengelola',
            'manager_name' => 'Kang Yana',
            'contact_label' => 'Kontak',
            'contact_number' => '0857-XXXX-XXXX',
            'koordinat' => '-6.276500, 107.274000',
            'gmaps_link' => '',
            'gmaps_button_text' => 'Buka di Google Maps',
            'address' => 'Posko Bank Sampah, Jl. Lingkungan RT 02, RW 04 Tanjungmekar'
        ]);
    }
}