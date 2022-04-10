<?php

namespace Database\Factories;

use Bezhanov\Faker\Provider\Educator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\School>
 */
class SchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new Educator($this->faker));
        return [
            'name' => $this->faker->university
        ];
    }
}
