<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TempatSampah extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'tempat_sampah';

    protected $fillable = [
        'alamat_deskripsi', 'latitude', 'longitude', 'kapasitas_maksimal',
        'berat_maksimal', 'kapasitas_saat_ini', 'berat_saat_ini', 'status', 'terakhir_diperbarui'
    ];

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'id_tempat_sampah');
    }

    public function jadwalPengangkutan()
    {
        return $this->hasMany(JadwalPengangkutan::class, 'id_tempat_sampah');
    }

    public function riwayatPembuangan()
    {
        return $this->hasMany(RiwayatPembuangan::class, 'id_tempat_sampah');
    }
}
