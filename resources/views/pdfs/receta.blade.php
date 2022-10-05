<!DOCTYPE html>
<html lang="en">

<head>
    <title>PDF</title>
</head>

<body>
    <style>
        body *{
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            max-width: 100%;            
        }       
        .img-qr{
            position: relative;
            margin-top: 10px;
            right: 0%;
        }
            .tittle{
                display: block;
                position: absolute;
                color: #FE634E;
                font-weight: bold;
                font-size: 1rem;
                text-transform: uppercase;                
                text-align: left;
                bottom: 5px;
                width: 40%;
                float: left;
                padding-left: 5px;
            }
            .logo{
                display: block;
                width: 5%;
                float: left;
            }
            .span{
                display: block;
                position: absolute;
                float: right;
                text-align: right;
                width: 50%;
                bottom: 5px;
            }
            .header{
                min-width: 100vw;   
                position: relative;             
                border-bottom: 2px solid #FE634E;
               height: 40px;
            }
            .header-bottom{
                display: block;
                position: relative;
                width: 100vw;
                text-align: right;
                height: 40px;
            }           
            
            .tittle-bottom{
                display: block;
                top: 5px;
                float: left;
                height: 40px;                
                margin:0px;
                position: absolute;
            }            
            .span-bottom{
                display: block;
                float: right;
                height: 40px;
            }
            table{ 
                border-spacing: 0;               
            }
            table tr td{
                padding: 8px;
                border: .8px solid #BDBDBD;
            }
            .table{
                max-width: 100%;
                position: relative;
            }
            .table tr td:nth-child(odd){
                font-weight: bold;
                background-color: #F2F2F2;
                /* width: fit-content; */
                border: .8px solid #BDBDBD;
                color:#2A2A2A;
            }
             .footer {
                position: fixed; 
                bottom: -50px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                
                text-align: center;
                line-height: 35px;
            }
            .fecha{
                color: #2A2A2A;
                float: left;
            }
            .web{
                float: right;
            }
     </style>
         <div class="header">       
            <img class="logo" src="{{$ruta}}"alt="">
            <h1 class="tittle" >{{ $empresa->nombre }} </h1>
            <span class="span">
                RUC: {{ $empresa->documento }} -
                {{ $empresa->direccion }}       
            </span>
    </div>
    <div  class="header-bottom">
        <h5 class="tittle-bottom">            
         {{ $empresa->telefono }}
        </h5>
        <span class="span-bottom">
         {{ $empresa->correo }}
        </span>
    </div>
 
    <img class="img-qr" src="data:image/png;base64, {!! $qrcode !!}">
    <h1 style="margin-top:20px;text-align: center;  ">  <b>Receta</h1>        

    <h3 style="width: 100%; margin-top: 20px;text-transform:uppercase">Paciente</h3>
    {{-- Table Paciente --}}
    <table class="table"  style="width: 100%; margin-top: 5px">
        <tr>
            <td colspan="1">Nombre</td>
            <td colspan="3" >{{$recetas->paciente->name}}</td>
            <td colspan="1">Apellido</td>
            <td colspan="3">{{$recetas->paciente->last_name}}</td>
        </tr>
        <tr>
            <td >Teléfono</td>
            <td >{{$recetas->paciente->telefono}}</td>
            <td >Correo</td>
            <td >{{$recetas->paciente->email}}</td>
            <td >Documento</td>
            <td colspan="3" >{{$recetas->paciente->document}}</td>
        </tr>
    </table>
    
    {{-- End table Paciente --}}


    <h3 style="width: 100%; margin-top: 20px;text-transform:uppercase">Médico</h3>
    {{-- Table Doctor --}}
    <table class="table"  style="width: 100%; margin-top: 5px">
        <tr>
            <td>Nombre</td>
            <td  >{{$recetas->medico->name}}</td>
            <td>Apellido</td>
            <td>{{$recetas->medico->last_name}}</td>
        </tr>
        {{-- <tr>
            <td >Teléfono</td>
            <td >{{$recetas->medico->telefono}}</td>
            <td >Correo</td>
            <td >{{$recetas->medico->email}}</td>
        </tr> --}}
    </table>
    
    {{-- End table Doctor --}}



    <h3 style="width: 100%; margin-top: 20px;text-transform:uppercase">Diagnostico</h3>
    {{-- Table Diagnostico --}}
    <table class="table"  style="width: 100%; margin-top: 5px">
        <tr >
            <td style="width: 25%" >Motivo de visita</td>
            <td >{{$recetas->diagnostico->motivo}}</td>            
        </tr>
        
        <tr>
            <td >Alergias</td>
            <td >{{$recetas->diagnostico->alergias}}</td>
        </tr>        
        
        <tr>
            <td >Tratamiento</td>
            <td >{{$recetas->diagnostico->tratamiento}}</td>
        </tr>
       
    </table>

    {{-- <table>
        <tr>
            <td width="80%">
                <h1>{{ $empresa->nombre }}</h1>
                <span>
                    RUC: {{ $empresa->documento }} <br>
                    {{ $empresa->direccion }} <br>
                    {{ $empresa->telefono }} <br>
                    {{ $empresa->correo }} <br>
                    WEB: {{ $empresa->web }} <br>
                </span>
            </td>
            <td width="20%"><img src="{{$ruta}}" style="width: 100%" alt=""></td>
        </tr>
    </table> --}}

    {{-- <div style="margin-top: 30px">
        <b>Paciente: ({{$recetas->paciente->document}}) </b>{{$recetas->paciente->name}} {{$recetas->paciente->last_name}} <br>
        <b>Medico: ({{$recetas->medico->document}}) </b>{{$recetas->medico->name}} {{$recetas->medico->last_name}} <br>
        <b>Diagnostico:</b> {{$recetas->diagnostico->diagostico}} <br>
        <b>Tratamiento:</b> {{$recetas->diagnostico->tratamiento}}
    </div> --}}

        <table border="1" width="100%" style="margin-top: 30px">
            <thead>
                <tr>
                    <td colspan="5" style="text-align: center; font-size: 20px"><b>DETALLE DE MEDICAMENTOS</b> </td>
                </tr>
                <tr style="border: 1px solid">
                    <th>Medicamento</th>
                    <th>Presentacion</th>
                    <th>Dosis</th>
                    <th>Duracion</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($recetas->diagnostico->recetas as $receta)
                    <tr>
                        <td style="text-align: center">{{ $receta->medicamento }}</td>
                        <td style="text-align: center">{{ $receta->presentacion }}</td>
                        <td style="text-align: center">{{ $receta->dosis }}</td>
                        <td style="text-align: center">{{ $receta->duracion }}</td>
                        <td style="text-align: center">{{ $receta->cantidad }}</td>
                    </tr>
                @endforeach

            </tbody>


        </table>

        


        <footer class="footer" id="footer">
            <h4 class="fecha" >Receta emitida el: {{$recetas->created_at}} </h4>
            <h4 class="web">
                <a style="text-decoration:none;color:#FE634E" href="{{$empresa->web}}">{{$empresa->web}}</a>
            </h4>
        </footer>

</body>
   



</html>
