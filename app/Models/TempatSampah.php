<?php

// app/Models/TempatSampah.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempatSampah extends Model
{
    // ... atribut dan relasi lainnya

    // Accessor: Status Berdasarkan Persentase Isi
    public function getStatusAttribute()
    {
        if ($this->persentase_isi >= 80) {
            return 'Penuh';
        } elseif ($this->persentase_isi >= 40) {
            return 'Setengah';
        } else {
            return 'Kosong';
        }
    }
}
