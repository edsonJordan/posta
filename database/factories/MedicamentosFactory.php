<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicamentos>
 */
class MedicamentosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $request->stock_empaque * $request->cantidad_unidades_empaque,
        $cantidad_unidades_empaque  = $this->faker->numberBetween(1,50);
        $stock_empaques             = $this->faker->numberBetween(2,50);
        $stock_unidades             = $cantidad_unidades_empaque * $stock_empaques;

        return [
            'precio_unidad'             =>   $this->faker->numerify('#.##'),
            'precio_empaque'            =>   $this->faker->numerify('###.##'),
            'cantidad_unidades_empaque' =>   $cantidad_unidades_empaque,
            'stock_empaque'             =>   $stock_empaques,
            'stock_unidades'            =>   $stock_unidades,
        ];
    }
}
