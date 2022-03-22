@extends('master')
@section('title','Citas del Día')
@section('content')

<div class="container-fluid ">
    <div >       
        <div class="row d-flex">
            @foreach($appointments as $a)
                <div class="col-md-4 mtop16">                    
                    <div class="card text-center">
                        <div class="card-header">
                        <strong> Paciente: </strong>   <br>
                        {{ $a->patient->affiliation }}
                        </div>
                        <div class="card-body"> 
                            
                            <h6 class="card-title" style="margin-top:-15px;"> <strong> {{ $a->patient->name.' '.$a->patient->lastname }} </strong></h6>        
                            <p class="card-text" style="margin-top:-15px;"><small> <strong>Expediente: </strong> {{ $a->num_study }}</small></p>     
                            <p class="card-text">
                                <small> 
                                    <strong>Estudio(s): </strong> 
                                    @foreach($detalles as $d)
                                        @if($d->idappointment == $a->id)
                                            @if($loop->last)
                                                {{ $d->study->name }}
                                            @else
                                                {{ $d->study->name }},
                                            @endif
                                        @endif
                                    @endforeach
                                </small>
                            </p>                              
                        </div>
                        <div class="card-footer text-muted">
                            <a href="{{ url('/patients_days/'.$a->id.'/materials') }}" data-action="materials" >Concluir Cita</a>
                        </div>
                    </div>                    
                </div>
            @endforeach
        </div>    
    </div>
</div>

@endsection