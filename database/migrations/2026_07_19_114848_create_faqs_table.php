<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('pertanyaan');
            $table->text('detail_pertanyaan')->nullable(); // Penjelasan opsional dari warga
            $table->text('jawaban')->nullable(); // Nullable karena nunggu dijawab Admin
            $table->string('nama_penanya')->nullable(); // Nama akun yang nanya
            $table->string('email_penanya')->nullable(); // Buat target ngirim email otomatis
            $table->enum('status', ['pending', 'dipublikasi', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
