<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'create lowongan',
            'update lowongan',
            'delete lowongan',
            'view applicant',
            'download applicant',
            'view test result',
            'update progress rekrutmen',
            'review progress rekrutmen',
            'share progress rekrutmen',
            'review lowongan',
            'share lowongan',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $recruiter = Role::firstOrCreate(['name' => 'Recruiter']);
        $recruiter->givePermissionTo([
            'create lowongan',
            'update lowongan',
            'delete lowongan',
            'view applicant',
            'download applicant',
            'view test result',
        ]);

        $hrga = Role::firstOrCreate(['name' => 'HRGA Coordinator Area']);
        $hrga->givePermissionTo([
            'create lowongan',
            'update lowongan',
            'delete lowongan',
            'view applicant',
            'download applicant',
            'view test result',
            'update progress rekrutmen',
        ]);

        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $manager->givePermissionTo([
            'review progress rekrutmen',
            'share progress rekrutmen',
            'review lowongan',
            'share lowongan',
        ]);
    }
}
