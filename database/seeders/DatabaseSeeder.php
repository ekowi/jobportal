<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'officer', // Assuming the role is set to 'officer'
        ]);
        $this->call([
            OfficerSeeder::class,
            KandidatSeeder::class,
            LowonganSeeder::class,
            ProgressRekrutmenSeeder::class,
            KategoriSoalSeeder::class,
            SoalSeeder::class,
            KategoriLowonganSeeder::class,
            LowonganSeeder::class,
            InterviewSeeder::class,
            LamarLowonganSeeder::class,
        ]);
    }
}
