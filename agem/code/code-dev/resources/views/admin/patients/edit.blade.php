@extends('admin.master')
@section('title','Editar Paciente')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/all') }}" class="nav-link"><i class="fas fa-columns"></i> Equipos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Editar: {{ $patient->name }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::open(['url'=>'/admin/patient/'.$patient->id.'/edit']) !!}
        <div class="row">
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-cogs"></i><strong> Información Basica</strong></h2>
                    </div>

                    <div class="inside">   
                        <label for="name" class="mtop16"><strong>(*) Numero de Afiliacion: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('affiliation', $patient->affiliation, ['class'=>'form-control', 'readonly']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong>(*) Nombre:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name', $patient->name, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong>(*) Apellidos:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('lastname', $patient->lastname, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong>(*) Unidad del Paciente:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('unit', $patient->unit->name, ['class'=>'form-control', 'readonly']) !!}
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-cogs"></i><strong> Información Adicional</strong></h2>
                    </div>

                    <div class="inside"> 
                        

                        <label for="name" class="mtop16"><strong>Edad:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('age', $patient->age, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong>Fecha de Nacimiento:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::date('birth', $patient->birth, ['class'=>'form-control']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong>(*) Numero de Contacto:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('contact', $patient->contact, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4 d-flex"> 
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-qrcode"></i><strong> Numeros de Expedientes</strong></h2>
                    </div>

                    <div class="inside"> 
                        <label for="ibm" class="mtop16"><strong>Numero RX:</strong> @foreach($code_rx as $crx) {{ $crx->code }} @endforeach</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('num_rx', null, ['class'=>'form-control', 'id' => 'pnum_rx']) !!} 
                            <a href="#" class="btn btn-sm btn-primary " id="btn_generate_code_rx" ><i class="fas fa-qrcode"></i> Actualizar</a>
                            {!! Form::hidden('num_rx_nom', null, ['class'=>'form-control', 'id' => 'pnum_rx_nom']) !!} 
                            {!! Form::hidden('num_rx_cor', null, ['class'=>'form-control', 'id' => 'pnum_rx_cor']) !!} 
                            {!! Form::hidden('num_rx_y', null, ['class'=>'form-control', 'id' => 'pnum_rx_y']) !!} 
                        </div>

                        <label for="ibm" class="mtop16"><strong>Numero USG:</strong> @foreach($code_usg as $cusg) {{ $cusg->code }} @endforeach</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('num_usg', null, ['class'=>'form-control', 'id' => 'pnum_usg']) !!} 
                            <a href="#" class="btn btn-sm btn-primary " id="btn_generate_code_usg" ><i class="fas fa-qrcode"></i> Actualizar</a>
                            {!! Form::hidden('num_usg_nom', null, ['class'=>'form-control', 'id' => 'pnum_usg_nom']) !!} 
                            {!! Form::hidden('num_usg_cor', null, ['class'=>'form-control', 'id' => 'pnum_usg_cor']) !!} 
                            {!! Form::hidden('num_usg_y', null, ['class'=>'form-control', 'id' => 'pnum_usg_y']) !!} 
                        </div>

                        <label for="ibm" class="mtop16"><strong>Numero MMO:</strong> @foreach($code_mmo as $cmmo) {{ $cmmo->code }} @endforeach</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('num_mmo', null, ['class'=>'form-control', 'id' => 'pnum_mmo']) !!} 
                            <a href="#" class="btn btn-sm btn-primary " id="btn_generate_code_mmo" ><i class="fas fa-qrcode"></i> Actualizar</a>
                            {!! Form::hidden('num_mmo_nom', null, ['class'=>'form-control', 'id' => 'pnum_mmo_nom']) !!} 
                            {!! Form::hidden('num_mmo_cor', null, ['class'=>'form-control', 'id' => 'pnum_mmo_cor']) !!} 
                            {!! Form::hidden('num_mmo_y', null, ['class'=>'form-control', 'id' => 'pnum_mmo_y']) !!} 
                        </div>

                        <label for="ibm" class="mtop16"><strong>Numero DMO:</strong> @foreach($code_dmo as $cdmo) {{ $cdmo->code }} @endforeach</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('num_dmo', null, ['class'=>'form-control', 'id' => 'pnum_dmo']) !!} 
                            <a href="#" class="btn btn-sm btn-primary " id="btn_generate_code_dmo" ><i class="fas fa-qrcode"></i> Actualizar</a>
                            {!! Form::hidden('num_dmo_nom', null, ['class'=>'form-control', 'id' => 'pnum_dmo_nom']) !!} 
                            {!! Form::hidden('num_dmo_cor', null, ['class'=>'form-control', 'id' => 'pnum_dmo_cor']) !!} 
                            {!! Form::hidden('num_dmo_y', null, ['class'=>'form-control', 'id' => 'pnum_dmo_y']) !!} 
                        </div>

                        
                    </div>

                </div>
            </div>
        </div>

        <div class="row mtop16">
            <div class="col-md-12">
                <div class="panel shadow">
                    <div class="inside">
                        {!! Form::submit('Actualizar', ['class'=>'btn btn-success']) !!}
                    </div>
                </div>                    
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection