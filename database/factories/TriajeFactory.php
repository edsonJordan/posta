<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Triaje>
 */
class TriajeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        return [
            'presion'       =>  $this->faker->numberBetween(1,80),
            'temperatura'   =>  $this->faker->numberBetween(1,70),
            'cardiaca'      =>  $this->faker->numberBetween(1,80),
            'saturacion'    =>  $this->faker->numberBetween(1,100),
            'peso'          =>  $this->faker->numerify('###.###'),
            'cardiaca'      =>  $this->faker->numberBetween(1,80),
            'talla'         =>  $this->faker->numberBetween(1,180),
        ];
    }
}
