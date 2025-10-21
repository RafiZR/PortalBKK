<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    protected $table = 'pelamar';

    protected $fillable = [
        'user_id',
        'lowongan_id',
        'status_lamaran',
        'tanggal_lamar',
    ];

    // Relasi: Pelamar milik satu user (siswa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Pelamar melamar ke satu lowongan kerja
    public function lowonganKerja()
    {
        return $this->belongsTo(LowonganKerja::class, 'lowongan_id');
    }
}
