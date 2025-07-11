<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Officer>
 */
class OfficerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locations = ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Yogyakarta', 'Bali'];
        $positions = ['Manager', 'Coordinator', 'Recruiter'];
        return [
            'user_id' => function () {
                // First, create a user if needed
                $user = \App\Models\User::factory()->create();
                return $user->id;
            },
            'nama_depan' => $this->faker->firstName,
            'nama_belakang' => $this->faker->lastName,
            'nik' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'jabatan' => $this->faker->randomElement($positions),
            'atasan_id' => null, // Set to null for top-level officers
            'doh' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'lokasi_penugasan' => $this->faker->randomElement($locations),
            'area' => $this->faker->randomNumber(1),
            'user_create' => 1, // Assuming user with ID 1 is the creator
            'user_update' => 1, // Assuming user with ID 1 is the updater
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
