<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';

    protected $fillable = [
        'id_tempat_sampah', 'jenis_notifikasi', 'pesan', 'waktu_notifikasi', 'status_baca'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'waktu_notifikasi' => 'datetime',
        'status_baca' => 'boolean',
    ];

    /**
     * Get the trash bin that owns the notification.
     */
    public function tempatSampah()
    {
        return $this->belongsTo(TempatSampah::class, 'id_tempat_sampah');
    }

    /**
     * Get the read status attribute.
     * 
     * @return bool
     */
    public function getReadAttribute()
    {
        return $this->status_baca;
    }

    /**
     * Get the message attribute.
     * 
     * @return string
     */
    public function getMessageAttribute()
    {
        return $this->pesan;
    }

    /**
     * Get the type attribute based on jenis_notifikasi.
     * 
     * @return string
     */
    public function getTypeAttribute()
    {
        $types = [
            'Kapasitas Penuh' => 'capacity_alert',
            'Berat Berlebih' => 'weight_alert',
            'Jadwal Pengangkutan' => 'schedule_alert',
            'Tempat Sampah Offline' => 'offline_alert'
        ];

        return $types[$this->jenis_notifikasi] ?? 'general_alert';
    }
}