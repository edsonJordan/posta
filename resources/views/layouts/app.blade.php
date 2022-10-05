<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>:: Centro de salud Collique Ill Zona ::</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/chartist/css/chartist.min.css') }}">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">

    {{-- Perfect scrollbar  --}}
    <link rel="stylesheet" href="{{asset('assets/vendor/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" />
    <link href="{{ asset('assets/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mainCalendary.css') }}">
    <!-- Datatable -->
    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <script src='{{ asset('assets/js/mainCalendary.js') }}'></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="/" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('assets/images/logo-posta-vector.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('assets/images/logo-posta-vector.png') }}" alt="">
                <img class="brand-title" src="{{ asset('assets/images/text-logo.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span
                        class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                Inicio
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">



                            <li class="nav-item dropdown header-profile">
                                @if (Auth::user()->photo != null)
                                    <a class="nav-link" href="javascript:void(0)" role="button"
                                        data-toggle="dropdown">
                                        <img src="{{ asset('uploads/perfiles/'.Auth::user()->photo) }}" alt="" />
                                    @else
                                        <a class="nav-link" href="javascript:void(0)" role="button"
                                            data-toggle="dropdown">
                                            <img src="{{ 'assets/images/profile/17.jpg' }}" alt="" />
                                @endif
                                <div class="header-info">
                                    <span class="text-black"><strong>{{ Auth::user()->name }}
                                            {{ Auth::user()->last_name }}</strong></span>
                                    <p class="fs-12 mb-0">
                                        @if (Auth::user()->rol_id == 1)
                                            Administrador
                                        @elseif(Auth::user()->rol_id == 2)
                                            Medico
                                        @elseif(Auth::user()->rol_id == 3)
                                            Farmacia
                                        @elseif(Auth::user()->rol_id == 4)
                                            Paciente
                                        @endif
                                    </p>
                                </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">

                                    <a href="{{ route('logout') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        <span class="ml-2">Cerrar Sesion </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('layouts.menu')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <!-- Add Order -->
                @yield('modales')
                <div class="modal fade" id="newCita" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="title" id="defaultModalLabel">Crear Cita</h4>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('cita.store') }}" method="post" autocomplete="off"
                                    accept-charset="UTF-8" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <p> <b>Tipo de Cita: </b> </p>
                                            <select name="tipoCita" onchange="archivosis()" required id="tipoCita"
                                                class="form-control show-tick">
                                                <option value="">-- SELECCIONE --</option>
                                                <option value="0">-- PAGANTE --</option>
                                                <option value="1">-- SIS --</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <p> <b>Archivo de referencia: </b> </p>
                                            <input type="file" name="archivo" disabled class="form-control" id="archivoRefrencia">

                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <p> <b>Nivel de Prioridad: </b> </p>
                                            <select name="prioridad" required
                                                class="form-control show-tick">
                                                <option value="">-- SELECCIONE --</option>
                                                <option value="0">-- NORMAL --</option>
                                                <option value="1">-- URGENTE --</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <p> <b>Servicio: </b> </p>
                                            <select name="idServicio" id="idServicioAdd" required onchange="getMedicos()"
                                                class="form-control show-tick">
                                                <option value="">-- SELECCIONE --</option>
                                                
                                                @foreach ($servicios as $servicio)
                                                    <option value="{{ $servicio->id }}">{{ $servicio->servicio }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <p> <b>Médico: </b> </p>
                                            <select name="idMedico" id="idMedicoAdd" disabled required
                                                class="form-control show-tick">
                                                <option value="">-- SELECCIONE --</option>
                                                @foreach ($medicos as $medico)
                                                    <option value="{{ $medico->id }}">{{ $medico->name }}
                                                        {{ $medico->last_name }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-125 col-md-125 col-sm-12">
                                            <p> <b>Paciente: </b> </p>
                                            <select name="idPaciente" id="idPacienteAdd" disabled required
                                                class="form-control show-tick">
                                                <option value="">-- SELECCIONE --</option>
                                                @foreach ($pacientes as $medico)
                                                    <option value="{{ $medico->id }}">{{ $medico->name }}
                                                        {{ $medico->last_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <p> <b>Fecha: </b> </p>
                                            <input type="date" onchange="buscarHorarios()" required
                                                class="form-control" name="fecha" id="fecha">
                                        </div>

                                        <div class="col-md-6">
                                            <p> <b>Horario: </b> </p>
                                            <select name="idHorario" id="idHorarioAdd" required
                                                class="form-control show-tick">
                                                <option value="">-- SELECCIONE --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <p> <b>Observaciones: </b> </p>
                                            <textarea rows="4" name="observaciones" required class="form-control no-resize"></textarea>
                                        </div>
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect"
                                    data-dismiss="modal">CERRAR</button>
                                <button type="submit" class="btn btn-success btn-round waves-effect">GUARDAR</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                @yield('contenidos')
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/deznav-init.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl-carousel/owl.carousel.js') }}"></script>

    <!-- Chart piety plugin files -->
    <script src="{{ asset('assets/vendor/peity/jquery.peity.min.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>

    {{-- Axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{ asset('assets/vendor/select2/js/select2.full.min.js') }}"></script>

    <!-- Jquery Validation -->
    <script src="{{ asset('assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>

    {{-- Chart Js --}}

    <script>
       function archivosis(){
        if ($("#tipoCita").val() == 1) {
                $("#archivoRefrencia").attr('disabled', false)
            } else {
                $("#archivoRefrencia").attr('disabled', true)
            }
        }

        $("#idMedicoAdd").select2();
        $("#idPacienteAdd").select2();
        $("#idServicioAdd").select2();

        function buscarHorarios() {
            axios.get('/api/getHorariosOcupados/' + $("#idMedicoAdd").val() + '/' + $("#fecha").val()).then((response) => {
                $("#idHorarioAdd").html(response.data)
                console.log(response.data)
            })
        }

        function getMedicos()
        {
            axios.get('/api/getMedicosByServcicio/'+$("#idServicioAdd").val()).then((response) => {
                $("#idMedicoAdd").html(response.data)
                $("#idMedicoAdd").attr('disabled', false)
                $("#idPacienteAdd").attr('disabled', false)
            })
        }
    </script>

    @yield('scripts')
</body>

</html>
