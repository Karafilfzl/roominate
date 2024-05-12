<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Create permissions with check
        $permissions = [
            'manage users',
            'manage buildings'
        ];

        foreach ($permissions as $perm) {
            Permission::findOrCreate($perm, 'web'); // This will find or create the permission
        }

        // Create roles and assign existing permissions
        $adminRole = Role::findOrCreate('admin', 'web');
        $adminRole->givePermissionTo($permissions);

        $userRole = Role::findOrCreate('user', 'web');
        $userRole->givePermissionTo(['manage buildings']);

        // Optionally, you might want to create a default admin user here
    }
}
