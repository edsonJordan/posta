@extends('layouts.app')


<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">


@section('contenidos')
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
@endsection
@section('modales')


    <div class="modal fade" id="modalCita" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Editar Cita</h4>
                </div>
                <div class="modal-body">
                    <form id="form-edit" action="{{ route('cita.update') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row clearfix">
                            <div class="col-md-6">
                                <p> <b>Fecha: </b> </p>
                                <input type="date" class="form-control" name="fecha"
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
                                <textarea required rows="4"  name="observaciones" id="observacionesEdit" class="form-control no-resize"></textarea>
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


@section('scripts')

<script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
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



    
async function getDataHorarios() {
  const apiUrl = "/api/horarios";
  const response = await fetch(apiUrl);
  const dataChart = await response.json();
  return dataChart;
}

    const calendar = async function calendar(){
        let dataHorarios = []
        dataHorarios = await getDataHorarios();
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {     
            customButtons: {
                /* addEventButton: {
                    text: "agregar cita",
                    prev: 'flaticon-381-home',
                    click: function() {
                    var dateStr = prompt('Enter a date in YYYY-MM-DD format');
                    var date = new Date(dateStr + 'T00:00:00'); // will be in local time
                    if (!isNaN(date.valueOf())) { // valid?
                        calendar.addEvent({
                        title: 'dynamic event',
                        start: date,
                        allDay: true
                        });
                        alert('Great. Now, update your database...');
                    } else {
                        alert('Invalid date.');
                    }
                    }
                } */
                },            
            headerToolbar: {            
            left: 'prev,next',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },           
            businessHours:dataHorarios,
            locale: 'es',
            editable: true,
            selectHelper:false,
            selectable: true,
            eventDurationEditable: false, // Disable Resize
            buttonText: { 
            prevText: "Anterior", 
            nextText: "Próximo", 
            currentText: "Hoja", 
            month: "Mes", 
            week: "Semana", 
            day: "Dia", 
            list: "Compromisos" },
            allDayText: 'Todo el dia',
            dayMaxEvents: true,     
            events: `/api/calendario/citas`,    
            selectConstraint: "businessHours",
            eventClick: function (info) {
                $('#modalCita').modal('show');
                const idCita = info.event.id
                axios.get(`/api/citas/${idCita}`)
                        .then((response) => {
                            const dataCita = response.data[0];
                            const idHorario = dataCita.horario.id;
                            const idMedico = dataCita.idMedico;
                            const fecha = dataCita.fecha;
                            const selectTag  =document.getElementById('fechaEdit');
                            selectTag.value = dataCita.fecha;  
                            selectTag.setAttribute('idMedico', dataCita.idMedico)                       
                            document.getElementById('observacionesEdit').value = dataCita.observaciones;    
                            document.getElementById('idCita').value=dataCita.id;                 
                           
                             return axios.get(`/api/horarios/bloqueo/${idHorario}/${idMedico}/${fecha}`)
                        })
                        .then((response)=>{
                            const data = response.data;                            
                            let selectHorario = document.getElementById('idHorarioEdit');
                            selectHorario.innerHTML=""
                            data.forEach((element,position)=>{
                                const myNewOption = new Option(element.horario, element.id, element.selected,element.selected);
                                selectHorario.options[position] = myNewOption;
                            });
                        })
            },            
            select: function(event) {
                var start = new Date(event.startStr);
                var end = new Date(event.endStr);
                var difference= Math.abs(start-end);
                days = difference/(1000 * 3600 * 24)
                if(days == 1 && event.allDay){
                    console.log("Pasas");
                }
                // console.log(event);
            },
            eventResize:function (event) {
                // console.log("resize");
            },
            eventDrop: function(info) {
                // console.log("Comienza con : "+info.event.startStr);
                // console.log(info.event.allDay);
                if(info.event.allDay) info.revert();
                const date = new Date(info.event.start)
                const dateYear = date.toLocaleDateString('es-CO', {year:"numeric",  timeZone: 'UTC' });
                const dateMonth = date.toLocaleDateString('es-CO', {month:"numeric",  timeZone: 'UTC' });
                const dateDay = date.toLocaleDateString('es-CO', {day:"numeric",  timeZone: 'UTC' });              
                const dateFormat = dateYear+"-"+dateMonth+"-"+dateDay;
                const serviceId = info.event.extendedProps.idServicio;
                const horarioId = info.event.extendedProps.idHorario;  
                const medicoId = info.event.extendedProps.idDoctor;    
                const descriptionCita = info.event.extendedProps.description;     
                let data=  axios.get(`/api/horarios/ocupados/${dateFormat}/${serviceId}/${horarioId}/${medicoId}`)
                        .then((response) => {
                            if(response.data.length > 0) {
                                swal("No se puede editar la cita", "Posiblemente exista la cita en la misma hora en el mismo dia o se intente cambiar la hora de la cita", "error");
                                info.revert();
                                return
                            }
                            const addZero = function addZeroBefore(n) {
                                return (n < 10 ? '0' : '') + n;
                                }
                            const hourOld = info.event.extendedProps.horaStart;                            
                            const eventHourOld = new Date(info.event.start);
                            const hourNew =  addZero(eventHourOld.getHours())+':'+addZero(eventHourOld.getMinutes())+':00'; 
                            if(hourOld === hourNew){  
                                const fecha = new Date(info.event.startStr).toLocaleDateString('es-CO', {year:"numeric", month:'numeric', day:'numeric',  timeZone: 'UTC' }).split("/").reverse(); 
                                const newFechaFormat = fecha[0]+"-"+fecha[1]+"-"+fecha[2];
                                const idEvent = info.event.id;
                                const idCita = info.event.id;   
                                axios.post(`/api/citas/update/${idCita}`,{
                                    fecha: newFechaFormat,
                                    id:idCita,
                                    idHorario:horarioId,
                                    observaciones:descriptionCita,
                                }).then(function (response) {
                                    swal("Se cambio la fecha de la cita", "Proceso terminado!", "success");
                                    
                                }).catch(function (error) {
                                    console.log(error);
                                });
                              
                            }else{
                                info.revert();
                                swal("No se puedo editar", "Si deseas editar una cita por horas debes ir a citas y editar su bloque de horario!", "error");
                            }
                })            
                // console.log(data);
                //  console.log("Termina en  : "+info.event.startStr);
                // console.log(info.event.start);
            },                       
        });
        calendar.render();
    }

    document.addEventListener('DOMContentLoaded', function() {      
        calendar();

      });
      document.getElementById('fechaEdit').addEventListener('change', (e)=>{   
        const idMedico =e.target.getAttribute('idMedico');
        const fecha = e.target.value;
            axios.get('/api/getHorariosOcupados/' + idMedico+ '/' + fecha).then((response) => {
                $("#idHorarioEdit").html(response.data)
            })
        
      })
      document.getElementById('form-edit').addEventListener('submit', (e)=>{
        e.preventDefault();
        const formData = new FormData(e.target);
        const formProps = Object.fromEntries(formData);
        const fechaCita = formProps.fecha;
        const idCita = formProps.idCita;
        const descriptionCita = formProps.observaciones;
        const horarioId = formProps.idHorario;

        axios.post(`/api/citas/update/${idCita}`,{
                                    fecha: fechaCita,
                                    id:idCita,
                                    idHorario:horarioId,
                                    observaciones:descriptionCita,
                                }).then(function (response) {
                                    $('#modalCita').modal('hide');
                                    calendar('refetchEvents');
                                    swal("Se editó correctamente la cita", "Proceso terminado!", "success");
                                    
                                }).catch(function (error) {
                                    swal("Ocurrio un error", error, "error");
                                });
      })
</script>
@endsection
