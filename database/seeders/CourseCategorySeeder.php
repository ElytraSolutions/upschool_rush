<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            [
                'name' => '10-Week Courses',
            ],
            [
                'name' => 'Short Courses',
            ],
            [
                'name' => 'Social Scenarios',
            ],
            [
                'name' => 'Comprehension Corner',
            ],
            [
                'name' => 'Teacher Training',
            ],
        ];
        foreach($categories as $category) {
            CourseCategory::firstOrCreate($category);
        }
    }
}
