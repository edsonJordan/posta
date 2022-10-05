@extends('layouts.app')

@section('contenidos')
<style>
    .icon-large::before{
        font-size: 2.5rem;
        color: #FE634E;
        font-weight: 500;
    }
</style>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Bienvenido: {{ Auth::user()->name }} {{ Auth::user()->last_name }}</h2>
        </div>

        <div class="card-body">
            <div id='calendar'></div>
        </div>
        <div class="card-footer">
            
        </div>
    </div>
</div>
<?php
$idMedico = Auth::user()->id;
?>
@endsection
@section('modales')    
    <div class="modal fade" id="modalCita" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Vista Cita</h4>
                </div>
                <div class="modal-body">
                    <form id="form-edit" action="{{ route('cita.update') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row clearfix">
                            <div class="col-md-6">
                                <p> <b>Paciente: </b> </p>                                
                                <p id="paciente" ></p>
                            </div>

                            <div class="col-md-6">
                                <p> <b>Fecha de cita: </b> </p>                                
                                <p id="fechaEdit" ></p>
                            </div>

                            <div class="col-md-6">
                                <p> <b>Horario:  </b> </p>
                                <P id="idHorarioEdit"></P>
                            </div>
                            <div class="col-md-6">
                                <p> <b>Ficha:  </b> </p>
                                <P id="idFicha"></P>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-12">
                                <p> <b>Observaciones: </b> </p>
                                <p id="observacionesEdit"></p>                              
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CERRAR</button>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
<script>
    var r = document.querySelector(':root');
    const dangerStyle = window.getComputedStyle(document.documentElement).getPropertyValue('--danger');
    /* Style colors button header */
    r.style.setProperty('--fc-button-active-bg-color', dangerStyle);    
    r.style.setProperty('--fc-button-border-color', dangerStyle);
    r.style.setProperty('--fc-button-bg-color', dangerStyle);
    r.style.setProperty('--fc-button-hover-bg-color', dangerStyle);    
    r.style.setProperty('--fc-button-hover-border-color', dangerStyle);
    r.style.setProperty('--fc-button-active-border-color', dangerStyle);
    r.style.setProperty('--fc-event-bg-color', '#FE634E');

    
    const idMedico = '<?= $idMedico ?>'  
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {                
            locale: 'es',
            headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: { 
            prevText: "Anterior", 
            nextText: "Próximo", 
            currentText: "Hoja", 
            month: "Mes", 
            week: "Semana", 
            day: "Dia", 
            list: "Compromisos" },
            allDayText: 'Todo el dia',
            moreLinkText: 'mas',
            noEventsText: 'No events to display',            
            events: `/api/citasMedico/${idMedico}`,
            eventClick: function (info) {
                $('#modalCita').modal('show');
                const idCita = info.event.id
                axios.get(`/api/citas/${idCita}`)
                        .then((response) => {
                            const dataCita = response.data[0];
                            // console.log(dataCita);
                            const idHorario = dataCita.horario.id;
                            const idMedico = dataCita.idMedico;
                            const fecha = dataCita.fecha;
                            const selectTag  =document.getElementById('fechaEdit');
                            const paraHora = document.getElementById('idHorarioEdit')
                            const paraObervarciones = document.getElementById('observacionesEdit'); 
                            const paraPaciente = document.getElementById('paciente');
                            const archivo = document.getElementById('idFicha')
                            selectTag.innerHTML = dataCita.fecha; 
                            paraHora.innerHTML =    dataCita.horario.horario ;                   
                            paraObervarciones.innerHTML= dataCita.observaciones;
                            paraPaciente.innerHTML = dataCita.paciente.name+" "+dataCita.paciente.last_name;
                            if(dataCita.archivo != null) {
                                archivo.innerHTML = `<a href='/uploads/archivos/${dataCita.archivo}' target='_blank'>
                                    <i class="flaticon-381-file icon-large"></i>
                                    </a>`;
                            }else{
                                archivo.innerHTML = "Sin archivo";
                            }
                        })
            }            
        });
        calendar.render();
      });
</script>
@endsection
