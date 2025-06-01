<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'phone' => '081234567890',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'role' => 'admin', // Role admin
                'password' => Hash::make('admin123'), // Password terenkripsi
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'phone' => '089876543210',
                'email' => 'user@example.com',
                'email_verified_at' => now(),
                'role' => 'user', // Role user
                'password' => Hash::make('user123'),
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Petugas User',
                'phone' => '087654321098',
                'email' => 'petugas@example.com',
                'email_verified_at' => now(),
                'role' => 'janitor', // Role petugas
                'password' => Hash::make('petugas123'),
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
