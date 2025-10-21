<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLowonganKerjaTable extends Migration
{
    public function up()
    {
        Schema::create('lowongan_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('judul_lowongan');
            $table->text('deskripsi');
            $table->string('nama_perusahaan');
            $table->string('alamat_perusahaan');
            $table->string('kontak_perusahaan');
            $table->date('tanggal_buka');
            $table->date('tanggal_tutup');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lowongan_kerja');
    }
}
