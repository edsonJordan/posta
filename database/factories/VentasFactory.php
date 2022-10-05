<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ventas>
 */
class VentasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sub_total'         =>  $this->faker->numerify('#####.##'),
            'igv'               =>  $this->faker->numerify('#.#'),
            'tipo_pago'         =>  $this->faker->randomElement([1,2]),
            'estado'            =>  $this->faker->randomElement([1,2]),
            'tipo_paciente'     =>  $this->faker->randomElement([1,2]),
            'created_at'        =>  $this->faker->dateTimeBetween($startDate = '-40 days', $endDate = 'now')
        ];
    }
}
