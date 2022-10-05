@extends('layouts.app')

@section('contenidos')
    <?php
        function getData($fecha =null, $bloque = null)
        {
            date_default_timezone_set('America/Lima'); 
            $data = [
             'date'     => date('Y-m-d'),
             'hour'     => date('H:i'),
             'prueba'   => date('2022-08-11')
            ];   
            return $data;
        }
        
    ?>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Listado de Citas </h4>
                <?php
                $dataNow = getData();
                /* if(date('2022-08-09') > date('2022-08-10')){
                    echo "Es mayor";
                }
                var_dump($dataNow); */
               
                ?>
                
                <button class="btn btn-success pull-right" data-toggle="modal" data-target="#newCita">
                <i class="flaticon-381-plus"></i> Agregar Cita </button>
            </div>
            <div class="card-body">
                
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block mt-20" style="margin-top: 20px">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong> {{ $message }} </strong>
                    </div>
                @endif
                

                <div class="table-responsive">
                    <table id="example" class="display min-w850">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th class="d-flex justify-content-center">Estado</th>
                                <th>Especialidad</th>
                                <th>Medico</th>
                                <th>Paciente</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($citas as $cita)
                                <tr>
                                    <td>{{ $cita->id }}</td>
                                    <td class="d-flex justify-content-center" >
                                        <?php 
                                        if($dataNow['date'] > $cita->fecha && $cita->estado === 1 || $cita->estado === 2 && $dataNow['date'] > $cita->fecha  ){
                                            ?>        
                                            <button class="btn bg-danger text-white btn-xs mt-3 mb-2">Cancelado</button>                                                                               
                                            <?php 
                                        }
                                        elseif($cita->estado === 1){
                                            ?>        
                                            <button class="btn bg-warning text-white  btn-xs mt-3 mb-2">pendiente</button>                                                                               
                                        <?php    
                                        } 
                                             
                                        elseif ($cita->estado === 2) {?>
                                            <button class="btn bg-blue text-white  btn-xs mt-3 mb-2">Triaje</button>        
                                        <?php }                                            
                                        
                                            elseif ($cita->estado === 3) {?>
                                                <button class="btn bg-success text-white  btn-xs mt-3 mb-2">Diagnosticado</button>  

                                            <?php }                                            
                                            ?>
                                        
                                    </td>
                                    <td>{{ $cita->servicio->servicio }}</td>
                                    <td>{{ $cita->medico->name }} {{ $cita->medico->last_name }}</td>
                                    <td>{{ $cita->paciente->name }} {{ $cita->paciente->last_name }}</td>
                                    <td>{{ $cita->fecha }}</td>
                                    <td>{{ $cita->horario->horario }}</td>
                                   
                                    <td style="font-size: 25px">
                                        <i class="fa fa-edit text-success"
                                            onclick="editarCita({{ $cita }})"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- Model edit cita --}}
@section('modales')


    <div class="modal fade" id="defaultModal2" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Editar Cita</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cita.update') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p> <b>Servicio: </b> </p>
                                <select name="idServicio" id="idServicioEdit" onchange="getMedicosEdit()" class="form-control show-tick">
                                    <option value="">-- SELECCIONE --</option>                                   
                                    @foreach ($servicios as $servicio)
                                        <option value="{{$servicio->id}}">{{$servicio->servicio}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p> <b>Medico: </b> </p>
                                <select name="idMedico" id="idMedicoEdit" class="form-control show-tick">
                                    <option value="">-- SELECCIONE --</option>
                                    @foreach ($medicos as $medico)
                                        <option value="{{$medico->id}}">{{$medico->name}} {{$medico->last_name}}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-125 col-md-125 col-sm-12">
                                <p> <b>Paciente: </b> </p>
                                <select name="idPaciente" id="idPacienteEdit" class="form-control show-tick">
                                    <option value="">-- SELECCIONE --</option>
                                    @foreach ($pacientes as $medico)
                                        <option value="{{$medico->id}}">{{$medico->name}} {{$medico->last_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-6">
                                <p> <b>Fecha: </b> </p>
                                <input type="date" onchange="buscarHorarios()" class="form-control" name="fecha"
                                    id="fechaEdit">
                            </div>

                            <div class="col-md-6">
                                <p> <b>Horario:  </b> </p>
                                <select required  name="idHorario" id="idHorarioEdit" class="form-control show-tick">
                                    {{-- <option value="">-- SELECCIONE --</option> --}}
                                </select>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-12">
                                <p> <b>Observaciones: </b> </p>
                                <textarea rows="4"  name="observaciones" id="observacionesEdit" class="form-control no-resize"></textarea>
                                <input type="hidden" id="idCita" name="idCita">
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CERRAR</button>
                    <button type="submit" class="btn btn-success btn-round waves-effect">GUARDAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
{{-- End modal --}}
@section('scripts')
    <script>
        $('#example').DataTable({
            responsive: true,
                language: {
                    searchPlaceholder: 'Buscar',
                    sSearch: '',
                    lengthMenu: '_MENU_ Registro por Pagina',
                    paginate: {
                        first: "Primera",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Ultima"
                    },
                    info: "Mostrando del _START_ a _END_ en _TOTAL_ registros",
                }
        });




        function getMedicosEdit()
        {
            axios.get('/api/getMedicosByServcicio/'+$("#idServicioEdit").val()).then((response) => {
                $("#idMedicoEdit").html(response.data)
            })
        }

        function buscarMedico() {
            $("#medicos").modal('show')
        }

        function buscarPaciente() {
            $("#pacientes").modal('show')
        }

        function editarCita(cita)
        {
            // console.log(cita)
            $("#defaultModal2").modal('show');
            $("#idMedicoEdit option[value=" + cita.medico.id + "]").attr("selected", true)
            $("#idPacienteEdit option[value=" + cita.paciente.id + "]").attr("selected", true)
            $("#idServicioEdit option[value=" + cita.idServicio + "]").attr("selected", true)
            $("#fechaEdit").val(cita.fecha)
            $("#observacionesEdit").val(cita.observaciones)
            $("#idCita").val(cita.id)
            // console.log(cita.medico.id );


            //console.log('/api/getHorariosOcupados/' + cita.idMedico + '/' + cita.fecha);
            axios.get('/api/getHorariosOcupados/' + cita.idMedico + '/' + cita.fecha)
            .then((response) => {
                $("#idHorarioEdit").html(response.data)
                // console.log(response.data)
            })
            $("#idHorarioEdit option[value=" + cita.idHorario + "]").attr("selected", true)
        }
    </script>
@endsection
