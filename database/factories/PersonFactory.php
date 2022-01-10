<?php

namespace Database\Factories;

use App\Models\Planet;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'planet_id' => function () {
                return Planet::factory()->create()->id;
            },
            'birth_year' => now()->subYears(20),
            'eye_color' => 'green',
            'gender' => collect(['male', 'female'])->random(),
            'hair_color' => $this->faker->colorName(),
            'height' => rand(160, 185),
            'mass' => rand(60, 90),
            'skin_color' => $this->faker->colorName(),
        ];
    }
}
