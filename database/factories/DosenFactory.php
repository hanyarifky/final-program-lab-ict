<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');
        return [
            'nip' => $this->faker->unique()->numerify('##########'),
            'nama' => $faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'no_telepon' => $this->faker->phoneNumber(),
            'fakultas' => $this->faker->randomElement(['Teknik', 'Ekonomi', 'Kedokteran', 'Ilmu Komputer']),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
}
