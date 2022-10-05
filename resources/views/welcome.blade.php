<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>:: INICIO DE SESION ::</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="assets/css/style.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block mt-20 container-mesagge" style="margin-top: 20px">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong> {{ $message }} </strong>
                        </div>
                    @endif
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4 text-white">Inicia Sesion</h4>
                                    <form class="form" method="post" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Usuario</strong></label>
                                            <input type="text" class="form-control" name="usuario"
                                                placeholder="Usuario">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="mb-1 text-white"><strong>Clave</strong></label>
                                            <input type="password" placeholder="Clave" name="clave"
                                                class="form-control" />
                                        </div>
                                        <div class="form-group mb-4">
                                           <label class="text-light" for="">No tienes Una cuenta? <a class="text-light" href="{{route('usuarios.registro')}}"><strong>Registrate</strong></a> </label> 
                                        </div>

                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn bg-white text-primary btn-block">Iniciar</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/deznav-init.js"></script>
    
    <script>
         const buton = document.getElementsByClassName('close')

        document.getElementsByClassName('close')[0]?.addEventListener('click',(e)=>{
            document.getElementsByClassName('container-mesagge')[0].remove()
            })

    </script>
</body>


</html>
