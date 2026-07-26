<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_sampahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori'); // Cth: Botol Plastik, Kardus, Besi
            $table->string('satuan')->default('KG'); // Cth: KG, Pcs, Liter
            $table->integer('harga_per_satuan'); // Harga dalam Rupiah
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_sampahs');
    }
};