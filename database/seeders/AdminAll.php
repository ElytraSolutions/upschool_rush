<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
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

        DB::table('admin_menu')->truncate();
        DB::table('admin_menu')->insert([
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => 'Dashboard',
                'icon'      => 'icon-chart-bar',
                'uri'       => '/',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => 'Manage',
                'icon'      => 'icon-bullseye',
                'uri'       => null,
            ],
            [
                'parent_id' => 0,
                'order'     => 3,
                'title'    => 'Admin',
                'icon'     => 'icon-server',
                'uri'      => null,
            ],
            [
                'parent_id' => 0,
                'order'     => 4,
                'title'     => 'Helpers',
                'icon'      => 'icon-cogs',
                'uri'       => null,
            ],
        ]);
        $manageMenu = DB::table('admin_menu')->where('title', 'Manage')->first(['id']);
        DB::table('admin_menu')->insert([
            [
                'parent_id' => $manageMenu->id,
                'order'     => 10,
                'title'     => 'Rich Content',
                'icon'      => 'icon-edit',
                'uri'       => '/rich-content',
            ],
            [
                'parent_id' => $manageMenu->id,
                'order'     => 15,
                'title'     => 'Courses',
                'icon'      => 'icon-edit',
                'uri'       => '/courses',
            ],
            [
                'parent_id' => $manageMenu->id,
                'order'     => 20,
                'title'     => 'Chapters',
                'icon'      => 'icon-edit',
                'uri'       => '/chapters',
            ],
            [
                'parent_id' => $manageMenu->id,
                'order'     => 25,
                'title'     => 'Lessons',
                'icon'      => 'icon-edit',
                'uri'       => '/lessons',
            ],
            [
                'parent_id' => $manageMenu->id,
                'order'     => 30,
                'title'     => 'Lesson Sections',
                'icon'      => 'icon-edit',
                'uri'       => '/lesson-sections',
            ],
            [
                'parent_id' => $manageMenu->id,
                'order'     => 32,
                'title'     => 'Lesson Section Contents',
                'icon'      => 'icon-edit',
                'uri'       => '/lesson-section-contents',
            ],
            [
                'parent_id' => $manageMenu->id,
                'order'     => 35,
                'title'     => 'Course Categories',
                'icon'      => 'icon-edit',
                'uri'       => '/course-categories',
            ],
            [
                'parent_id' => $manageMenu->id,
                'order'     => 40,
                'title'     => 'Books',
                'icon'      => 'icon-edit',
                'uri'       => '/books',
            ],
            [
                'parent_id' => $manageMenu->id,
                'order'     => 45,
                'title'     => 'Projects',
                'icon'      => 'icon-edit',
                'uri'       => '/projects',
            ],
            [
                'parent_id' => $manageMenu->id,
                'order'     => 50,
                'title'     => 'users',
                'icon'      => 'icon-edit',
                'uri'       => '/users',
            ],
            [
                'parent_id' => $manageMenu->id,
                'order'     => 55,
                'title'     => 'User Types',
                'icon'      => 'icon-edit',
                'uri'       => '/user-types',
            ],
        ]);

        $adminMenu = DB::table('admin_menu')->where('title', 'Admin')->first(['id']);
        DB::table('admin_menu')->insert([
            [
                'parent_id' => $adminMenu->id,
                'order'     => 10,
                'title'     => 'Users',
                'icon'      => 'icon-users',
                'uri'       => '/auth/users',
            ],
            [
                'parent_id' => $adminMenu->id,
                'order'     => 15,
                'title'     => 'Roles',
                'icon'      => 'icon-user',
                'uri'       => '/auth/roles',
            ],
            [
                'parent_id' => $adminMenu->id,
                'order'     => 20,
                'title'     => 'Permission',
                'icon'      => 'icon-ban',
                'uri'       => '/auth/permissions',
            ],
            [
                'parent_id' => $adminMenu->id,
                'order'     => 25,
                'title'     => 'Menu',
                'icon'      => 'icon-bars',
                'uri'       => '/auth/menu',
            ],
            [
                'parent_id' => $adminMenu->id,
                'order'     => 30,
                'title'     => 'Operation log',
                'icon'      => 'icon-history',
                'uri'       => '/auth/logs',
            ],
        ]);

        $helpersMenu = DB::table('admin_menu')->where('title', 'Helpers')->first(['id']);
        DB::table('admin_menu')->insert([
            [
                'parent_id' => $helpersMenu->id,
                'order'     => 10,
                'title'     => 'Logs',
                'icon'      => 'icon-font-awesome-logo-full',
                'uri'       => '/helpers/scaffold',
            ],
            [
                'parent_id' => $helpersMenu->id,
                'order'     => 15,
                'title'     => 'Scaffold',
                'icon'      => 'icon-keyboard',
                'uri'       => '/helpers/scaffold',
            ],
            [
                'parent_id' => $helpersMenu->id,
                'order'     => 20,
                'title'     => 'Database terminal',
                'icon'      => 'icon-database',
                'uri'       => '/helpers/terminal/database',
            ],
            [
                'parent_id' => $helpersMenu->id,
                'order'     => 25,
                'title'     => 'Laravel artisan',
                'icon'      => 'icon-terminal',
                'uri'       => '/helpers/terminal/artisan',
            ],
            [
                'parent_id' => $helpersMenu->id,
                'order'     => 30,
                'title'     => 'Routes',
                'icon'      => 'icon-list-alt',
                'uri'       => '/helpers/routes',
            ]
        ]);
    }
}
