<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Order;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserTypeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminAll::class);
        $this->call(CourseCategorySeeder::class);
        Project::factory(30)->create();
        Book::factory(200)->create();
        $this->call(CategorySeeder::class);
    }
}
