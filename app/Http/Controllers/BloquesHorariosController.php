<?php

namespace App\Http\Controllers;

use App\Models\{BloquesHorarios, Citas, User, Servicios};
use Illuminate\Http\Request;

class BloquesHorariosController extends Controller
{
    public function index()
    {
        $horarios = BloquesHorarios::all();
        $servicios = Servicios::all();
        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        return view('config.horarios', compact('horarios','servicios', 'pacientes', 'medicos'));
    }

    public function store(Request $request)
    {
        $horario = BloquesHorarios::create([
            'horario' => $request->inicio. " - ".$request->fin
        ]);
        return back()->with('success', 'Horario Creado con exito');
    }
    public function update(Request $request)
    {
        BloquesHorarios::updateOrCreate([
            'id' => $request->idHorario
        ],
        [
            'horario' => $request->inicio . " - " . $request->fin
        ]);
        return back()->with('success', 'Horario Actualizado con exito');
    }
    public function getHorarios()
    {
        $bloquesHorarios= BloquesHorarios::all();
        $horarios=[];        
        foreach ($bloquesHorarios as $key=> $bloquesHorario) {
            $arrayHoras= explode("-",$bloquesHorario->horario);
            // Horas de lunes a viernes
            $horarios[$key]['id']=$bloquesHorario->id;
            $horarios[$key]['daysOfWeek']= [ 1,2,3,4,5 ];
            // Bloques referentes a lo guardado en
            $horarios[$key]['startTime']= trim($arrayHoras[0]);
            $horarios[$key]['endTime']= trim($arrayHoras[1]);
        };
        return response()->json($horarios);
    }



    public function getHorariosBloqueo($idHorario,$idMedico,$fecha)
    {
        $citas = Citas::select('idHorario')->where('idMedico', $idMedico)->where('fecha', $fecha)->get();

        $idsCitasExists = array();
        foreach ($citas as $cita) {
            array_push($idsCitasExists, $cita->idHorario);
        }
        $horarioActual = BloquesHorarios::where('id', $idHorario)->get();

        $bloquesHorarios= BloquesHorarios::all();
        $horarios=[];   
        $count=0;     
        foreach ($bloquesHorarios as $key=> $bloquesHorario) {
            if(in_array($bloquesHorario->id,$idsCitasExists)) 
            {
                continue;
            }
            $count++;
            if($bloquesHorario->id == $idHorario){
                $horarios[$count-1]['selected']=true;
            }else{
                $horarios[$count-1]['selected']=false;
            }
            // Horas de lunes a viernes
            $horarios[$count-1]['id']=$bloquesHorario->id;           
            // Bloques referentes a lo guardado en
            $horarios[$count-1]['horario']= $bloquesHorario->horario;            
        };

        /* Agrega un ultimo dato que devuelve selected true porque le corresponde  */
        $indexHorarios = count($horarios);
        $horarios[$indexHorarios]['selected'] = true;
        $horarios[$indexHorarios]['id'] = $horarioActual[0]->id; 
        $horarios[$indexHorarios]['horario'] = $horarioActual[0]->horario; 
        return response()->json($horarios);
    }


    public function getHorariosMedicosBloqueo($idMedico, $fecha){
        $horariosOcupados = Citas::select('idHorario')->where('idMedico', $idMedico)->where('fecha', $fecha)->get();

        $horariosOcupadosArray = array();
        foreach ($horariosOcupados as $horariosOcupado) {
            array_push($horariosOcupadosArray, $horariosOcupado->idHorario);
        }
        $horarios=[];  

        $bloquesHorarios= BloquesHorarios::all();
        $count=0; 
        foreach ($bloquesHorarios as $key=> $bloquesHorario) {
            if(in_array($bloquesHorario->id, $horariosOcupadosArray)) 
            {
                continue;
            }
            $horarios[$count]['id']=$bloquesHorario->id;      
            $horarios[$count]['horario']= $bloquesHorario->horario;            
            $count++;
        };
        return response()->json($horarios);
    }

    public function getOcupados($fecha, Servicios $servicio, BloquesHorarios $bloque, User $medico){   
        $citasLibres = Citas::where('idServicio', $servicio->id)
                            ->where('fecha', $fecha)
                            ->where('idHorario', $bloque->id)
                            ->where('idMedico', $medico->id)
                            ->get();
        return response()->json($citasLibres);
        // echo $fecha;
    }
}
