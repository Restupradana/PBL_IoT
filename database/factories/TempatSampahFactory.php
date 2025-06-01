<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TempatSampah>
 */
class TempatSampahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $index = 0;
        $schools = [
            [
                'nama_sekolah' => 'SMAN 1 Batam',
                'alamat' => 'Jl. R. Soeprapto No.1, Sungai Harapan, Kec. Sekupang, Kota Batam, Kepulauan Riau 29444',
                'latitude' => 1.1030,
                'longitude' => 103.9560,
            ],
            [
                'nama_sekolah' => 'SMAN 2 Batam',
                'alamat' => 'Jl. Raya Sekanak, Sekanak Raya, Kec. Sekupang, Kota Batam, Kepulauan Riau',
                'latitude' => 1.1025,
                'longitude' => 103.9575,
            ],
            [
                'nama_sekolah' => 'SMAN 3 Batam',
                'alamat' => 'Jl. Hang Nadim, Batu Besar, Kec. Nongsa, Kota Batam, Kepulauan Riau',
                'latitude' => 1.1180,
                'longitude' => 104.1190,
            ],
            [
                'nama_sekolah' => 'SMAN 4 Batam',
                'alamat' => 'Jl. Gajah Mada, Tiban Lama, Kec. Sekupang, Kota Batam, Kepulauan Riau',
                'latitude' => 1.1045,
                'longitude' => 103.9505,
            ],
            [
                'nama_sekolah' => 'SMAN 5 Batam',
                'alamat' => 'Jl. Kavling Lama, Kec. Batu Aji, Kota Batam, Kepulauan Riau',
                'latitude' => 1.0830,
                'longitude' => 104.0000,
            ],
            [
                'nama_sekolah' => 'SMAN 8 Batam',
                'alamat' => 'Bengkong Sadai, Kec. Bengkong, Kota Batam, Kepulauan Riau',
                'latitude' => 1.1005,
                'longitude' => 104.0600,
            ],
            [
                'nama_sekolah' => 'SMAN 9 Batam',
                'alamat' => 'Karas, Galang, Kota Batam, Kepulauan Riau',
                'latitude' => 0.9970,
                'longitude' => 104.1000,
            ],
            [
                'nama_sekolah' => 'SMAN 10 Batam',
                'alamat' => 'Galang Baru, Galang, Kota Batam, Kepulauan Riau 29484',
                'latitude' => 0.9800,
                'longitude' => 104.1200,
            ],
            [
                'nama_sekolah' => 'SMAN 13 Batam',
                'alamat' => 'Kibing, Kec. Batu Aji, Kota Batam, Kepulauan Riau 29424',
                'latitude' => 1.0800,
                'longitude' => 104.0100,
            ],
            [
                'nama_sekolah' => 'SMAN 19 Batam',
                'alamat' => 'Sagulung, Kota Batam, Kepulauan Riau 29425',
                'latitude' => 1.0700,
                'longitude' => 104.0300,
            ],
            [
                'nama_sekolah' => 'SMAN 20 Batam',
                'alamat' => 'Jl. Pemuda, Baloi Permai, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29444',
                'latitude' => 1.1100,
                'longitude' => 104.0300,
            ],
            [
                'nama_sekolah' => 'SMAN 22 Batam',
                'alamat' => 'Pulau Pecong, Belakang Padang, Kota Batam, Kepulauan Riau',
                'latitude' => 1.1500,
                'longitude' => 103.9500,
            ],
            [
                'nama_sekolah' => 'SMAN 23 Batam',
                'alamat' => 'Kibing, Kec. Batu Aji, Kota Batam, Kepulauan Riau 29424',
                'latitude' => 1.0800,
                'longitude' => 104.0100,
            ],
            [
                'nama_sekolah' => 'SMAN 25 Batam',
                'alamat' => 'Jl. Tj. Buntung, Tj. Buntung, Kec. Bengkong, Kota Batam, Kepulauan Riau 29444',
                'latitude' => 1.1100,
                'longitude' => 104.0500,
            ],
            [
                'nama_sekolah' => 'SMAN 26 Batam',
                'alamat' => 'Komplek Botania Garden, Belian, Kec. Batam Kota, Kota Batam, Kepulauan Riau',
                'latitude' => 1.1200,
                'longitude' => 104.0400,
            ],
            [
                'nama_sekolah' => 'SMAS Global Indo-Asia',
                'alamat' => 'Jl. Ahmad Yani, Kav. SGIA, Batam Center, Teluk Tering, Kota Batam, Kepulauan Riau',
                'latitude' => 1.1200,
                'longitude' => 104.0500,
            ],
            [
                'nama_sekolah' => 'SMAS IT Imam Syafii',
                'alamat' => 'Jl. Brigjen Katamso, Batuaji, Kota Batam, Kepulauan Riau',
                'latitude' => 1.0800,
                'longitude' => 104.0000,
            ],
            [
                'nama_sekolah' => 'MAN Insan Cendekia Kota Batam',
                'alamat' => 'Tanjung Piayu, Kec. Sei Beduk, Kota Batam, Kepulauan Riau',
                'latitude' => 1.0700,
                'longitude' => 104.1000,
            ],
            [
                'nama_sekolah' => 'SMA Kartini Batam',
                'alamat' => 'Jl. Kartini, Tanjung Sengkuang, Kec. Batu Ampar, Kota Batam, Kepulauan Riau',
                'latitude' => 1.1200,
                'longitude' => 104.0600,
            ],
            [
                'nama_sekolah' => 'MAS Amanatul Ummah',
                'alamat' => 'Jl. Hang Lekiu, Kota Batam, Kepulauan Riau',
                'latitude' => 1.1300,
                'longitude' => 104.0700,
            ],
        ];

    $school = $schools[$index % count($schools)];
    $index++;
    
    return [
        'nama' => $school['nama_sekolah'],
        'alamat_deskripsi' => $school['alamat'],
        'latitude' => $school['latitude'],
        'longitude' => $school['longitude'],
        'kapasitas_maksimal' => $this->faker->numberBetween(100, 500),
        'berat_maksimal' => $this->faker->randomFloat(2, 10, 100),
        'kapasitas_saat_ini' => $this->faker->numberBetween(0, 500),
        'berat_saat_ini' => $this->faker->randomFloat(2, 0, 100),
        'status' => $this->faker->randomElement(['Normal','Penuh','Berat Berlebih','Offline']),
        'terakhir_diperbarui' => now(),
    ];
    }
}
