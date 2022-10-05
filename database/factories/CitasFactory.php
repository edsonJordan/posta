<?php

namespace Database\Factories;

use App\Models\BloquesHorarios;
use App\Models\Servicios;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Citas>
 */
class CitasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     

    public function definition()
    {
        $medico = User::Where('rol_id', 2)->get()->random();
        $paciente = User::Where('rol_id', 4)->get()->random();

        $sis = $this->faker->randomElement([0,1]);
        $data = [                
                'idMedico'          => $medico->id,
                'idPaciente'        => $paciente->id,
                'idHorario'         => BloquesHorarios::all()->random()->id,
                'idServicio'        => $medico->idServicio,
                'observaciones'     => $this->faker->text(120),
                'estado'            => 1,
                //          'fecha'             => $this->faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now'),
                // 'fecha'             => $this->faker->dateTimeBetween($startDate = '-5 years', $endDate = '+40 days'),
                'fecha'             => $this->faker->dateTimeBetween($startDate = '-50 days', $endDate = '+01 days'),
                // 'email_verified_at' => now(),
                'sis'               => 0,
                'prioridad'         => $this->faker->randomElement([0,1]),
                'archivo'           => null
                          
        ];
        if(intval($sis) === 1){
            $data['sis'] = 1;
            // $data['archivo'] = $this->faker->image('public/uploads/archivos', 200, 200, null, false);
        }
        return $data ;

    }
}
