<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diagnostico>
 */
class DiagnosticoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'motivo'            =>  $this->faker->word(20),
            'antecedentes'      =>  $this->faker->text(50),
            'tiempo_enfermedad' =>  $this->faker->numberBetween(1,100),
            'alergias'          =>  $this->faker->text(100),
            'intervenciones'    =>  $this->faker->word(20),
            'vacunas'           =>  $this->faker->randomElement([1,2]),
            'examen'            =>  $this->faker->word(20),
            'diagostico'        =>  $this->faker->text(140),
            'tratamiento'       =>  $this->faker->text(40),
            'tipo_diagnostico'  =>  $this->faker->randomElement([1,2,3]),
            'estado'            =>  2,
        ];
    }
}
