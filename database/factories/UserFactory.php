<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $indonesianNames = [
            'Budi Santoso', 'Siti Rahayu', 'Ahmad Wijaya', 'Dewi Lestari', 
            'Eko Prasetyo', 'Rina Wati', 'Joko Susilo', 'Ani Kusuma', 
            'Agus Setiawan', 'Maya Indah', 'Dian Permata', 'Hendra Gunawan',
            'Ratna Sari', 'Bambang Sutrisno', 'Wati Suryani', 'Adi Nugroho',
            'Sri Wahyuni', 'Rudi Hermawan', 'Lina Kartika', 'Dedi Kurniawan'
        ];
        
        static $nameIndex = 0;
        $name = $indonesianNames[$nameIndex % count($indonesianNames)];
        $nameIndex++;
        
        return [
            'name' => $name,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => $this->faker->randomElement(['admin','janitor','user']),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
