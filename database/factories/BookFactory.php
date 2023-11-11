<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $projects = Project::all();
        $name = explode(" ",$this->faker->name);
        return [
                'title' => $this->faker->catchPhrase,
                'description' => $this->faker->text($maxNbChars=300),
                'teacher_email' => $this->faker->email,
                'first_name' => $name[0],
                'last_name' => $name[1],
                'school_name' => $this->faker->word,
                'country' => $this->faker->country,
                'age' => $this->faker->numberBetween(5,80),
                'path' => $this->faker->url,
                'canva_link' => $this->faker->url,
                 'project_id' => $projects->random(),
                "is_best_seller"=>$this->faker->randomElement(['YES', 'NO']),
                "is_featured"=>$this->faker->randomElement(['YES', 'NO']),
            "active"=>$this->faker->randomElement([0,1]),

        ];
    }
}
