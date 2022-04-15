<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Score>
 */
class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $school = School::query()->inRandomOrder()->first();
        return [
            'name' => $this->faker->name(),
            'student_number' => '2018' . (string)random_int(0, 99999),
            'school' => $school->id,
            'tasks' => [
                'water' => random_int(0, 5),
                'food' => random_int(0, 5),
                'matchsticks' => random_int(0, 1),
                'flashlight' => random_int(0, 1),
                'first_aid_kit' => random_int(0, 1)
            ]
        ];
    }
}
