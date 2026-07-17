<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('map_locations', function (Blueprint $table) {
            $table->id();
            // Kategori kotak: kelurahan, banksampah, atau rw
            $table->enum('type', ['kelurahan', 'banksampah', 'rw']); 
            
            $table->string('title'); // Contoh: "Bank Sampah (RW 04)"
            
            // Label dinamis (karena Kelurahan pakai "Lurah:", RW pakai "Ketua RW:")
            $table->string('manager_label')->default('Pengelola'); 
            $table->string('manager_name'); // Contoh: "Kang Yana"
            
            // Label kontak (karena ada "Resepsionis:" dan "Kontak:")
            $table->string('contact_label')->default('Kontak');
            $table->string('contact_number')->nullable();
            
            $table->text('address'); // Detail Lokasi
            
            // Koordinat dengan presisi tinggi buat Google Maps/Leaflet
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('map_locations');
    }
};