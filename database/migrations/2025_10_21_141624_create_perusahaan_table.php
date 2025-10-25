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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_perusahaan', 6)->unique();
            $table->string('nama_perusahaan');
            $table->string('alamat');
            $table->string('telepon')->nullable(); // Telepon bisa kosong
            $table->string('email')->unique()->nullable(); // Email unik dan bisa kosong
            $table->text('deskripsi')->nullable(); // Deskripsi bisa kosong
            $table->string('website')->nullable(); // Website bisa kosong
            $table->string('logo_path')->nullable(); // Path logo bisa kosong
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
