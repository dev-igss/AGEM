@extends('admin.master')
@section('title','Pacientes')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/pacientes') }}" class="nav-link"><i class="fas fa-users"></i> Pacientes</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

        <div class="header"> 
                <h2 class="title"><i class="fas fa-users"></i> <strong>Listado de Pacientes</strong></h2>
                <ul>
                    @if(kvfj(Auth::user()->permissions, 'patient_add'))
                        <li>
                            <a href="{{ url('/admin/paciente/agregar') }}" ><i class="fas fa-plus-circle"></i> Agregar Paciente</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="inside">               

                <table id="table-modules" class="table table-striped table-hover mtop16">
                    <thead>
                        <tr>
                            <td><strong> OPCIONES </strong></td>
                            <td><strong> AFILIACION </strong></td>
                            <td><strong> APELLIDOS </strong></td>
                            <td><strong> NOMBRE </strong></td>                            
                            <td><strong> CONTACTO </strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $p)
                            <tr>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'patient_edit'))
                                            <a href="{{ url('/admin/paciente/'.$p->id.'/editar') }}" data-toogle="tooltrip" data-placement="top" title="Ver"><i class="fas fa-edit"></i></a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'patient_history_exam'))
                                            <a href="{{ url('/admin/paciente/'.$p->id.'/historial_citas') }}" data-toogle="tooltrip" data-placement="top" title="Historial de Examenes"><i class="fas fa-book-medical"></i></a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'patient_edit'))
                                            <a href="{{ url('/admin/paciente/'.$p->id.'/historial_codigos_expedientes') }}" data-toogle="tooltrip" data-placement="top" title="Historial de Codigos"><i class="fas fa-list"></i></a>
                                        @endif
                                        @if($p->affiliation_principal != NULL)
                                            <a href="{{ url('/admin/paciente/'.$p->id.'/actualizar/afiliacion/principal/'.$p->affiliation_principal) }}" data-toogle="tooltrip" data-placement="top" title="Actualizar Afiliación Principal"><i class="fa fa-refresh"></i></a>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    
                                    @if($p->type == '1' || $p->type == '2')                                        
                                        <span>
                                            {{ getTypePatient(null, $p->type).': '.$p->affiliation}} <br>
                                            <small>
                                                <strong>AF. Principal: </strong> 
                                                @if($p->affiliation_principal != NULL)
                                                    {{ $p->affiliation_principal }}
                                                @else
                                                    {{ $p->parent->affiliation }}
                                                @endif
                                            </small>
                                        </span>                                        
                                    @else 
                                        {{ getTypePatient(null, $p->type).': '.$p->affiliation}}
                                    @endif
                                </td>
                                <td>{{ $p->lastname }}</td>
                                <td>{{ $p->name }}</td>                                
                                <td>{{ $p->contact }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
