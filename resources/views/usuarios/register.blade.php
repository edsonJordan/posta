{{-- Formulario externo para que los usuarios se puedan registrar en el sistema --}}
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>:: Crear tu cuenta ::</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="{{ asset('assets/vendor/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
</head>
<body>
    <style>
        body{
            font-family: 'Roboto';
            background-color: #FE634E;
        }
        .text-orange{
            color: #FE634E;
        }
    </style>
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center vh-100">
                <div class="col-md-8  p-4 padding-right-6 padding-left-6 rounded bg-light border rounded">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4 text-orange">Crea tu cuenta</h4>
                                    {!! Form::open(['route' => 'usuarios.registro.paciente', 'autocomplete' => 'off', 'files' => true, 'method'=>'post']) !!}    
                                    {{-- usuarios.registro.paciente --}}
                                    <div class="row ">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('document', 'Documento') !!}
                                                {!! Form::text('document', null, ['class' => 'form-control', 'placeholder' => 'Ingrese documento de identificación']) !!}
                                            @error('document')
                                                <small class="text-danger text-white" >{{$message}}</small>
                                            @enderror
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('photo', 'Fotografia') !!}
                                                {!! Form::file('photo', ['class' => 'form-control', 'placeholder' => 'Ingrese una foto']) !!}
                                                @error('photo')
                                                <small class="text-danger text-white" >{{$message}}</small>
                                            @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('name', 'Nombre') !!}
                                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nombre']) !!}
                                                @error('name')
                                                <small class="text-danger text-white" >{{$message}}</small>
                                                @enderror                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('apellido', 'Apellido') !!}
                                                {!! Form::text('apellido', null, ['class' => 'form-control', 'placeholder' => 'Ingrese apellido']) !!} 
                                                @error('apellido')
                                                <small class="text-danger text-white" >{{$message}}</small>
                                                @enderror  
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('email', 'Correo') !!}
                                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese correo']) !!} 
                                                @error('email')
                                                <small class="text-danger text-white" >{{$message}}</small>
                                                @enderror 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('telefono', 'Teléfono') !!}
                                                {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Ingrese teléfono']) !!} 
                                                @error('telefono')
                                                <small class="text-danger text-white" >{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('user', 'Usuario') !!}
                                                {!! Form::text('user', null, ['class' => 'form-control', 'placeholder' => 'Ingrese usuario']) !!} 
                                                @error('user')
                                                <small class="text-danger text-white" >{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">                                                
                                                {!! Form::label('password', 'Contraseña') !!}
                                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingrese contraseña']) !!} 
                                                @error('password')
                                                <small class="text-danger text-white" >{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row d-flex justify-content-end">
                                        <button type="button" onclick="history.back()" class="btn btn-danger waves-effect mr-4">atrás</button>
                                        <button type="submit"  id="botonGuardar" class="btn btn-success btn-round waves-effect mr-4">GUARDAR</button>                                        
                                    </div>
                                  
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</body>
    
</html>