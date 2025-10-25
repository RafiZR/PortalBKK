<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; // Jika Anda ingin mengimplementasikan verifikasi email
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Asumsi Anda menggunakan Laravel Sanctum untuk API

class User extends Authenticatable // implements MustVerifyEmail // Uncomment ini jika Anda ingin mengimplementasikan verifikasi email
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nik', // Ditambahkan
        'email',
        'no_hp_wa', // Ditambahkan
        'tempat_lahir',
        'tanggal_lahir',
        'umur', // Ditambahkan (meskipun otomatis, seringkali tetap diisi via form/logika)
        'jenis_kelamin',
        'alamat',
        'jurusan',
        'asal_sekolah',
        'tahun_lulus',
        'domisili',
        'npwp', // Ditambahkan
        'bpjs_kesehatan', // Ditambahkan
        'berat_badan', // Ditambahkan
        'tinggi_badan', // Ditambahkan
        'foto_profile', // Ditambahkan
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Untuk Laravel 10+
        'tanggal_lahir' => 'date', // Penting untuk meng-cast tanggal lahir sebagai tanggal
    ];

    // Relasi: User (Siswa) bisa punya banyak lamaran
    // Asumsi ada model Pelamar
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

    /**
     * Accessor untuk menghitung umur berdasarkan tanggal_lahir.
     * Ini akan mengambil nilai `umur` dari database jika ada,
     * atau menghitungnya jika `tanggal_lahir` tersedia dan `umur` kosong.
     * Anda bisa memilih untuk menyimpan 'umur' di DB atau selalu menghitungnya.
     * Jika Anda selalu menghitungnya, Anda bisa menghapus kolom 'umur' dari DB.
     */
    public function getUmurAttribute($value)
    {
        if ($value) {
            return $value; // Menggunakan nilai dari DB jika sudah ada
        }

        if ($this->tanggal_lahir) {
            return $this->tanggal_lahir->diffInYears(\Carbon\Carbon::now());
        }

        return null;
    }

    /**
     * Mutator untuk memastikan 'umur' diisi saat 'tanggal_lahir' diset.
     * Ini adalah salah satu cara untuk mengelola kolom 'umur' yang "otomatis terisi".
     *
     * @param  string  $value
     * @return void
     */
    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = $value;
        if ($value) {
            $this->attributes['umur'] = \Carbon\Carbon::parse($value)->diffInYears(\Carbon\Carbon::now());
        }
    }
}
