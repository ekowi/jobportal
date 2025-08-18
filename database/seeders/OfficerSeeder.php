<?php

namespace Database\Seeders;

use App\Models\Officer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class OfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Recruiter' => 'Recruiter',
            'HRGA Coordinator Area' => 'HRGA Coordinator Area',
            'Manager' => 'Manager',
        ];

        foreach ($roles as $roleName => $jabatan) {
            $officer = Officer::factory()->create([
                'atasan_id' => null,
                'jabatan' => $jabatan,
            ]);

            $officer->user->assignRole($roleName);
        }
    }
}
