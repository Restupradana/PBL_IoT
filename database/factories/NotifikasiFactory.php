<?php

namespace Database\Factories;

use App\Models\TempatSampah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notifikasi>
 */
class NotifikasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_tempat_sampah' => TempatSampah::factory(),
            'jenis_notifikasi' => $this->faker->randomElement(['Kapasitas Penuh','Berat Berlebih','Jadwal Pengangkutan','Tempat Sampah Offline']),
            'pesan' => $this->faker->sentence(),
            'waktu_notifikasi' => now(),
            'status_baca' => $this->faker->boolean(),
        ];
    }
}
