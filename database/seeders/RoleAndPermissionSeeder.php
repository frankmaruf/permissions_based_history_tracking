<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super = Role::create(['name' => 'super']);
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $viewer= Role::create(['name' => 'viewer']);
        $createPermission = Permission::create(['name' => 'create']);
        $updatePermission = Permission::create(['name' => 'update']);
        $deletePermission = Permission::create(['name' => 'delete']);
        $viewPermission =Permission::create(['name' => 'view']);
        $enablePermission =Permission::create(['name' => 'enable']);
        $disablePermission =Permission::create(['name' => 'disable']);
        $super->givePermissionTo([$createPermission,$updatePermission,$deletePermission,$enablePermission,$disablePermission]);
        $admin->givePermissionTo([$createPermission,$updatePermission,$deletePermission]);
        $editor->givePermissionTo([$createPermission,$updatePermission,$deletePermission]);
        $viewer->givePermissionTo([$viewPermission]);

    }
    
}
