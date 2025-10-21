<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelamarTable extends Migration
{
    public function up()
    {
        Schema::create('pelamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lowongan_id')->constrained('lowongan_kerja')->onDelete('cascade');
            $table->enum('status_lamaran', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->date('tanggal_lamar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelamar');
    }
}
