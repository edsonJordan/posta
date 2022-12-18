@extends('layouts.app')
@section('css')
        {{-- <link href="{{ asset('assets/vendor/flot/jquery.flot.js') }}" rel="stylesheet"> --}}
@endsection

@section('contenidos')
        <div class="col-md-12 ">
            <div class="row">
                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Gráfico de registros de citas por Meses</h2>
                        </div>
                        <div class="card-body">
                            <canvas id="areaChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">   
                            <h2 class="card-title">Gráfico de conteo de citas por años</h2>                 
                        </div>
                        <div class="card-body">
                            <div class="float-chart-container">
                                <canvas id="doughnutChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">   
                            <h2 class="card-title">Gráfico de citas por estados del mes actual</h2>                 
                        </div>
                        <div class="card-body">
                            <div class="float-chart-container">
                                <canvas id="doughnutChart2" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>  
        <div class="col-md-12 ">
            <div class="row">
                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Gráfico general de ventas por años</h2>
                        </div>
                        <div class="card-body">
                            <canvas id="lineChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Gráfico general de ventas por mes</h2>
                        </div>
                        <div class="card-body">
                            <canvas id="lineChart3" height="250"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Gráfico general de ventas por semana</h2>
                        </div>
                        <div class="card-body">
                            <canvas id="lineChart2" height="250"></canvas>
                        </div>
                    </div>
                </div>                
            </div>
        </div>  
          
        <div class="col-md-12 ">
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">grafico conteo de usuarios por años</h2>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" height="250"></canvas>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">grafico conteo de usuarios por roles</h2>
                        </div>
                        <div class="card-body">
                            <canvas id="barChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
                 
            </div>
        </div>    
@endsection

@section('scripts')

<script src="{{asset('assets/vendor/chart.js/Chart.bundle.min.js')}}"></script>

{{-- Chart flot --}}
<script src="{{asset('assets/vendor/flot/jquery.flot.js')}}"></script>
<script src="{{asset('assets/vendor/flot/jquery.flot.resize.js')}}"></script>

<script src="{{asset('assets/js/chart.js/config.js')}}"></script>


@endsection