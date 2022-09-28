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
        $createPostPermission = Permission::create(['name' => 'Create Post']);
        $updatePostPermission = Permission::create(['name' => 'Update Post']);
        $deletePostPermission = Permission::create(['name' => 'Delete Post']);
        $viewPostPermission =Permission::create(['name' => 'View Post']);
        $updatePostStatusPermission =Permission::create(['name' => 'Update Post Status']);
        $postHistoryTrack = Permission::create(['name'=>'Track Post History']);
        $super->givePermissionTo([$createPostPermission,$updatePostPermission,$deletePostPermission,$updatePostStatusPermission,$postHistoryTrack]);
        $admin->givePermissionTo([$createPostPermission,$updatePostPermission,$deletePostPermission,$updatePostStatusPermission]);
        $editor->givePermissionTo([$createPostPermission,$updatePostPermission,$deletePostPermission]);
        $viewer->givePermissionTo([$viewPostPermission]);

    }
    
}
