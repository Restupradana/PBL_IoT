<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalPengangkutan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pengangkutan';

    protected $fillable = [
        'id_tempat_sampah', 'id_petugas', 'tanggal_pengangkutan', 'status_pengangkutan', 'catatan'
    ];

    public function tempatSampah()
    {
        return $this->belongsTo(TempatSampah::class, 'id_tempat_sampah');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas');
    }
}
