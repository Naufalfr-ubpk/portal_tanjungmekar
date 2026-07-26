<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_sampahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke warga yang menabung
            $table->foreignId('kategori_sampah_id')->constrained('kategori_sampahs')->onDelete('restrict'); // Relasi ke jenis sampah
            $table->decimal('berat_jumlah', 8, 2); // Cth: 2.50 (KG)
            $table->integer('total_harga'); // Total rupiah yang didapat
            $table->date('tanggal_setor');
            $table->string('status')->default('selesai'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_sampahs');
    }
};