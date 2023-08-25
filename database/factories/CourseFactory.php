<?php

namespace Database\Factories;

use App\Models\CourseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'slug' => $this->faker->slug(),
            'intro' => $this->faker->paragraph(),
            'image' => 'https://random.imagecdn.app/800/600',
            'theme' => $this->faker->colorName(),
            'description' => $this->faker->paragraph(),
            'course_category_id' => CourseCategory::all()->random()->id,
        ];
    }
}
