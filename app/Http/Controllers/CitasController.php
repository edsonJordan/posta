<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{BloquesHorarios, Citas, PagosPaciente, Servicios, User};
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class CitasController extends Controller
{
    public function index()
    {
        $citas = Citas::where('sis', 0)->with(['medico', 'paciente', 'horario', 'servicio'])->get();
        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        $horarios = BloquesHorarios::all();
        $servicios = Servicios::all();
        
        return view('citas', compact('citas', 'medicos', 'pacientes', 'horarios', 'servicios'));
    }

    public function misCitas()
    {
        $citas = Citas::where('idPaciente', Auth::user()->id)->with(['medico', 'paciente', 'horario', 'servicio'])->get();
        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        $horarios = BloquesHorarios::all();
        $servicios = Servicios::all();
        return view('citas', compact('citas', 'medicos', 'pacientes', 'horarios', 'servicios'));
    }

    /* Api obtener citas de medico */
    public function getCitasMedico(User $user)
    {
        $citasMedico = Citas::where('idMedico', $user->id)
                            ->select('id','idHorario','idPaciente', 'fecha', 'observaciones')
                            ->with(['horario', 'paciente'])
                            ->get();
        $citas=[];        
        foreach ($citasMedico as $key=> $citaMedico) {
            $arrayHoras= explode("-",$citaMedico->horario->horario);
            $citas[$key]['id']= $citaMedico->id;
            $citas[$key]['title']= $citaMedico->paciente->name." ".$citaMedico->observaciones;
            $citas[$key]['start']= $citaMedico->fecha."T".trim($arrayHoras[0]);
            $citas[$key]['end']= $citaMedico->fecha."T".trim($arrayHoras[1]);
        };
        return response()->json($citas);
    }
    
    /* End api obtener citas de medico */


    public function getCalendarioCitas(User $user)
    {
        $citasMedico = Citas::select('id','idMedico', 'idPaciente','idHorario','idServicio','idMedico', 'fecha', 'observaciones')
                            ->with(['servicio','medico','paciente'])
                            ->get();
        $citas=[];        
        foreach ($citasMedico as $key=> $citaMedico) {
            $r = mt_rand( 120, 255 );
            $g = mt_rand( 128, 255 );
            $b = mt_rand( 240, 255 );
            // $a = mt_rand(8,9);
            $arrayHoras= explode("-",$citaMedico->horario->horario);
            
            $citas[$key]['id']= $citaMedico->id;
            $citas[$key]['idServicio']= $citaMedico->idServicio;
            $citas[$key]['idDoctor']= $citaMedico->idMedico;
            $citas[$key]['idHorario']= $citaMedico->idHorario;
            $citas[$key]['title']= $citaMedico->servicio->servicio;
            $citas[$key]['start']= $citaMedico->fecha."T".trim($arrayHoras[0]).":00";
            $citas[$key]['end']= $citaMedico->fecha."T".trim($arrayHoras[1]).":00";
            $citas[$key]['rendering']= 'background';
            // $citas[$key]['color']= sprintf('#%06X', mt_rand(0, 0xFFFFFF))."08";
            $citas[$key]['color']= "rgb($r,$g,$b)";
            $citas[$key]['description']= $citaMedico->observaciones;
            $citas[$key]['overlap']= true;    
            $citas[$key]['allDay']= false;
            $citas[$key]['horaStart']= trim($arrayHoras[0]).":00";                   
        };
        return $citas;
    }

    /* Api obtener todas las citas de todos los servicios */
    public function getCitas(User $user)
    {
        $citasMedico = Citas::select('idMedico', 'idPaciente','idHorario','idServicio','idMedico', 'fecha', 'observaciones')
                            ->with(['servicio','medico','paciente'])
                            ->get();
  
        return $citasMedico;
    }
    public function getCitasEstatus()
    {
        $citasMedico = Citas::select('estado', 'fecha')
        ->get();
        return $citasMedico;
    }
    // getCitasFecha
    public function getCitasFecha($fecha)
    {
        $citas = Citas::where('fecha',$fecha)                       
                            ->select('idMedico', 'idPaciente','idHorario','idServicio','idMedico', 'fecha', 'observaciones')
                            ->with(['servicio','medico','paciente'])
                            ->get();
  
        return response()->json($citas);
    }
    public function getCita(Citas $cita)
    {
        $dataCita = Citas::where('id', $cita->id)
                    ->select('id','idHorario', 'fecha', 'observaciones','idMedico','idPaciente','archivo')
                    ->with(['horario','paciente'])
                    ->get();
        return response()->json($dataCita);
    }
    
    public function updateCitas(Request $request)
    {
        $event = Citas::find($request->id)->update([
            'fecha' => $request->fecha,
            'idHorario'=> $request->idHorario,
            'observaciones'=> $request->observaciones
        ]);
        return response()->json($event);
    }



    
    public function misCitasM()
    {
        $citas = Citas::where('idMedico', Auth::user()->id)->with(['medico', 'paciente', 'horario', 'servicio'])->get();

        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        $horarios = BloquesHorarios::all();
        $servicios = Servicios::all();
        
        return view('citas', compact('citas', 'medicos', 'pacientes', 'horarios', 'servicios'));
    }

    public function citasSis()
    {
        $citas = Citas::where('sis', 1)->with(['medico', 'paciente', 'horario', 'servicio'])->get();
        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        $horarios = BloquesHorarios::all();
        $servicios = Servicios::all();

        return view('citas', compact('citas', 'medicos', 'pacientes', 'horarios', 'servicios'));
    }

    public function store(Request $request)
    {
        $validacion = Citas::where('idMedico', $request->idMedico)
            ->where('idPaciente', $request->idPaciente)
            ->where('fecha', $request->fecha)
            ->where('idHorario', $request->idHorario)
            ->count();

        $medico = User::whereId($request->idMedico)->first();

        if ($validacion == 0)
        {

            if ($request->tipoCita == 1) {
                $foto = $this->upload_global($request->file('archivo'), 'archivos');
            } else {
                $foto = null;
            }

            $cita = Citas::create([
                'idMedico' => $request->idMedico,
                'idPaciente' => $request->idPaciente,
                'fecha' => $request->fecha,
                'idHorario' => $request->idHorario,
                'observaciones' => $request->observaciones,
                'idServicio' => $request->idServicio,
                'estado' => 1,
                'sis' => $request->tipoCita,
                'prioridad' => $request->prioridad,
                'archivo' => $foto
            ]);

            if($request->tipoCita == 0){
                $pago = PagosPaciente::create([
                'idPaciente' => $request->idPaciente,
                'idServicio' => $request->idServicio,
                'precio' => 0,
                'observacion' => $request->observaciones,
                'metodoPago' => 0,
                'fecha_generacion' => $request->fecha,
                'estado' => 1
            ]);
            }
            return back()->with('success', 'Cita Creada correctamente');
        }
        else
        {
            $validacion = Citas::where('idMedico', $request->idMedico)
            ->where('idPaciente', $request->idPaciente)
            ->where('fecha', $request->fecha)
            ->first();
            return back()->with('danger', "Ya el doctor: ". $medico->name ." ". $medico->last_name .", tiene una cita,
            el dia: ". $request->fecha . "En el horario: ". $validacion->inicio . "-" . $validacion->fin);
        }
    }

    public function update(Request $request){
        Citas::updateOrCreate([
            'id' => $request->idCita,
        ], [
            'idMedico' => $request->idMedico,
            'idPaciente' => $request->idPaciente,
            'fecha' => $request->fecha,
            'idHorario' => $request->idHorario,
            'observaciones' => $request->observaciones,
            'idServicio' => $request->idServicio
        ]);

        return back()->with('success', 'Cita Actualizada correctamente');
    }

    public function miCalendarioM(User $user)
    {
        $citas = Citas::where('idMedico', Auth::user()->id)->get();        
        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        $horarios = BloquesHorarios::all();
        $servicios = Servicios::all();        
        return view('/calendarios/medico', compact('citas', 'medicos', 'pacientes', 'horarios', 'servicios'));
       
    }

    public function getOcupados($idMedico, $fecha)
    {
       $citas = Citas::where('idMedico', $idMedico)->whereFecha($fecha)->get();
       $horarios = BloquesHorarios::all();
       $html = "<option value =''>-- SELECCIONE --</option>";
       /* $html = "<option >-- SELECCIONE --</option>"; */

       foreach($horarios as $horario)
       {
           $disabled = false;
            foreach($citas as $cita)
            {
                if($cita->idHorario == $horario->id)
                {
                    $disabled = true;
                }
            }

            if($disabled)
            {
                $html .="<option value='' disabled>$horario->horario</option>";
            }
            else{
                $html .= "<option value='$horario->id'>$horario->horario</option>";
            }
       }

       return $html;
    }


    function upload_global($file, $folder)
    {
        $file_type = $file->getClientOriginalExtension();
        $folder = $folder;
        $destinationPath = public_path() . '/uploads/' . $folder;
        $destinationPathThumb = public_path() . '/uploads/' . $folder . 'thumb';
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $url = '/uploads/' . $folder . '/' . $filename;

        if ($file->move($destinationPath . '/', $filename)) {
            return $filename;
        }
    }
}
