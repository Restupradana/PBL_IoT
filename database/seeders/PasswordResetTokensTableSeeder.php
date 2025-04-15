<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasswordResetTokensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('password_reset_tokens')->insert([
            [
                'email' => 'admin@example.com',
                'token' => \Str::random(60),
                'created_at' => now(),
            ],
            [
                'email' => 'user@example.com',
                'token' => \Str::random(60),
                'created_at' => now(),
            ],
            [
                'email' => 'petugas@example.com',
                'token' => \Str::random(60),
                'created_at' => now(),
            ],
        ]);
    }
}
