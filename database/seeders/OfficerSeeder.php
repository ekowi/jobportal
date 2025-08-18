<?php

namespace Database\Seeders;

use App\Models\Officer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Spatie\Permission\Models\Role; // Pastikan untuk mengimpor Role

class OfficerSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat roles jika belum ada
        Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'hrga coordinator', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'recruiter', 'guard_name' => 'web']);

        // Create Manager
        $managerUser = User::create([
            'name' => 'HR Manager',
            'email' => 'manager@company.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now()
        ]);
        $managerUser->assignRole('manager');

        $manager = Officer::create([
            'user_id' => $managerUser->id,
            'nama_depan' => 'HR',
            'nama_belakang' => 'Manager',
            'nik' => 'MGR001',
            'jabatan' => 'Manager',
            'atasan_id' => null,
            'doh' => Carbon::now(),
            'lokasi_penugasan' => 'Head Office',
            'area' => 'Pusat', // DITAMBAHKAN
            'is_active' => true,
            'user_create' => 1
        ]);

        // Create HRGA Coordinator
        $hrgaUser = User::create([
            'name' => 'HRGA Coordinator',
            'email' => 'hrga@company.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now()
        ]);
        $hrgaUser->assignRole('hrga coordinator');

        $coordinator = Officer::create([
            'user_id' => $hrgaUser->id,
            'nama_depan' => 'HRGA',
            'nama_belakang' => 'Coordinator',
            'nik' => 'HRGA001',
            'jabatan' => 'HRGA Coordinator',
            'atasan_id' => $manager->id,
            'doh' => Carbon::now(),
            'lokasi_penugasan' => 'Regional Office Jakarta',
            'area' => 'Jakarta', // DITAMBAHKAN
            'is_active' => true,
            'user_create' => 1
        ]);

        // Create Recruiters for different locations
        $locations = [
            'Jakarta' => 'Regional Office Jakarta',
            'Bandung' => 'Regional Office Bandung',
            'Surabaya' => 'Regional Office Surabaya'
        ];

        foreach ($locations as $area => $location) {
            $recruiterUser = User::create([
                'name' => "Recruiter $area",
                'email' => "recruiter.".strtolower($area)."@company.com", // Dibuat menjadi lowercase agar konsisten
                'password' => bcrypt('password123'),
                'email_verified_at' => now()
            ]);
            $recruiterUser->assignRole('recruiter');

            Officer::create([
                'user_id' => $recruiterUser->id,
                'nama_depan' => 'HR',
                'nama_belakang' => "Recruiter $area",
                'nik' => 'REC' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                'jabatan' => 'Recruiter',
                'atasan_id' => $coordinator->id,
                'doh' => Carbon::now(),
                'lokasi_penugasan' => $location,
                'area' => $area, // DITAMBAHKAN (menggunakan key dari array)
                'is_active' => true,
                'user_create' => 1
            ]);
        }
    }
}