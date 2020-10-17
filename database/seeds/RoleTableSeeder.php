<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Role, App\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([ 'role' => 'superadmin']);
        Role::create([ 'role' => 'editor']);
        Role::create([ 'role' => 'user']);

        Permission::create([ 'permission' => 'user-view']);
        Permission::create([ 'permission' => 'user-create']);
        Permission::create([ 'permission' => 'user-edit']);
        Permission::create([ 'permission' => 'user-delete']);

        Permission::create([ 'permission' => 'post-delete']);
        Permission::create([ 'permission' => 'post-delete']);
        Permission::create([ 'permission' => 'post-delete']);
        Permission::create([ 'permission' => 'post-delete']);

        Permission::create([ 'permission' => 'post-tag']);
    }
}
