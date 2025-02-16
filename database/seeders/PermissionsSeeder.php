<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
  public function run(): void
  {
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    $permissions = [
      'create announcement',
      'edit announcement',
      'delete announcement',

      'view server metric',

      'create password',
      'edit password',
      'delete password',

      'create device',
      'edit device',
      'delete device',

      'create category',
      'edit category',
      'delete category',

      'create inventory',
      'edit inventory',
      'delete inventory',

      'create cabinet',
      'edit cabinet',
      'delete cabinet',
    ];

    foreach ($permissions as $permission) {
      Permission::create(['name' => $permission]);
    }

    $user = Role::create(['name' => 'user']);
    $helper = Role::create(['name' => 'helper']);
    $admin = Role::create(['name' => 'admin']);

    $helper->givePermissionTo(['create announcement', 'create password', 'create device', 'create category', 'create inventory', 'create cabinet', 'view server metric']);
    $admin->givePermissionTo(Permission::all());
  }
}
