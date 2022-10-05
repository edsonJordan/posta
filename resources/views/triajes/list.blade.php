@extends('layouts.app')

@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Listado de Triajes del Dia</h4>
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
                                <th></th>
                                <th></th>
                                <th>Urgencia</th>
                                <th>Especialidad</th>
                                <th>Paciente</th>
                                <th>Documento</th>
                                <th>Fecha</th>
                                <th>Hora</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($citas as $cita)
                                <tr>
                                    <td style="font-size: 25px">
                                        <i class="fa fa-edit text-success btn-edit"
                                            onclick="triaje({{ $cita->id }})"></i>
                                    </td>
                                    <td>
                                        @if($cita->archivo != null)
                                            <a href="/uploads/archivos/{{$cita->archivo}}" target="__blank">
                                            <i class="fa fa-file btn btn-danger text-white"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($cita->prioridad == 1)
                                            <button class="btn btn-danger">Urgente</button>
                                        @else
                                            <button class="btn btn-info">Normal</button>
                                        @endif
                                    </td>
                                    <td>{{ $cita->servicio->servicio }}</td>
                                    <td>{{ $cita->paciente->name }} {{ $cita->paciente->last_name }}</td>
                                    <td>{{ $cita->paciente->document }}</td>
                                    <td>{{ $cita->fecha }}</td>
                                    <td>{{ $cita->horario->horario }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modales')
        <?php 
            $errorForm = null;
            if (!$errors->isEmpty()) { 
                $errorForm = true;
            }
            else{
                $errorForm = false;
            }
        ?>
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Triaje de Paciente</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'triaje.store', 'autocomplete' => 'off', 'enctype'=>'multipart/form-data', 
                    'files' => true, 'method'=>'post', 'accept-charset'=>'UTF-8', 'id'=>'formEdit', 'files?'=> 'true']) !!}    
                    {{-- <form action="{{ route('triaje.store') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf --}}
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p> <b>Especialidad: </b> </p>
                                <input type="text" disabled  class="form-control" id="especialidad">
                            </div>
                            <div class="col-md-4">
                                <p> <b>Medico: </b> </p>
                                <input type="text" disabled class="form-control" id="medico">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Horario: </b> </p>
                                <input type="text" disabled class="form-control" id="horario">
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p> <b>Documento: </b> </p>
                                <input type="text" disabled class="form-control" id="document">
                            </div>
                            <div class="col-md-4">
                                <p> <b>Nombre: </b> </p>
                                <input type="text" disabled class="form-control" id="nombre">
                            </div>
                            <div class="col-md-4">
                                <p> <b>Usuario: </b> </p>
                                <input type="text" disabled class="form-control" id="usuario">
                                <input type="hidden" class="form-control" value="@error('idCita') {{old('idCita') }} @else {{old('idCita') }} @enderror"  id="idCita" name="idCita">
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p> <b>Presion Arterial: </b> </p>
                                <input type="text" id="presion" required class="@error('presion') form-control is-invalid @else form-control  @enderror" value="@error('presion') {{old('presion') }} @else {{old('presion') }} @enderror" name="presion">
                                    @error('presion')
                                    <small class="text-danger text-white" >{{$message}}</small>    
                                    @enderror 
                            </div>
                            <div class="col-md-4">
                                <p> <b>Temperatura: </b> </p>
                                <input type="text"  id="temperatura" value="@error('temperatura') {{old('temperatura') }} @else {{old('temperatura') }} @enderror" required class="@error('temperatura') form-control is-invalid @else form-control  @enderror" name="temperatura">
                                @error('temperatura')
                                    <small class="text-danger text-white" >{{$message}}</small>    
                                @enderror 
                            </div>
                            <div class="col-md-4">
                                <p> <b>Frecuencia Cardiaca: </b> </p>
                                <input type="text" id="cardiaca" value="@error('cardiaca') {{old('cardiaca') }} @else {{old('cardiaca') }} @enderror" required class="@error('cardiaca') form-control is-invalid @else form-control  @enderror" name="cardiaca">
                                @error('cardiaca')
                                    <small class="text-danger text-white" >{{$message}}</small>    
                                @enderror 
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p> <b>Saturacion: </b> </p>
                                <input type="text" id="saturacion" required class="@error('cardiaca') form-control is-invalid @else form-control  @enderror" value="@error('saturacion') {{old('saturacion') }} @else {{old('saturacion') }} @enderror" name="saturacion">
                                @error('saturacion')
                                    <small class="text-danger text-white" >{{$message}}</small>    
                                @enderror 
                            </div>
                            <div class="col-md-4">
                                <p> <b>Peso Kg: </b> </p>
                                <input type="text" id="peso" value="@error('peso') {{old('peso') }} @else {{old('peso') }} @enderror" required class="@error('peso') form-control is-invalid @else form-control  @enderror" name="peso">
                                @error('peso')
                                    <small class="text-danger text-white" >{{$message}}</small>    
                                @enderror 
                            </div>

                            <div class="col-md-4">
                                <p> <b>Talla CM: </b> </p>
                                <input type="text" id="talla" required value="@error('talla') {{old('talla') }} @else {{old('talla') }} @enderror" class="@error('talla') form-control is-invalid @else form-control  @enderror" name="talla">
                                @error('talla')
                                    <small class="text-danger text-white" >{{$message}}</small>    
                                @enderror
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CERRAR</button>
                    <button type="submit" class="btn btn-success btn-round waves-effect">GUARDAR</button>
                    {{-- </form> --}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Clear menssages errors
        function clearErrorsMessages(formSelect) {
            const errorIsInvalid = document.getElementById(formSelect).querySelectorAll('.form-control');
            const errorText = document.getElementById(formSelect).querySelectorAll('.text-danger');
            errorIsInvalid.forEach(element => {
                element.classList.remove("is-invalid");
                element.classList.remove("is-valid");
            });
            errorText.forEach(element => {
                element.remove();
            });
        }

        function inputSuccess(formNode) {
            let form = document.getElementById(formNode);
            const formElements = Array.from(form.elements);
            formElements.forEach(element => {        
                const isEmpty =element.value.length;
                // console.log(element.className);   
                const isUbicated =element.className.indexOf('form-control') !== -1;
                // console.log(element);
                if(isEmpty > 0 && isUbicated){
                    element.classList.add('is-valid');
                }
            });
        }
        // Action
        
        async function getTriaje(cita){
            const response = await fetch(`/api/triaje/${cita}`);
            const data = await response.json();
            return data;
        }


    </script>
    
    <script>
        let dataUpdate = null;
          window.addEventListener("DOMContentLoaded", async function(e) {
                let error = '<?=$errorForm?>';
                    if(error){
                            
                            $("#defaultModal").modal("show");
                            const idCitaUpdate = document.getElementById('idCita').value;
                            // triaje(idCitaUpdate);
                            data = await getTriaje(idCitaUpdate);
                            
                            const cita = data[0];  

                            inputSuccess('formEdit')
                            $("#document").val(cita.paciente.document)
                            $("#nombre").val(cita.paciente.name + ' ' + cita.paciente.last_name)
                            $("#horario").val(cita.horario.horario)
                            $("#usuario").val(cita.paciente.user)
                            $("#medico").val(cita.medico.name + ' ' + cita.medico.last_name)
                            $("#especialidad").val(cita.servicio.servicio)
                            $("#idCita").val(cita.id)
                            $("#defaultModal").modal('show')
                        }
          });
    </script>
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
        async function triaje(idCita)
        {   
            data = await getTriaje(idCita);
            const cita = data[0];

            
            $("#presion").val("")
            $("#temperatura").val("")
            $("#cardiaca").val("")
            $("#saturacion").val("")
            $("#peso").val("")
            $("#talla").val("")

            clearErrorsMessages('formEdit');
            $("#document").val(cita.paciente.document)
            $("#nombre").val(cita.paciente.name + ' ' + cita.paciente.last_name)
            $("#horario").val(cita.horario.horario)
            $("#usuario").val(cita.paciente.user)
            $("#medico").val(cita.medico.name + ' ' + cita.medico.last_name)
            $("#especialidad").val(cita.servicio.servicio)
            $("#idCita").val(cita.id)
            $("#defaultModal").modal('show');


        }
    </script>
@endsection
