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
            $table->string('type'); // rw, banksampah, kelurahan
            $table->string('title');
            $table->string('manager_label');
            $table->string('manager_name');
            $table->string('contact_label');
            $table->string('contact_number')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->text('address');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};