<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'country' => 'Nepal',
            'date_of_birth' => '1999-01-01',
            'user_type_id' => 1,
            'email' => 'admin@localhost.com',
            'password' => bcrypt('password'),
            'is_admin' => 1,
        ]);
    }
}
