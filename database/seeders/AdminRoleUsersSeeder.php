<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminRoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = DB::table('users')->where('is_admin', 1)->first();
        DB::table('admin_role_users')->insert([
            'role_id' => 1,
            'user_id' => $user->id,
        ]);
    }
}
