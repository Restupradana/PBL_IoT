<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menjalankan seeder UsersTableSeeder
        $this->call([
            UsersTableSeeder::class,
        ]);

        // Jika ingin menambahkan user dummy dengan factory, aktifkan ini:
        // \App\Models\User::factory(10)->create();
    }
}
