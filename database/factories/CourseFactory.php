<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Trainor;
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
    public function definition()
{
    return [
        'title' => $this->faker->sentence,
        'description' => $this->faker->paragraph,
    ];
}

}
