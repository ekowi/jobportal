<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        $permissions = [
            // Admin permissions
            'manage roles',
            'manage permissions',
            
            // Officer permissions
            'post jobs',
            'update jobs',
            'delete jobs',
            'view jobs',
            'share jobs',
            'view candidates',
            'download candidate data',
            'view psychotest results',
            'update recruitment progress',
            'view recruitment progress',
            'share recruitment progress',
            
            // Kandidat permissions
            'apply jobs',
            'view applied jobs',
            'take tests',
            'update profile',
            'complete application',
            'view job listings'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create admin role with all permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        // Create manager role
        $manager = Role::create(['name' => 'manager']);
        $manager->givePermissionTo([
            'view recruitment progress',
            'share recruitment progress',
            'view jobs',
            'share jobs'
        ]);

        // Create hrga coordinator role
        $hrgaCoordinator = Role::create(['name' => 'hrga coordinator']);
        $hrgaCoordinator->givePermissionTo([
            'post jobs',
            'update jobs',
            'delete jobs',
            'view jobs',
            'view candidates',
            'download candidate data',
            'view psychotest results',
            'update recruitment progress',
            'view recruitment progress'
        ]);

        // Create recruiter role
        $recruiter = Role::create(['name' => 'recruiter']);
        $recruiter->givePermissionTo([
            'post jobs',
            'update jobs',
            'delete jobs',
            'view jobs',
            'view candidates',
            'download candidate data',
            'view psychotest results'
        ]);

        // Create kandidat role
        $kandidat = Role::create(['name' => 'kandidat']);
        $kandidat->givePermissionTo([
            'apply jobs',
            'view applied jobs',
            'take tests',
            'update profile',
            'complete application',
            'view job listings'
        ]);
    }
}
