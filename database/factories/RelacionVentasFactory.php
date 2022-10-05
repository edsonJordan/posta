<?php

namespace Database\Factories;

use App\Models\Medicamentos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RelacionVentas>
 */
class RelacionVentasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'idProducto'        => Medicamentos::all()->random()->id,
            'cantidad'          => $this->faker->numberBetween($min = 1000, $max = 9000),
            'total'             => $this->faker->numerify('###.##'),
            'tipo'              => $this->faker->randomElement([1.00,2.00])
        ];
    }
}
