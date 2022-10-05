@extends('layouts.app')



@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Listado de {{ $tipo }}</h4>

                <button onclick="activeModalCreate()" class="btn btn-success pull-right btn-action" data-toggle="modal" data-target="#defaultModal">
                    <i class="flaticon-381-plus"></i> Agregar Usuario </button>
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
                                <th>DNI</th>
                                <th>Nombre Completo</th>
                                @if ($tipo == 'Medicos')
                                    <th>Especialidad</th>
                                @endif
                                <th>Correo</th>
                                <th>Usuario</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->document }}</td>
                                    <td>{{ $usuario->name }} {{ $usuario->last_name }}</td>
                                    @if ($tipo == 'Medicos')
                                        <td>{{$usuario->servicio->servicio}}</td>
                                    @endif
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->user }}</td>
                                    <td>
                                        @if ($tipo == 'Pacientes')
                                        <a href="{{route('paciente.historiaclinica', $usuario->id)}}" class="btn btn-success">Historia Clinica</a>
                                        @endif
                                        <i class="fa fa-edit text-white btn btn-info btn-action"
                                            onclick="editarUsuario({{ $usuario->id }})"></i>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Crear Usuario</h4>
                </div>
                <div class="modal-body">

                    {!! Form::open(['route' => 'usuario.store', 'autocomplete' => 'off', 'enctype'=>'multipart/form-data', 
                    'files' => true, 'method'=>'post', 'accept-charset'=>'UTF-8', 'id'=>'formCreate', 'files?'=> 'true']) !!}    
                    {{-- <form action="{{ route('usuario.store') }}" method="post" id="formCreate" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data" files?="true"> --}}
                        {{-- @csrf --}}
                        
                        {{-- is-invalid --}}
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Documento</label> 
                                   {{--  {!! Form::text('document', , ['class' => "form-control {{ $errors->has('document') ? ' is-invalid' : '' }}", 'placeholder' => 'Ingrese documento de identificación', 'id'=>"document"]) !!} --}}
                                    <input type="text" name="document" required  value="{{ old('document')}}"
                                    id="document" class="@error('document') form-control is-invalid @else form-control  @enderror"  placeholder="" >
                                </div>
                                {{-- onblur="validarDocumento()" --}}
                                @error('document')
                                        <small class="text-danger text-white" >{{$message}}</small>    
                                @enderror
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo"  class="@error('photo') form-control is-invalid @else form-control  @enderror" id="photo" value="{{ old('photo')}}">
                                </div>
                                @error('photo')
                                        <small class="text-danger text-white" >{{$message}}</small>    
                                @enderror
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input  type="text" name="name" value="{{ old('name')}}" required class="@error('name') form-control is-invalid @else form-control  @enderror" placeholder="">
                                    @error('name')
                                        <small class="text-danger text-white" >{{$message}}</small>    
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Apellido</label>
                                    <input type="text" name="last_name" required class="@error('last_name') form-control is-invalid @else form-control  @enderror" value="{{ old('last_name')}}" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Correo</label>
                                    <input type="text" name="email" required  value="{{ old('email')}}"
                                    class="@error('email') form-control is-invalid @else form-control  @enderror" placeholder="">
                                    @error('email')
                                        <small class="text-danger text-white" >{{$message}}</small>    
                                    @enderror
                                
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Telefono</label>
                                    <input  type="text" name="telefono" value="{{ old('telefono')}}" required class="@error('telefono') form-control is-invalid @else form-control  @enderror" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Usuario</label>
                                    <input type="text" name="user" required class="@error('user') form-control is-invalid @else form-control  @enderror" placeholder="" value="{{ old('user')}}">
                                    @error('user')
                                        <small class="text-danger text-white" >{{$message}}</small>    
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Clave</label>
                                    <input  type="text" name="password" value="{{ old('password')}}" required class="@error('password') form-control is-invalid @else form-control  @enderror" placeholder="">
                                    @error('password')
                                        <small class="text-danger text-white" >{{$message}}</small>    
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Tipo Usuario</label>
                                    <select class="form-control show-tick" required onchange="mostrar()" value="{{ old('rol_id')}}" name="rol_id" id="rolid">
                                        <option value="">-- Seleccione --</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Medico</option>
                                        <option value="3">Farmaceuta</option>
                                        <option value="4">Paciente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Especialidad</label>
                                    <select class="form-control show-tick" required name="idServicio" id="idServicio" disabled>
                                        <option value="">-- Seleccione --</option>
                                        @foreach ($servicios as $servicio)
                                            <option value="{{ $servicio->id }}">{{ $servicio->servicio }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CERRAR</button>
                    <button type="submit" {{-- disabled --}} id="botonGuardar"
                        class="btn btn-success btn-round waves-effect">GUARDAR</button>
                    {!! Form::close() !!}
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>

   
    <div class="modal fade" id="defaultModal2" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Editar Usuario</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'usuario.update', 'autocomplete' => 'off', 'enctype'=>'multipart/form-data', 
                    'files' => true, 'method'=>'post', 'accept-charset'=>'UTF-8', 'id'=>'formEdit', 'files?'=> 'true']) !!}    
                    {{-- <form action="{{ route('usuario.update') }}" method="post" id="formEdit" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf --}}

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Documento</label>
                                    <input type="text" name="document" value="@error('document') {{old('document') }} @else {{old('document') }} @enderror " id="idDocumentEditUpdate" class="@error('document') form-control is-invalid @else form-control  @enderror"
                                        placeholder="Ingrese documento">
                                </div>
                                @error('document')
                                        <small class="text-danger text-white" >{{$message}}</small>    
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo" class="@error('photoUpdate') form-control is-invalid @else form-control  @enderror" id="photo">
                                </div>
                                @error('photo')
                                        <small class="text-danger text-white" >{{$message}}</small>    
                                @enderror
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" value="@error('name') {{old('name') }} @else {{old('name') }} @enderror " id="nameUpdate" class="@error('nameUpdate') form-control is-invalid @else form-control  @enderror" placeholder="">
                                    <input type="hidden" name="idUsuario" value="@error('idUsuario') {{old('idUsuario') }} @else {{old('idUsuario') }} @enderror" id="idUsuarioUpdate" class="form-control"
                                        placeholder="">
                                    @error('name')
                                        <small class="text-danger text-white" >{{$message}}</small>    
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Apellido</label>
                                    <input type="text" name="last_name" value="@error('last_name') {{old('last_name') }} @else {{old('last_name') }} @enderror " id="last_nameUpdate" class="form-control"
                                        placeholder="">
                                    @error('last_name')
                                        <small class="text-danger text-white" >{{$message}}</small>    
                                    @enderror    
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Correo</label>
                                    <input type="text" name="email" value="@error('email') {{old('email') }} @else {{old('email') }} @enderror " id="emailUpdate" class="form-control" placeholder="">
                                    @error('email')
                                    <small class="text-danger text-white" >{{$message}}</small>    
                                    @enderror  
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Telefono</label>
                                    <input type="text" name="telefono" value="@error('telefono') {{old('telefono') }} @else {{old('telefono') }} @enderror " id="telefonoUpdate" class="form-control" placeholder="">
                                    @error('telefono')
                                    <small class="text-danger text-white" >{{$message}}</small>    
                                    @enderror 
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Usuario</label>
                                    <input type="text" name="user" value="@error('user') {{old('user') }} @else {{old('user') }} @enderror" id="userUpdate" class="form-control" placeholder="">
                                    @error('user')
                                    <small class="text-danger text-white" >{{$message}}</small>    
                                    @enderror 
                                
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Clave</label>
                                    <input type="text" name="password" id="passwordUpdate" class="form-control" placeholder="">
                                    @error('password')
                                    <small class="text-danger text-white" >{{$message}}</small>    
                                    @enderror 
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Especialidad</label>
                                    <select class="form-control" name="especialidad" id="idServicioEditUpdate" disabled>
                                        <option value="">-- Seleccione --</option>
                                        @foreach ($servicios as $key => $servicio)                                            
                                            <option value="{{ $servicio->id }}">{{ $servicio->servicio }}</option>
                                        @endforeach
                                    </select>                                    
                                </div>
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
        async function getOptionsSpecialidad(idUserUpdate) {
           const data =  await axios.get('/api/usuario/' + idUserUpdate).then((response) => {
                                $("#rol_id option[value=" + response.data.rol_id + "]").attr("selected", true)
                                $("#idServicioEditUpdate option[value=" + response.data.idServicio + "]").attr("selected", true)
                                if(response.data.rol_id == 2)
                                {
                                    $("#idServicioEditUpdate").attr('disabled', false)
                                }
                                else{
                                    $("#idServicioEditUpdate").hide
                                }
                            })            
        }

        window.addEventListener("DOMContentLoaded", async function(e) {
                let error = '<?=$errorForm?>';
                    if(error){
                        let actionEvent = getActionUrl();
                        // console.log(actionEvent);
                        switch (actionEvent) {
                            case 'editUser':
                            inputSuccess('formEdit');
                            $("#defaultModal2").modal("show");
                            const idUserUpdate = document.getElementById('idUsuarioUpdate').value;
                            // console.log(idUserUpdate);
                            await getOptionsSpecialidad(idUserUpdate);
                                break;
                            case 'createUser':                        
                            inputSuccess('formCreate')
                            $("#defaultModal").modal('show')    
                                break;
                            default:
                                break;
                        }
                    }
        });
        
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

        function getActionUrl(){
            const url = new URL(window.location);
            let action = url.searchParams.get("action");
            return action;
        }

        const setUrlParams = (params) => {                
            if(!params)
                return;
            const paramsUrl = Object.entries(params)
                .reduce((acum, actual, index) => (
                    `${acum}${index === 0 ? '?' : '&'}${actual[0]}=${actual[1]}`
                ), '');
            const newUrl = paramsUrl;
            // Según los valores que setees en los parámetros, mostras lo que quieras mostrar en tu web
            // en esto que sigue se cambia el estado del history, y setea los parametros,
            if(window.history.pushState) window.history.pushState(null, null, newUrl);            
        };
        function activeModalCreate(){
            setUrlParams({action: 'createUser'});
            clearErrorsMessages('formCreate')
        }
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
        function editarUsuario(idUsuario) {
            axios.get('/api/usuario/' + idUsuario).then((response) => {
                // console.log(response.data)
                $("#nameUpdate").val(response.data.name)
                $("#idUsuarioUpdate").val(response.data.id)
                $("#last_nameUpdate").val(response.data.last_name)
                $("#emailUpdate").val(response.data.email)
                $("#telefonoUpdate").val(response.data.telefono)
                $("#userUpdate").val(response.data.user)
                $("#idDocumentEditUpdate").val(response.data.document)
                $("#rol_id option[value=" + response.data.rol_id + "]").attr("selected", true)
                $("#idServicioEditUpdate option[value=" + response.data.idServicio + "]").attr("selected", true)
                if(response.data.rol_id == 2)
                {
                    $("#idServicioEditUpdate").attr('disabled', false)
                }
                else{
                    $("#idServicioEditUpdate").hide
                }
            })
            $("#defaultModal2").modal('show')
            setUrlParams({action: 'editUser'});      
            clearErrorsMessages('formEdit')
        }
        function mostrar() {
            if ($("#rolid").val() == 2) {
                $("#idServicio").attr('disabled', false)
            } else {
                $("#idServicio").attr('disabled', true)
            }
        }
       /*  function validarDocumento() {
            documento = $("#document").val()
            console.log(documento)
            axios.get('/api/validarDocumento/' + documento).then((response) => {
                if (response.data == 0) {
                    $("#botonGuardar").attr('disabled', false)
                    $("#document").addClass("is-valid")
                    $("#document").removeClass("is-invalid")
                } else {
                    $("#document").addClass("is-invalid")
                    $("#botonGuardar").attr('disabled', true)
                }
            })
        } */
    </script>
@endsection
