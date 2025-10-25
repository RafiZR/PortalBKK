<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name');
            $table->string('nik')->unique(); // NIK wajib dan unik
            $table->string('email')->unique(); // Email wajib dan unik
            $table->string('no_hp_wa'); // Nomor HP wajib
            $table->string('tempat_lahir'); // Tempat lahir wajib
            $table->date('tanggal_lahir'); // Tanggal lahir wajib
            $table->string('umur'); // umur otomatis terisi ketika sudah mengisi tanggal lahir
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Jenis kelamin wajib
            $table->text('alamat'); // Alamat wajib
            $table->string('jurusan'); // Jurusan wajib
            $table->string('asal_sekolah'); // Asal sekolah wajib
            $table->string('tahun_lulus'); // Tahun lulus wajib
            $table->enum('domisili', ['Kuningan', 'Cirebon']); // Domisili wajib
            $table->string('npwp'); // NPWP wajib
            $table->string('bpjs_kesehatan'); // BPJS Kesehatan wajib
            $table->string('berat_badan')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('foto_profile')->nullable();
            $table->timestamp('email_verified_at')->nullable(); // Ini tetap nullable karena verifikasi email bisa dilakukan nanti
            $table->string('password'); // Password wajib
            $table->enum('role', ['admin', 'siswa'])->default('siswa'); // Role dengan default 'siswa'
            $table->rememberToken(); // Untuk fitur "remember me"
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
