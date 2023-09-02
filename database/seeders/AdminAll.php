<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminAll extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = DB::table('users')->where('is_admin', 1)->first(['id']);

        DB::table('admin_roles')->truncate();
        DB::table('admin_roles')->insert([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);
        $role = DB::table('admin_roles')->where('slug', 'administrator')->first(['id']);

        DB::table('admin_role_users')->truncate();
        DB::table('admin_role_users')->insert([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);

        DB::table('admin_permissions')->truncate();
        DB::table('admin_permissions')->insert([
            [
                'name'        => 'All permission',
                'slug'        => '*',
                'http_method' => '',
                'http_path'   => '*',
            ],
            [
                'name'        => 'Dashboard',
                'slug'        => 'dashboard',
                'http_method' => 'GET',
                'http_path'   => '/',
            ],
            [
                'name'        => 'Login',
                'slug'        => 'auth.login',
                'http_method' => '',
                'http_path'   => "/auth/login\r\n/auth/logout",
            ],
            [
                'name'        => 'User setting',
                'slug'        => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path'   => '/auth/setting',
            ],
            [
                'name'        => 'Auth management',
                'slug'        => 'auth.management',
                'http_method' => '',
                'http_path'   => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
            ],
        ]);
        $permission = DB::table('admin_permissions')->where('slug', '*')->first(['id']);

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert([
            'role_id'       => $role->id,
            'permission_id' => $permission->id,
        ]);
    }
}
