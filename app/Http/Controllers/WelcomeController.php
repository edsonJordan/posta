<?php

namespace App\Http\Controllers;

use App\Models\{BloquesHorarios, Citas, Servicios, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function home()
    {
        $servicios = Servicios::all();
        $medicos = User::whereIdRol(2);
        $pacientes = User::whereIdRol(4);
        return view('home', compact('servicios', 'medicos', 'pacientes'));
    }
    public function homeUser()
    {
        $servicios = Servicios::all();
        $medicos = User::whereIdRol(2);
        $pacientes = User::whereIdRol(4);
        return view('homeUsuario', compact('servicios', 'medicos', 'pacientes'));
    }
    public function index()
    {
        $citas = Citas::where('sis', 0)->with(['medico', 'paciente', 'horario', 'servicio'])->get();
        
        $horarios = BloquesHorarios::all();
        $servicios = Servicios::select('id', 'servicio')->get();        
        $userAuth = Auth::user() ? Auth::user()->id : null ;
        $userRol = Auth::user() ? Auth::user()->rol_id : null ;
        return view('web.index',compact('userAuth', 'userRol', 'citas', 'horarios', 'servicios'));
    }

    public function performance()
    {
        $servicios = Servicios::select('id', 'servicio')->get();
        
        $medicos = User::whereIdRol(2);
        
        $pacientes = User::whereIdRol(4);
        return view('performance.index',compact('servicios', 'pacientes','medicos'));
    }
}
