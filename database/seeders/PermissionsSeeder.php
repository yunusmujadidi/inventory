<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list barangs']);
        Permission::create(['name' => 'view barangs']);
        Permission::create(['name' => 'create barangs']);
        Permission::create(['name' => 'update barangs']);
        Permission::create(['name' => 'delete barangs']);

        Permission::create(['name' => 'list barangkeluars']);
        Permission::create(['name' => 'view barangkeluars']);
        Permission::create(['name' => 'create barangkeluars']);
        Permission::create(['name' => 'update barangkeluars']);
        Permission::create(['name' => 'delete barangkeluars']);

        Permission::create(['name' => 'list barangmasuks']);
        Permission::create(['name' => 'view barangmasuks']);
        Permission::create(['name' => 'create barangmasuks']);
        Permission::create(['name' => 'update barangmasuks']);
        Permission::create(['name' => 'delete barangmasuks']);

        Permission::create(['name' => 'list kategoris']);
        Permission::create(['name' => 'view kategoris']);
        Permission::create(['name' => 'create kategoris']);
        Permission::create(['name' => 'update kategoris']);
        Permission::create(['name' => 'delete kategoris']);

        Permission::create(['name' => 'list lokasis']);
        Permission::create(['name' => 'view lokasis']);
        Permission::create(['name' => 'create lokasis']);
        Permission::create(['name' => 'update lokasis']);
        Permission::create(['name' => 'delete lokasis']);

        Permission::create(['name' => 'list mereks']);
        Permission::create(['name' => 'view mereks']);
        Permission::create(['name' => 'create mereks']);
        Permission::create(['name' => 'update mereks']);
        Permission::create(['name' => 'delete mereks']);

        Permission::create(['name' => 'list posisis']);
        Permission::create(['name' => 'view posisis']);
        Permission::create(['name' => 'create posisis']);
        Permission::create(['name' => 'update posisis']);
        Permission::create(['name' => 'delete posisis']);

        Permission::create(['name' => 'list suppliers']);
        Permission::create(['name' => 'view suppliers']);
        Permission::create(['name' => 'create suppliers']);
        Permission::create(['name' => 'update suppliers']);
        Permission::create(['name' => 'delete suppliers']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
