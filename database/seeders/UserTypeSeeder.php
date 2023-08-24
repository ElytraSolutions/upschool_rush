<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $userTypes = [
            [
                'name' => 'Parent of Student',
            ],
            [
                'name' => 'Student (Over 18)',
            ],
            [
                'name' => 'Student (Under 18)',
            ],
            [
                'name' => 'School Teacher',
            ],
        ];
        DB::table('user_types')->insert($userTypes);
    }
}
