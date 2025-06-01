<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatPembuangan extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'riwayat_pembuangan';

    protected $fillable = [
        'id_tempat_sampah', 'waktu_pembuangan', 'berat_sampah_dibuang', 'jenis_sampah', 'id_pengguna_pembuang'
    ];

    public function tempatSampah()
    {
        return $this->belongsTo(TempatSampah::class, 'id_tempat_sampah');
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna_pembuang');
    }
}
