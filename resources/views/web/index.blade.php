<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Centro de salud Lima metropolitana</title>

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link href="{{ asset('assets/icons/font-awesome-old/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/dist/css/version3.1/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style-web.css') }}" rel="stylesheet">


</head>
<style>
  .modal-body{
    padding: 3rem;
  }
  .text-white{
    color:white;
  }
  .message{
    margin: 0 2rem;
  }
</style>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  <!--banner-->
  <section id="banner" class="banner">
      <div class="bg-color">
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="col-md-12">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img  src="{{ asset('assets/images/logo-posta-vector.png') }}" class="img-responsive" style=" margin-top: -16px;"></a>
              </div>
              <div class="collapse navbar-collapse navbar-right" id="myNavbar">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#banner">Inicio</a></li>
                  <li class=""><a href="#service">Servicios</a></li>
                  <li class=""><a href="#about">Nosotros</a></li>
                  <li class=""><a href="#testimonial">Testimonios</a></li>
                  <li class=""><a href="#contact">Contactanos</a></li>
                  @if (Auth::check())
                      <?php 
                      $rolUser=  Auth::user()->rol_id;
                        if($rolUser == 1){
                          ?>
                            <li class=""><a href="{{route('home')}}">Sistema</a></li>
                          <?php 
                        }else{
                          ?>
                            <li class=""><a href="{{route('home.user')}}">Sistema</a></li>
                          <?php 
                        }
                        
                      ?>
                   
                    <li class=""> 
                      
                        <a href="javascript:void(0)">
                          <strong>{{ Auth::user()->name }}</strong>
                        </a>
                      
                    </li>
                  @else
                    <li class="link_login"><a href="{{route('index')}}">Login</a></li>
                  @endif
                  
                </ul>
              </div>
            </div>
          </div>
        </nav>
        <div class="container">
          <div class="row">
            <div class="banner-info">
              <div class="banner-logo text-center pb-6">
                <img src="{{ asset('assets/images/texto-logo-extenso.png') }}" class="img-responsive">
              </div>
              <div class="banner-text text-center">
                <h1 class="white">Tu salud es lo mas importante en tu vida</h1>
                
                <a  class="btn btn-appoint" data-toggle="modal" data-target="#exampleModal" > 
                  <h4 class="text-white">Realizar una cita</h4>
                </a>
              </div>
              <div class="overlay-detail text-center">
                <a href="#service"><i class="fa fa-angle-down"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
                @if ($message = Session::get('success'))
                    <div class=" message alert alert-success alert-block mt-20" style="margin-top: 20px">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }} </strong>
                    </div>
                @endif
  <!--/ banner-->
  <!--service-->
  <section id="service" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <h2 class="ser-title">Nuesto servicios</h2>
          <hr class="botm-line">
          <p>Brindamos los servicios de Examen Médicos para Brevete (Auto, Moto) , aplicación de Vitamina C, Pruebas de descarte COVID19, Análisis Clínicos.</p>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <div class="icon-info">
              <h4>24 Horas de atención</h4>
              <p>Atendemos emergencias médicas y accidentales las 24 horas y 365 días del año, a través de ambulancias equipadas, así como servicios de traslado asistido y programado en Lima y provincias.
              </p>
            </div>
          </div>
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-ambulance"></i>
            </div>
            <div class="icon-info">
              <h4>Atención de emergencias</h4>
              <p>Atendemos emergencias médicas y accidentales las 24 horas y 365 días del año, a través de ambulancias equipadas, así como servicios de traslado asistido y programado en Lima y provincias.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-user-md"></i>
            </div>
            <div class="icon-info">
              <h4>Consultas Médicas</h4>
              <p>El Programa médico familiar cobertura las emergencias médicas prioridad 1, con atención en el lugar donde estas se produzcan (Dentro de nuestra zona de cobertura , las 24 horas del día)

              </p>
            </div>
          </div>
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-medkit"></i>
            </div>
            <div class="icon-info">
              <h4>Salud de primera calidad</h4>
              <p>Atención médica de primera calidad. Brinda atención médica integral para adultos y adolescentes. Sirve como un centro de atención primaria para enfermedades.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ service-->
  <!--cta-->
  <section id="cta-1" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="schedule-tab">
          <div class="col-md-4 col-sm-4 bor-left">
            <div class="mt-boxy-color"></div>
            <div class="medi-info">
              <h3>Caso de emergencia</h3>
              <p>Dolor repentino y severo en cualquier parte del cuerpo. Mareo, debilidad o cambio súbito en la visión. </p>
              <a href="#" class="medi-info-btn">Leer más</a>
            </div>
          </div>
          <div class="col-md-4 col-sm-4">
            <div class="medi-info">
              <h3>Caso de emergencia</h3>
              <p>Vómitos severos y persistentes. Lesión súbita debito a un accidente automovilístico, quemaduras o inhalación de humo, ahogamiento inminente, herida profunda o grande, otras lesiones</p>
              <a href="#" class="medi-info-btn">Leer más</a>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 mt-boxy-3">
            <div class="mt-boxy-color"></div>
            <div class="time-info">
              <h3>Horarios de ateción</h3>
              <table style="margin: 8px 0px 0px;" border="1">
                <tbody>
                  <tr>
                    <td>Lunes - Viernes</td>
                    <td>8.00 - 17.00</td>
                  </tr>
                  <tr>
                    <td>Sábado</td>
                    <td>9.30 - 17.30</td>
                  </tr>
                  <tr>
                    <td>Domingo</td>
                    <td>9.30 - 15.00</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--cta-->
  <!--about-->
  <section id="about" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="section-title">
            <h2 class="head-title lg-line">Centro de salud<br>  tu mejor opción </h2>
            <hr class="botm-line">
            <p class="sec-para">Infórmese sobre los centros de atención telefónica y otra tecnología y terminología de VoIP. GoTo proporciona soluciones para mejorar el trabajo remoto.  </p>
            <a href="" style="color: #0cb8b6; padding-top:10px;">Leer más..</a>
          </div>
        </div>
        <div class="col-md-9 col-sm-8 col-xs-12">
          <div style="visibility: visible;" class="col-sm-9 more-features-box">
            <div class="more-features-box-text">
              <div class="more-features-box-text-icon"> <i class="fa fa-angle-right" aria-hidden="true"></i> </div>
              <div class="more-features-box-text-description">
                <h3>Es algo importante que quieres saber.                </h3>
                <p>Una administración eficiente de las acciones en las instituciones de salud es ideal para una distribución equitativa de las actividades entre el personal, dando la oportunidad de una mejor calidad de vida y mejores ambientes laborales.</p>
              </div>
            </div>
            <div class="more-features-box-text">
              <div class="more-features-box-text-icon"> <i class="fa fa-angle-right" aria-hidden="true"></i> </div>
              <div class="more-features-box-text-description">
                <h3>Es algo importante que quieres saber.</h3>
                <p> Existen varios beneficios de tener una vida saludable, pero el principal de ellos que podríamos nombrar es que nuestro cuerpo se libera de las diversas formas de trastornos y complicaciones y, por tanto, se obtiene una vida más larga, sin sufrir ningún tipo de dolores o malestares.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ about-->
  <!--doctor team-->
  <section id="doctor-team" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="ser-title">Conversa con nuestros doctores  !</h2>
          <hr class="botm-line">
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="thumbnail">
            <img src="{{asset('assets/images/web/doctor1.jpg')}} " alt="..." class="team-img">
            <div class="caption">
              <h3>Jessica Wally</h3>
              <p>Doctor</p>
              <ul class="list-inline">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="thumbnail">
            <img src="{{asset('assets/images/web/doctor2.jpg')}} " alt="..." class="team-img">
            <div class="caption">
              <h3>Iai Donas</h3>
              <p>Doctor</p>
              <ul class="list-inline">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="thumbnail">
            <img src="{{asset('assets/images/web/doctor3.jpg')}} " alt="..." class="team-img">
            <div class="caption">
              <h3>Amanda Denyl</h3>
              <p>Doctor</p>
              <ul class="list-inline">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="thumbnail">
            <img src="{{asset('assets/images/web/doctor4.jpg')}} " alt="..." class="team-img">
            <div class="caption">
              <h3>Jason Davis</h3>
              <p>Doctor</p>
              <ul class="list-inline">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ doctor team-->
  <!--testimonial-->
  <section id="testimonial" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="ser-title">que dicen nuestros pacientes?</h2>
          <hr class="botm-line">
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="testi-details">
            <!-- Paragraph -->
            <p>Excelente comenzando atención desde el joven que está en la entrada asta el doctor las enfermemera, todos son un amor.

            </p>
          </div>
          <div class="testi-info">
            <!-- User Image -->
            <a href="#"><img src="{{asset('assets/images/web/thumb.png')}} " alt="" class="img-responsive"></a>
            <!-- User Name -->
            <h3>Alex<span>Texas</span></h3>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="testi-details">
            <!-- Paragraph -->
            <p>Excelente atención desde el joven en la entrada al médico y las enfermeras, todos son un amor.

              .</p>
          </div>
          <div class="testi-info">
            <!-- User Image -->
            <a href="#"><img src="{{asset('assets/images/web/thumb.png')}}" alt="" class="img-responsive"></a>
            <!-- User Name -->
            <h3>Alex<span>Texas</span></h3>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="testi-details">
            <!-- Paragraph -->
            <p>¡Me encantó la oficina! El personal fue muy atento y dulce.
            </p>
          </div>
          <div class="testi-info">
            <!-- User Image -->
            <a href="#"><img src="{{asset('assets/images/web/thumb.png')}}" alt="" class="img-responsive"></a>
            <!-- User Name -->
            <h3>Alex<span>Texas</span></h3>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ testimonial-->
  <!--cta 2-->
  <section id="cta-2" class="section-padding">
    <div class="container">
      <div class=" row">
        <div class="col-md-2"></div>
        <div class="text-right-md col-md-4 col-sm-4">
          <h2 class="section-title white lg-line">« UNAS POCAS PALABRAS
           <br>  SOBRE NOSOTROS »</h2>
        </div>
        <div class="col-md-4 col-sm-5">
          La calidad es importante. Algunos centros trabajan mejor que otros. Una forma de saber acerca de la calidad de un centro es revisar los informes realizados por el gobierno nacional, estatal y grupos de consumidores.
          <p class="text-right text-primary"><i>—Lima metropolitana</i></p>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
  </section>
  <!--cta-->
  <!--contact-->
  <section id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="ser-title">Contáctanos</h2>
          <hr class="botm-line">
        </div>
        <div class="col-md-4 col-sm-4">
          <h3>Información de contacto</h3>
          <div class="space"></div>
          <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>Lima<br> Metropolitana</p>
          <div class="space"></div>
          <p><i class="fa fa-envelope-o fa-fw pull-left fa-2x"></i>info@companyname.com</p>
          <div class="space"></div>
          <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>+01 823 1234</p>
        </div>
        <div class="col-md-8 col-sm-8 marb20">
          <div class="contact-info">
            <h3 class="cnt-ttl">¡Consiga alguna consulta! O Reserve una cita</h3>
            <div class="space"></div>
            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
              <div class="form-group">
                <input type="text" name="name" class="form-control br-radius-zero" id="name" placeholder="Tu nombre" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control br-radius-zero" name="email" id="email" placeholder="Tu correo" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control br-radius-zero" name="subject" id="subject" placeholder="Asunto" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control br-radius-zero" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Mensaje"></textarea>
                <div class="validation"></div>
              </div>

              <div class="form-action">
                <button type="submit" class="btn btn-form">Enviar mensaje</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ contact-->
  <!--footer-->
  <footer id="footer">
    <div class="top-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">Acerca de nosotros</h4>
            </div>
            <div class="info-sec">
              <p>Infórmese sobre los centros de atención telefónica y otra tecnología y terminología de VoIP. GoTo proporciona soluciones para mejorar el trabajo remoto.                .</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">Enlaces rápidos
              </h4>
            </div>
            <div class="info-sec">
              <ul class="quick-info">
                <li><a href="index.html"><i class="fa fa-circle"></i>Inicio</a></li>
                <li><a href="#service"><i class="fa fa-circle"></i>Servicios</a></li>
                <li><a href="#contact"><i class="fa fa-circle"></i>Citas</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">Siguenos</h4>
            </div>
            <div class="info-sec">
              <ul class="social-icon">
                <li class="bglight-blue"><i class="fa fa-facebook"></i></li>
                <li class="bgred"><i class="fa fa-google-plus"></i></li>
                <li class="bgdark-blue"><i class="fa fa-linkedin"></i></li>
                <li class="bglight-blue"><i class="fa fa-twitter"></i></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-line">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            © Copyright Medilab Theme. All Rights Reserved
            <div class="credits">              
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade.com</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/ footer-->

  {{-- / Model --}}
 
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Crear una cita</h4>
            </div>
            <div class="modal-body ">
                <form action="{{ route('cita.store') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                    enctype="multipart/form-data">
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
                          <input required type="file" name="archivo" disabled class="form-control" id="archivoRefrencia">
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
                            <p> <b>Especialidad: </b> </p>
                            <select required name="idServicio" id="idServicio"  class="form-control show-tick">
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
                            <select required name="idMedico" id="idMedico" class="form-control show-tick">
                                <option value="">-- SELECCIONE --</option>
                                {{-- @foreach ($medicos as $medico)
                                    <option value="{{$medico->id}}">{{$medico->name}} {{$medico->last_name}}</option>
                                @endforeach --}}
                            </select>

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <p> <b>Fecha: </b> </p>
                            <input required type="date"  class="form-control" name="fecha" id="fecha">
                        </div>
                        <div class="col-md-6">
                            <p> <b>Horario Disponible:  </b> </p>
                            <select required  name="idHorario" id="idHorario" class="form-control show-tick">
                                <option value="">-- SELECCIONE --</option>
                            </select>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <p> <b>Observaciones: </b> </p>
                            <textarea required rows="4"  name="observaciones" id="observaciones" class="form-control no-resize"></textarea>
                            <input value="{{$userAuth}}" type="hidden" id="idPaciente" name="idPaciente">
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


  <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/web/custom.js') }}"></script>
  
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
<script>

  const userId = '<?=$userAuth?>';
  const userRol = '<?=$userRol?>';
  const isLoggin = userId === "";
  const isPacient = userRol === "4";
    $('.btn-appoint').click(function(){
      if(isLoggin) {
        window.location.href = "/";
        return false;
      }
      if(isPacient) {
        return true;
      }
      return false;    
    });


    async function getDataUserEspecialidad(especialidad) {
      const apiUrl = `/api/usuarios/especialidad/${especialidad}`;
        const response = await fetch(apiUrl);
        const users = await response.json();
       return users;
    }

    async function getDataHorariosLibres(medico, fecha) {
      const apiUrl = `/api/horarios/medico/ocupado/${medico}/${fecha}`;
        const response = await fetch(apiUrl);
        const horarios = await response.json();
       return horarios;
    }

    /* Start Change Listening evento select */
    document.getElementById('idServicio').addEventListener('change', async(e)=>{
        const valueSelect = e.target.value;
        const valueIsNull =valueSelect === "";
        if(valueIsNull) return false;

        const dataMedicos = await getDataUserEspecialidad(valueSelect);
                let selectMedico = document.getElementById('idMedico');
                selectMedico.innerHTML=""
                dataMedicos.forEach((element,position)=>{
                const myNewOption = new Option(element.name+" "+element.last_name, element.id);
                selectMedico.options[position] = myNewOption;
              });
              document.getElementById('fecha').value="";
              document.getElementById('idHorario').innerHTML= "<option value=''>-- SELECCIONE --</option>";
    })
    /* End Change Listening evento select */

    document.getElementById('idMedico').addEventListener('change', async(e)=>{
        const valueSelect = e.target.value;
        const valueIsNull =valueSelect === "";
        if(valueIsNull) return false;

        document.getElementById('fecha').value="";
        document.getElementById('idHorario').innerHTML= "<option value=''>-- SELECCIONE --</option>";
        
    })



    /* Event listen event change select */
    document.getElementById('fecha').addEventListener('change', async (e)=>{
        const valueSelect = e.target.value;
        const valueIsNull =valueSelect === "";
        if(valueIsNull) return false;



        const paramMedicoId = document.getElementById('idMedico').value;
        const horariosLibres = await getDataHorariosLibres(paramMedicoId,valueSelect);

        let selectHorario = document.getElementById('idHorario');
        selectHorario.innerHTML=""
        horariosLibres.forEach((element,position)=>{
        const myNewOption = new Option(element.horario, element.id);
        selectHorario.options[position] = myNewOption;
        });
    })



    function archivosis(){
        if ($("#tipoCita").val() == 1) {
                $("#archivoRefrencia").attr('disabled', false)
            } else {
                $("#archivoRefrencia").attr('disabled', true)
            }
    }



    
</script>

</html>
