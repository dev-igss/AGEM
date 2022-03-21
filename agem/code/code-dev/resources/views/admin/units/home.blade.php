@extends('admin.master')
@section('title','Unidades')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/units') }}" class="nav-link"><i class="fas fa-hospital-user"></i> Unidades</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                @if(kvfj(Auth::user()->permissions, 'unit_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Unidad</h2>
                        </div>

                        <div class="inside">
                            {!! Form::open(['url' => '/admin/unit/add', 'files' => true]) !!}
                                <label for="name"><strong> Nombre de Unidad:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="name" class="mtop16"><strong> Codigo de Unidad:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('code', null, ['class'=>'form-control']) !!}
                                </div>

                                <label class="mtop16"> <strong> Municipio de Ubicación </strong></label>
                                <select name="municipality_id" id="idsupplier" style="width: 100%;">
                                    @foreach ($municipalities as $m)                                    
                                        <option></option>
                                        <option value="{{$m->id}}">{{$m->code.' / '.$m->name.' / '.$m->dep->name}}</option>
                                    @endforeach
                                </select>

                                {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-hospital-user"></i> Unidades Hospitalarias o Departamentales</a>
                    </div>

                    <div class="inside">
                        <table id="table-modules" class="table table-striped table-hover mtop16">
                            <thead>
                                <tr>
                                    <td width="140px"> <strong>OPCIONES</strong> </td>
                                    <td><strong> NOMBRE</strong> </td>
                                    <td><strong> UBICACION</strong> </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($units as $unit)
                                    <tr>
                                        <td>
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'unit_edit'))
                                                <a href="{{ url('/admin/unit/'.$unit->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permissions, 'unit_delete'))
                                                <a href="{{ url('/admin/unit/'.$unit->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </div>
                                        </td>
                                        <td>{{ $unit->name }}</td>
                                        <td>{{ $unit->mun->name.' / '.$unit->mun->dep->name }}</td>
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
