<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sessions')->insert([
            [
                'id' => \Str::random(32),
                'user_id' => 1, // ID untuk admin
                'ip_address' => '192.168.1.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'payload' => json_encode(['user' => 'Admin User']),
                'last_activity' => time(),
            ],
            [
                'id' => \Str::random(32),
                'user_id' => 2, // ID untuk regular user
                'ip_address' => '192.168.1.2',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15)',
                'payload' => json_encode(['user' => 'Regular User']),
                'last_activity' => time(),
            ],
            [
                'id' => \Str::random(32),
                'user_id' => 3, // ID untuk petugas
                'ip_address' => '192.168.1.3',
                'user_agent' => 'Mozilla/5.0 (Linux; Android 10)',
                'payload' => json_encode(['user' => 'Petugas User']),
                'last_activity' => time(),
            ],
        ]);
    }
}
