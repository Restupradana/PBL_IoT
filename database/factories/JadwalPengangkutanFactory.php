<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JadwalPengangkutan>
 */
class JadwalPengangkutanFactory extends Factory
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
            'id_petugas' => Pengguna::factory()->state(['peran' => 'Petugas Kebersihan']),
            'tanggal_pengangkutan' => $this->faker->date(),
            'status_pengangkutan' => $this->faker->randomElement(['Terjadwal','Selesai','Dibatalkan']),
            'catatan' => $this->faker->optional()->sentence(),
        ];
    }
}
