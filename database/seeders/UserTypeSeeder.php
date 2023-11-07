<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_types')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $userTypes = [
            [
                'name' => 'Parent',
            ],
            [
                'name' => 'Student (Over 18)',
            ],
            [
                'name' => 'Student (Under 18)',
            ],
            [
                'name' => 'Teacher',
            ],
        ];
        foreach ($userTypes as $userType) {
            UserType::firstOrCreate($userType);
        }
    }
}
