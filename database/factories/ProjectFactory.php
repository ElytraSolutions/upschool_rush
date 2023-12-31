<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
                'name' => $this->faker->bs,
                'intro' => $this->faker->url,
                'description' => $this->faker->text($maxNbChars=300),
            "active"=>$this->faker->randomElement([0,1]),

        ];
    }
}
