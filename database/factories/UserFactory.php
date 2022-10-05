<?php

namespace Database\Factories;

use App\Models\Servicios;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $this->faker = Factory::create('es_ES');
        $userSpeciality = $this->faker->randomElement([1,2,3,4]);
        $data =  [       
            'name'              => $this->faker->firstName(),
            'document'          => $this->faker->numerify('########'),
            'last_name'         => $this->faker->lastName(),
            'email'             => $this->faker->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            'user'              => $this->faker->unique()->userName(),
            // 'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password'          => "a1Bz20ydqelm8m1wql21232f297a57a5a743894a0e4a801fc3", //admin
            'telefono'          => $this->faker->phoneNumber(),
            // 'remember_token'    => Str::random(10),
            'rol_id'            => $userSpeciality,
            'created_at'        =>  $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now')
        ];
        if(intval($userSpeciality) == 2 ){
            $idService = Servicios::all()->random()->id;
            // array_push(, );
            $data['idServicio'] = $idService;
        }
        return $data;
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
