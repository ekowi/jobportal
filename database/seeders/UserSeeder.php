<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user with admin role
        $admin = User::create([
            'name' => 'Admin System',
            'email' => 'admin@company.com',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now()
        ]);
        $admin->assignRole('admin');

        // Create kandidat users
        User::factory()->count(5)->create([
            'password' => bcrypt('password123'),
            'email_verified_at' => now()
        ])->each(function ($user) {
            $user->assignRole('kandidat');
        });
    }
}
