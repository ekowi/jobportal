<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kandidat>
 */
class KandidatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                // First, create a user if needed
                $user = \App\Models\User::factory()->state([
                    'role' => 'kandidat'
                ])->create();
                return $user->id;
            },
            'nama_depan' => $this->faker->firstName(),
            'nama_belakang' => $this->faker->lastName(),
            'no_telpon' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'kode_pos' => $this->faker->postcode(),
            'negara' => $this->faker->country(),
            'no_ktp' => $this->faker->unique()->numerify('##########'),
            'no_npwp' => $this->faker->unique()->numerify('###########'),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'status_perkawinan' => $this->faker->randomElement(['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu']),
            'bmi_score' => $this->faker->randomFloat(2, 15, 25),
            'blind_score' => 'normal',
            'no_telpon_alternatif' => $this->faker->phoneNumber(),
            'work_experiences' => [
                ['start' => '2020-01-01', 'end' => '2021-01-01', 'company' => 'ABC', 'business' => 'IT', 'position' => 'Dev', 'reason' => ''],
            ],
            'education_history' => [
                ['start' => '2015-01-01', 'end' => '2019-01-01', 'name' => 'Universitas X', 'major' => 'Teknik', 'level' => 'S1', 'highest' => true],
            ],
            'language_skills' => [
                ['language' => 'Indonesia', 'speaking' => 'Baik', 'reading' => 'Baik', 'writing' => 'Baik'],
            ],
            'kemampuan' => $this->faker->text(),
            'worked_before' => false,
            'previous_work_location' => null,
            'job_info_source' => 'Internet',
            'gender_identity' => 'Lainnya',
            'user_create' => 1, // Assuming user with ID 1 is the creator
            'user_update' => 1, // Assuming user with ID 1 is the updater
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
