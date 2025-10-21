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
        Schema::table('users', function (Blueprint $table) {
            // Kolom-kolom ini akan menjadi NOT NULL, jadi harus diisi saat registrasi
            $table->date('tanggal_lahir')->after('name');
            $table->string('tempat_lahir')->after('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->after('tempat_lahir'); // Tambah ini
            $table->text('alamat')->after('jenis_kelamin');
            $table->string('jurusan')->after('alamat');
            $table->string('asal_scekolah')->after('jurusan');
            $table->string('tahun_lulus')->after('asal_sekolah'); // Tambah ini (string karena bisa '2020' atau '2021/2022')
            $table->enum('asal_bkk', ['smkn 1 cilimus', 'smkn 2 kuningan', 'smkn 5 kuningan', 'smk pertiwi cilimus', 'lainnya'])->after('tahun_lulus');
            $table->enum('domisili', ['kuningan', 'cirebon', 'majalengka', 'cilacap', 'lainnya'])->after('asal_bkk');
            $table->string('no_hp_wa')->after('domisili'); // Tambah ini
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_lahir',
                'tempat_lahir',
                'jenis_kelamin',
                'alamat',
                'jurusan',
                'asal_sekolah',
                'tahun_lulus',
                'asal_bkk',
                'domisili',
                'no_hp_wa'
            ]);
        });
    }
};
