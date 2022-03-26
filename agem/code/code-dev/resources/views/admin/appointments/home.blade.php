@extends('admin.master')
@section('title','Citas')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/patients') }}" class="nav-link"><i class="fas fa-calendar-alt"></i> Citas</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-calendar-alt"></i><strong> Listado de Citas</strong> </h2>
                <ul>
                    @if(kvfj(Auth::user()->permissions, 'patient_add'))
                        <li>
                            <a href="{{ url('/admin/appointment/add') }}" ><i class="fas fa-plus-circle"></i> Agendar Cita</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="inside">               

                <table id="table-modules" class="table table-striped table-hover mtop16">
                    <thead>
                        <tr>
                            <td><strong> OPCIONES </strong></td>
                            <td width="48px"><strong> CORRELATIVO </strong></td>
                            <td><strong> FECHA </strong></td>
                            <td><strong> PACIENTE </strong></td>
                            <td><strong> ESTADO </strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $a)
                            <tr>
                                <td>
                                <div class="opts">
                                    @if(kvfj(Auth::user()->permissions, 'appointment_reschedule'))
                                        @if($a->status == '0')
                                            <a href="#" data-action="reschedule" data-path="admin/appointment" data-object="{{ $a->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Reagendar" id="btn_reprogramar"><i class="fas fa-calendar-alt"></i></a>
                                        @endif
                                    @endif

                                    @if(kvfj(Auth::user()->permissions, 'appointment_patients_status'))
                                        @if($a->status == '0' || $a->status == '4')
                                            <a href="#" data-action="patients_in" data-path="admin/appointment" data-object="{{ $a->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Paciente Presente"><i class="fas fa-calendar-check"></i></a>
                                            <a href="#" data-action="patients_out" data-path="admin/appointment" data-object="{{ $a->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Paciente Ausente"><i class="fas fa-calendar-times"></i></a>
                                        @endif
                                    @endif

                                    @if(kvfj(Auth::user()->permissions, 'appointment_materials'))
                                        @if($a->status == '3')
                                            <a href="{{ url('/admin/appointment/'.$a->id.'/materials') }}"  title="Materiales Usados" ><i class="fas fa-x-ray"></i></a>
                                        @endif
                                    @endif
                                </div>
                                </td>
                                <td> {{ $a->id }} </td>
                                <td>
                                    {{ $a->date }} <br>
                                    <small> {{ getTypeAppointment(null, $a->type)  }} </small>
                                </td>
                                <td> 
                                    <span>AF. {{ $a->patient->affiliation }}</span> <br>
                                    {{ $a->patient->name.' '.$a->patient->lastname }} <br>
                                    <small>Expediente. {{ $a->num_study }}</small>
                                </td>
                                <td>
                                    {{ getStatusAppointment(null, $a->status)  }}
                                    
                                    @if($a->status == '3')
                                        <p>
                                            <small style=" font-size: 0.95em;">
                                                @if($a->ibm_tecnico_2 == NULL)
                                                    <strong >Tecnico: </strong> {{ $a->tecnico1->name.' '.$a->tecnico1->lastname }}
                                                @else
                                                    <strong >Tecnicos: </strong> {{ $a->tecnico1->name.' '.$a->tecnico1->lastname }} <br>
                                                    {{ $a->tecnico2->name.' '.$a->tecnico2->lastname }}
                                                @endif
                                            </small>
                                        </p>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


@endsection