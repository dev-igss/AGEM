@extends('admin.master')
@section('title','Pacientes')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/patients') }}" class="nav-link"><i class="fas fa-users"></i> Pacientes</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

        <div class="header">
                <h2 class="title"><i class="fas fa-users"></i> Listado de Pacientes</h2>
                <ul>
                    @if(kvfj(Auth::user()->permissions, 'patient_add'))
                        <li>
                            <a href="{{ url('/admin/patient/add') }}" ><i class="fas fa-plus-circle"></i> Agregar Paciente</a>
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
                                            <a href="{{ url('/admin/patient/'.$p->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Ver"><i class="fas fa-edit"></i></a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'patient_history_exam'))
                                            <a href="{{ url('/admin/patient/'.$p->id.'/history_exam') }}" data-toogle="tooltrip" data-placement="top" title="Historial de Examenes"><i class="fas fa-book-medical"></i></a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'patient_edit'))
                                            <a href="{{ url('/admin/patient/'.$p->id.'/history_codes') }}" data-toogle="tooltrip" data-placement="top" title="Historial de Codigos"><i class="fas fa-list"></i></a>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $p->affiliation}}</td>
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
