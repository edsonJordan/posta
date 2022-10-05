<?php

namespace App\Http\Controllers;

use App\Models\BloquesHorarios;
use App\Models\Servicios;
use App\Models\User;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{

    public function index()
    {
        $servicios = Servicios::all();
        $medicos = User::whereIdRol(2);
        $pacientes = User::whereIdRol(4);             
       
        return view('calendarios/index', compact('servicios', 'medicos', 'pacientes'));
    }

 
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
