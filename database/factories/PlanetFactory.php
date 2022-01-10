<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlanetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "Planet " . $this->faker->name(),
            'diameter' => rand(10, 20),
            'orbital_period' => 'unknown',
            'rotation_period' => 'unknown',
            'gravity' => 'unknown',
            'population' => 'unknown',
            'climate' => 'unknown',
            'terrain' => 'unknown',
            'surface_water' => 'unknown',
        ];
    }
}
