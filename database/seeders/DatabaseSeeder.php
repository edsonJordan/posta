<?php

namespace Database\Seeders;

use App\Models\BloquesHorarios;
use App\Models\Citas;
use App\Models\Diagnostico;
use App\Models\Medicamentos;
use App\Models\RelacionVentas;
use App\Models\Servicios;
use App\Models\Triaje;
use App\Models\User;
use App\Models\Ventas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CitasSeeder::class);

        $servicios = [
            "Anestesiología", "Cirugía Pediátrica", "Ginegología y Obstetricia.", "Hematología", 'Infectología de Adulto',
            "Medicina Aeroespacial", "Medicina de Rehabilitación", 'Medicina Interna', "Nefrología", "Neurología de Adultos",
             "Oftalmología", "Ortopedia", "Otorrinolaringología", 'Pediatría', "Psiquiatría General", "Medicina Crítica", 'Urología',
            "Neumología", "Cirugía Oncológica",
                ];
        
         foreach ($servicios as $servicio) {
        //No cambiable   
            Servicios::factory(1)->create([
                'servicio'  => $servicio,
            ]); 
        }

        $bloquesHorarios = ["08:00 - 08:30", 
                            "09:00 - 09:30", 
                            "10:00 - 10:30", 
                            "11:00 - 11:30", 
                            "12:00 - 12:30", 
                            "13:00 - 13:30",
                            "14:00 - 14:30",
                            "15:00 - 15:30",
                            "16:00 - 16:30",
                            "17:00 - 17:30"
                        ];
                        
    foreach ($bloquesHorarios as $bloque) {
    //No cambiable
        bloquesHorarios::factory(1)->create([
            'horario'  => $bloque,
        ]); 
    }
    //Editable                            
    User::factory(1000)->create();


    //Editable
    Citas::factory(1000)->create();
   
    
    // Citas con fecha del dia de hoy
    $citasHoy = Citas::whereEstado(1)->whereFecha(date('Y-m-d'))->get();
        foreach ($citasHoy as $cita) {
            Triaje::factory(1)->create([
                'idCita'    => $cita->id,
            ]); 
            $citaNow = Citas::find($cita->id);
            $citaNow->estado = 2;
            $citaNow->save();
        }    
    
        // dd(intval(count($citasHoy) / 2));
        $triajes = Triaje::all();        
        // Dividimos y solo mandamos la mitad de triajes
        $triajeHoy = $triajes->splice(0,ceil($triajes->count() / 2));

        /* Creando diagnosticos falsos */
        foreach ($triajeHoy as $triaje) {
            $cita = Citas::find($triaje->idCita);
            // dd($cita->idPaciente);
            Diagnostico::factory(1)->create([
                'idCita'        => $triaje->idCita,
                'idTriaje'      => $triaje->id,
                'idPaciente'    => $cita->idPaciente
            ]);     
            $cita->estado = 3;
            $cita->save();
        }
        


        /* Creando medicamentos */
        // Medicamentos::factory(1)->create();
         $medicamentos = 
         [
            [
                "medicamento"   => "Paracetamol",
                'presentacion'  => "tableta"
            ],
            [
                "medicamento"   => "Doloral",
                'presentacion'  => "tableta"
            ],
            [
                "medicamento"   => "Dolmigran",
                'presentacion'  => "tableta"
            ],
            [
                "medicamento"   => "Kflet",
                'presentacion'  => "jarabe"
            ],
            [
                "medicamento"   => "Reuma Plus",
                'presentacion'  => "pomada"
            ],
            [
                "medicamento"   => "Gaseovet",
                'presentacion'  => "jarabe"
            ],
            [
                "medicamento"   => "Bismutol",
                'presentacion'  => "tabletas"
            ],
            [
                "medicamento"   => "Lecha Magnesia",
                'presentacion'  => "jarabe"
            ],
            [
                "medicamento"   => "Panadol",
                'presentacion'  => "tabletas"
            ],
            [
                "medicamento"   => "Aspirina",
                'presentacion'  => "tabletas"
            ],
            [
                "medicamento"   => "Zaridon",
                'presentacion'  => "tabletas"
            ],
            [
                "medicamento"   => "Vick",
                'presentacion'  => "jarabe"
            ],
            [
                "medicamento"   => "Nastifl",
                'presentacion'  => "Tabletas"
            ],
            [
                "medicamento"   => "Paltomiel",
                'presentacion'  => "jarabe"
            ],
            [
                "medicamento"   => "Kflet",
                'presentacion'  => "jarabe"
            ],
            [
                "medicamento"   => "Vaporex",
                'presentacion'  => "jarabe"
            ],
         ];

         foreach ($medicamentos as $medicamento) {
            Medicamentos::factory(1)->create([
                'nombre'            => $medicamento['medicamento'],
                'presentacion'      => $medicamento['presentacion'],
            ]); 
         }

         /* Creando ventas */
        //  Ventas::factory(100)->create();
         //$triajes->splice(0,ceil($triajes->count() / 2));
         $pacientes = User::whereRolId(4)->get();
         $pacientesMitad = $pacientes->splice(0,ceil($pacientes->count() / 2)) ;

         foreach ($pacientesMitad as $paciente) {
                Ventas::factory(1)->create([
                    'idCliente'    => $paciente->id,
                ]); 
         }

         $ventas = Ventas::all();
         
         foreach ($ventas as $venta) {
            /* $medicamentosCantidad = $this->faker */
            $random = rand(3, 15);
            for ($i=0; $i <= $random; $i++) { 
                    RelacionVentas::factory(1)->create([
                        'idVenta'   => $venta->id
                    ]);
            }
     }

    }
}
