<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Nambahin Role (Defaultnya 'user' pas ada warga daftar)
            $table->enum('role', ['admin', 'operator', 'user'])->default('user')->after('email');
            
            // Nambahin kolom buat Socialite Google
            $table->string('google_id')->nullable()->after('password');
            $table->string('avatar')->nullable()->after('google_id');
            
            // Bikin password boleh kosong (nullable) karena login Google nggak butuh password
            $table->string('password')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'google_id', 'avatar']);
            $table->string('password')->nullable(false)->change();
        });
    }
};