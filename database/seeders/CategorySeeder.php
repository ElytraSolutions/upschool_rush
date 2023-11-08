<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            [
                'name' => 'Accepting Differences',
            ],
            [
                'name' => 'Compassion for Others',
            ],
            [
                'name' => 'Empathy',
            ],
            [
                'name' => 'Family',
            ],
            [
                'name' => 'Generosity and Sharing',
            ],
            [
                'name' => 'Hard Work',
            ],
            [
                'name' => 'Honesty and Trust',
            ],
            [
                'name' => 'Loss and Grief',
            ],
            [
                'name' => 'Loyality and Dedication',
            ],
            [
                'name' => 'Peace on Earth',
            ],
            [
                'name' => 'Racism and Injustice',
            ],
            [
                'name' => 'Self-Control',
            ],
            [
                'name' => 'Value and Power of Friendship',
            ],
            [
                'name' => 'Bravery and Courage',
            ],
            [
                'name' => 'Education',
            ],
            [
                'name' => 'Fairness and Equity',
            ],
            [
                'name' => 'Friendships',
            ],
            [
                'name' => 'Growing Up',
            ],
            [
                'name' => 'Holidays and Traditions',
            ],
            [
                'name' => 'Hope for the Future',
            ],
            [
                'name' => 'Perseverance and Persistence',
            ],
            [
                'name' => 'Kindness',
            ],
            [
                'name' => 'Love',
            ],
            [
                'name' => 'Making a Difference',
            ],
            [
                'name' => 'Teamwork and Collaboration',
            ],
            [
                'name' => 'School Live',
            ],

        ];
        foreach ($categories as $category) {
            Category::firstOrCreate($category);
        }
        $categories = Category::all();
        Book::all()->each(function ($book) use ($categories) {
            $end = count($categories);
            $array1 = range(1,$end);
            shuffle($array1);
            $random_categories = array_slice($array1,0,5);
            echo ''.count($random_categories).'\t';
           $book->categories()->attach(
               $random_categories
           );
        });

    }


}
