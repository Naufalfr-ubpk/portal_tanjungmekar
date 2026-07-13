<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: "RW 01", "Bank Sampah RW 13"
            $table->enum('type', ['kelurahan', 'rw', 'bank_sampah']); // Kategori lokasi
            $table->decimal('latitude', 10, 8); // Koordinat Garis Lintang
            $table->decimal('longitude', 11, 8); // Koordinat Garis Bujur
            $table->text('description')->nullable(); // Detail tambahan (contoh: Nama Pak RW, dll)
            $table->string('address')->nullable(); // Alamat lengkap kalau ada
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};