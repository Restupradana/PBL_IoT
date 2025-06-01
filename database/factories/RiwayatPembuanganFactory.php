<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TempatSampah;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RiwayatPembuangan>
 */
class RiwayatPembuanganFactory extends Factory
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
            'waktu_pembuangan' => now(),
            'berat_sampah_dibuang' => $this->faker->optional()->randomFloat(2, 0.1, 10),
            'jenis_sampah' => $this->faker->randomElement(["plastik", "residu","metal","organik"]),
            'id_pengguna_pembuang' => User::factory(),
        ];
    }
}
