<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Jika ada

class User extends Authenticatable
{
    use Notifiable, HasApiTokens; // Sesuaikan dengan use yang ada

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        // Tambahkan kolom-kolom baru di sini
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin', // Tambah ini
        'alamat',
        'jurusan',
        'asal_sekolah',
        'tahun_lulus', // Tambah ini
        'asal_bkk',
        'domisili',
        'no_hp_wa', // Tambah ini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel 10+
    ];

    // Relasi: User (Siswa) bisa punya banyak lamaran
    public function pelamar()
    {
        return $this->hasMany(Pelamar::class);
    }

    // Jika ingin cek role admin atau siswa
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }
}
