@extends('layouts.app')
@section('css')
        {{-- <link href="{{ asset('assets/vendor/flot/jquery.flot.js') }}" rel="stylesheet"> --}}
@endsection

@section('contenidos')
        <div class="col-md-12 ">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Bienvenido <b>{{Auth::user()->name." ".Auth::user()->last_name }} </b> </h2>
                        </div>
                        <div class="card-body">
                            Sistema de centro de salud de lima metropolitana
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