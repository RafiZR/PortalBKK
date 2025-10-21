<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LowonganKerja extends Model
{
    protected $table = 'lowongan_kerja';

    protected $fillable = [
        'judul_lowongan',
        'deskripsi',
        'nama_perusahaan',
        'alamat_perusahaan',
        'kontak_perusahaan',
        'tanggal_buka',
        'tanggal_tutup',
    ];

    // Relasi: Lowongan kerja bisa punya banyak pelamar
    public function pelamar()
    {
        return $this->hasMany(Pelamar::class, 'lowongan_id');
    }
}
