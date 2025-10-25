<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';
    protected $primaryKey = 'id'; // Nama tabel di database

    protected $fillable = [
        'kode_perusahaan',
        'nama_perusahaan',
        'alamat',
        'telepon',
        'email',
        'deskripsi',
        'website',
        'logo_path',
    ];

    // Definisikan relasi: Satu perusahaan bisa memiliki banyak lowongan
    public function lowongan()
    {
        return $this->hasMany(Lowongan::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->kode_perusahaan)) {
                $model->kode_perusahaan = 'PR' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
