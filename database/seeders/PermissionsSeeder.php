<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'edit books',
            'delete books',
            'create books',
            'edit users',
            'delete users',
            'edit publishers',
            'delete publishers',
            'create publishers',
            'edit categories',
            'delete categories',
            'create categories',
            'edit authors',
            'delete authors',
            'create authors',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $user = Role::create(['name' => 'user']);
        $admin = Role::create(['name' => 'admin']);

        $admin->givePermissionTo(Permission::all());
    }
}
