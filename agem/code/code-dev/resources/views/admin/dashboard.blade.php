@extends('admin.master')
@section('title','Dashboard')

@section('content')
    

    <div class="container-fluid mtop16">
        @if(kvfj(Auth::user()->permissions, 'dashboard_small_stats'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-chart-bar"></i><strong> Estadísticas Rápidas Del Día</strong></h2>
                </div>
            </div>

            <div class="row mtop16">

                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-users"></i><strong> Citas Agendadas</strong></h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">
                                0
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-users"></i><strong> Citas en Atención</strong></h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">
                                0
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-users"></i><strong> Citas Ausentes</strong></h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">
                                0
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>           
        @endif
    </div>


    

@endsection