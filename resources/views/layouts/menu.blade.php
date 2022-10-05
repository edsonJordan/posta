 <div class="deznav">
     <div class="deznav-scroll">
        @if(Auth::user()->rol_id != 3)
         <a href="javascript:void(0)" class="add-menu-sidebar" data-toggle="modal" data-target="#newCita">+ Nueva
             Cita</a>
        @endif
                {{-- Rol administrador --}}
                @if (Auth::user()->rol_id == 1)

                    <ul class="metismenu" id="menu">
                        <li><a href="{{ route('index') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-internet"></i>
                                <span class="nav-text">Web</span>
                            </a>
                        </li>
                      

                        <li>
                            <a href="{{ route('home') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-home"></i>
                                <span class="nav-text">Inicio</span>
                            </a>
                        </li>
                        

                        <li>
                            <a href="{{ route('calendario.index') }}" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-calendar-1"></i>
                            <span class="nav-text">Calendario</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('performance.index') }}" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-speedometer"></i>
                            <span class="nav-text">Performance</span>
                            </a>
                        </li>
                        


                        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <i class="flaticon-381-user"></i>
                                <span class="nav-text">Usuarios</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('administradores') }}">Administradores</a></li>
                                <li><a href="{{ route('medicos') }}">Médicos</a></li>
                                <li><a href="{{ route('pacientes') }}">Pacientes</a></li>
                                <li><a href="{{ route('farmaceutas') }}">Farmaceutas</a></li>
                            </ul>
                        </li>

                        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <i class="flaticon-381-bookmark-1"></i>

                                <span class="nav-text">Citas</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('citas') }}">Citas</a></li>
                                <li><a href="{{ route('citas-sis') }}">Citas SIS</a></li>
                                <li><a href="{{ route('triaje.index') }}">Triaje</a></li>
                                <li><a href="{{ route('diagnostico.index') }}">Diagnostico</a></li>
                            </ul>
                        </li>

                        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <i class="flaticon-381-bookmark-1"></i>

                                <span class="nav-text">Pagos</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('pago.index') }}">Pagos Por Generar</a></li>
                                <li><a href="{{ route('pago.realizados') }}">Pagos Realizados</a></li>
                            </ul>
                        </li>

                        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <i class="flaticon-381-bookmark-1"></i>

                                <span class="nav-text">Farmacia</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('farmacia.index') }}">Buscar Receta</a></li>
                                <li><a href="{{ route('farmacia.venta') }}">Vender</a></li>
                                <li><a href="{{ route('farmacia.ventas') }}">Ventas</a></li>
                                <li><a href="{{ route('farmacia.medicamentos') }}">Medicamentos</a></li>
                            </ul>
                        </li>



                        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <i class="flaticon-381-settings-2"></i>

                                <span class="nav-text">Configuraciones</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('horarios.index') }}">Bloques Horarios</a></li>
                                <li><a href="{{ route('servicios.index') }}">Servicios</a></li>
                                <li><a href="{{ route('empresa.index') }}">Información Posta</a></li>
                            </ul>
                        </li>
                    </ul>


                {{-- Rol  Medicos--}}
                @elseif(Auth::user()->rol_id == 2)             
                    <ul class="metismenu" id="menu">
                        <li>
                            <a href="{{ route('home.user') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-home"></i>
                                <span class="nav-text">Inicio</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('mi-calendario-medico') }}" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-calendar-1"></i>
                            <span class="nav-text">Mi calendario</span>
                            </a>
                        </li>

                        <li><a href="{{ route('index') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-internet"></i>
                                <span class="nav-text">Web</span>
                            </a>
                        </li>

                        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                                <i class="flaticon-381-user"></i>

                                <span class="nav-text">Usuarios</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('pacientes') }}">Pacientes</a></li>
                            </ul>
                        </li>

                        <li><a href="{{ route('mis-citas-medico') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-home"></i>
                                <span class="nav-text">Mis citas</span>
                            </a>
                        </li>

                        <li><a href="{{ route('mis-diagnostico') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-home"></i>
                                <span class="nav-text">Diagnosticos</span>
                            </a>
                        </li>

                    </ul>
                
                {{-- Rol Farmaceuta --}}
         @elseif(Auth::user()->rol_id == 3)
             <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('home.user') }}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-home"></i>
                        <span class="nav-text">Inicio</span>
                    </a>
                </li>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                         <i class="flaticon-381-bookmark-1"></i>
                         <span class="nav-text">Farmacia</span>
                        </a>
                     <ul aria-expanded="false">
                         <li><a href="{{ route('farmacia.index') }}">Buscar Receta</a></li>
                         <li><a href="{{ route('farmacia.venta') }}">Vender</a></li>
                         <li><a href="{{ route('farmacia.ventas') }}">Ventas</a></li>
                     </ul>
                 </li>
             </ul>
        {{--Rol Paciente--}}
         @elseif(Auth::user()->rol_id == 4)
         <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('home.user') }}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-home"></i>
                        <span class="nav-text">Inicio</span>
                    </a>
                </li>
                 <li><a href="{{ route('index') }}" class="ai-icon" aria-expanded="false">
                         <i class="flaticon-381-home"></i>
                         <span class="nav-text">Inicio</span>
                     </a>
                 </li>

                <li><a href="{{ route('mis-citas') }}" class="ai-icon" aria-expanded="false">
                         <i class="flaticon-381-home"></i>
                         <span class="nav-text">Mis citas</span>
                     </a>
                 </li>

                 <li><a href="{{ route('mi-historial') }}" class="ai-icon" aria-expanded="false">
                         <i class="flaticon-381-home"></i>
                         <span class="nav-text">Mi Historial Medico</span>
                     </a>
                 </li>




             </ul>
         @endif
     </div>
 </div>
