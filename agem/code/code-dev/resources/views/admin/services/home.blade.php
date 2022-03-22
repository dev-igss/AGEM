@extends('admin.master')
@section('title','Servicios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/all') }}" class="nav-link"><i class="fas fa-bed"></i> Ambientes</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                @if(kvfj(Auth::user()->permissions, 'serviceg_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Servicio General</h2>
                        </div>

                        <div class="inside">
                            {!! Form::open(['url' => '/admin/services_g/add', 'files' => true]) !!}
                                <label for="name"> <strong><sup style="color: red;">(*)</sup> Nombre: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="unit_id"  class="mtop16"><strong><sup style="color: red;">(*)</sup> Unidad Hospitalaria:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('unit_id', $units,1,['class'=>'form-select']) !!}
                                </div>

                                {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-bed"></i> Servicios Generales </h2>
                        
                    </div>

                    <div class="inside">
                        <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                            <thead>
                                <tr>
                                    <td><strong>OPCIONES</strong></td>
                                    <td><strong>NOMBRE</strong></td>
                                    <td><strong>UNIDAD HOSPITALARIA</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($environment as $env)
                                    <tr>
                                        <td>
                                            <div class="opts">
                                                @if(!is_null($env->file_path) && !is_null($env->file_name))
                                                    <a href="{{ url('/uploads/services_photos/'.$env->file_path.'/'.$env->file_name) }}" target="_blank" title="Ver Plano General"><i class="fas fa-image"></i> </a>
                                                @endif

                                                @if(kvfj(Auth::user()->permissions, 'serviceg_edit'))
                                                    <a href="{{ url('/admin/services_g/'.$env->id.'/edit') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                                @endif                                             
                                                
                                                @if(kvfj(Auth::user()->permissions, 'service_list'))
                                                    <a href="{{ url('/admin/services_g/'.$env->id.'/services') }}"  title="Servicios"><i class="fas fa-list-ul"></i></a>
                                                @endif  

                                            </div>
                                        </td>
                                        <td>{{$env->name}}</td>
                                        <td>{{$env->unit->name}}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
