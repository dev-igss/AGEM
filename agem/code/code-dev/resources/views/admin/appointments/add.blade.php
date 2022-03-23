@extends('admin.master')
@section('title','Agregar Paciente')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/all') }}" class="nav-link"><i class="fas fa-columns"></i> Citas</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Agendar Nueva</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        {!! Form::open(['url'=>'/admin/appointment/add']) !!}
        <div class="row">
            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <!-- Modal -->
                    <div class="modal" id="modelId" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#256B92; color:#fff; text-align:center;">
                                    <h5 class="modal-title">Busqueda de Paciente</h5>
                                </div>

                                <div class="modal-body">

                                    <div class="col-md-12">
                                        <label for="name"> <strong>Ingrese Afiliacion Para Buscar: </strong></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                            {!! Form::text('affiliation_b', null, ['class'=>'form-control', 'id'=> 'affiliation_b']) !!}
                                            {!! Form::select('type', getExamB('list', null),0,['class'=>'form-select', 'id'=> 'exam_b' ]) !!}
                                            <button type="button" id="btn_add_patient_search" class="btn btn-warning">
                                                <i class="fas fa-search"></i> Buscar
                                            </button>
                                        </div>
                                    </div>



                                    {!! Form::hidden('ppatient_id', null, ['class'=>'form-control', 'id'=> 'ppatient_id' ]) !!}


                                    <div class="col-md-12 mtop16">
                                        <div class="form-group">
                                            <label for="no_doc"> <strong> Nombre: </strong></label>
                                            {!! Form::text('ppatient_name', null, ['class'=>'form-control', 'id'=> 'ppatient_name']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-12 mtop16">
                                        <div class="form-group">
                                            <label for="no_doc"> <strong> Apellidos: </strong></label>
                                            {!! Form::text('ppatient_lastname', null, ['class'=>'form-control', 'id'=> 'ppatient_lastname']) !!}
                                        </div>
                                    </div>

                                    {!! Form::hidden('ppatient_contact', null, ['class'=>'form-control', 'id'=> 'ppatient_contact' ]) !!}
                                    {!! Form::hidden('pcodelast', null, ['class'=>'form-control', 'id'=> 'pcodelast' ]) !!}
                                    {!! Form::hidden('pdate', null, ['class'=>'form-control', 'id'=> 'pdate' ]) !!}
                                    {!! Form::hidden('pnumexp', null, ['class'=>'form-control', 'id'=> 'pnumexp' ]) !!}
                                    {!! Form::hidden('pstudie', null, ['class'=>'form-control', 'id'=> 'pstudie' ]) !!}
                                    {!! Form::hidden('pservice', null, ['class'=>'form-control', 'id'=> 'pservice' ]) !!}
                                </div>

                                <div class="modal-footer">
                                    <button type="button" id="bt_closeModal" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" id="bt_add" class="btn btn-primary">Seleccionar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="header">
                        <h2 class="title"><i class="fas fa-cogs"></i><strong> Información Paciente</strong></h2>
                    </div>

                    <div class="inside">   
                        
                        {!! Form::hidden('patient_id', null, ['class'=>'form-control', 'id'=> 'patient_id']) !!}
                        {!! Form::hidden('type_exam', null, ['class'=>'form-control', 'id'=> 'type_exam']) !!}

                        <label for="name" ><strong> Numero de Afiliacion: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('affiliationp', null, ['class'=>'form-control', 'id'=>'affiliationp', 'readonly']) !!}
                            <a href="#" class="btn btn-sm btn-info " id="bt_search"><i class="fas fa-search"></i> Buscar</a>
                        </div>

                        <label for="name" class="mtop16"><strong> Nombre:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('namep', null, ['class'=>'form-control', 'id'=> 'namep', 'readonly']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Apellidos:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('lastnamep', null, ['class'=>'form-control', 'id'=>'lastnamep', 'readonly']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Contacto:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('contactp', null, ['class'=>'form-control', 'id'=>'contactp', 'readonly']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Numero de Expediente Actual:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('numexpp', null, ['class'=>'form-control', 'id' => 'numexpp','readonly']) !!}
                        </div>

                        


                    </div>

                </div>
            </div>

            <div class="col-md-4 d-flex"> 
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-calendar-alt"></i><strong> Ultimo Examen Realizado</strong></h2>
                    </div>

                    <div class="inside"> 
                        <label for="name" ><strong> Fecha de Cita:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('date_al', null, ['class'=>'form-control', 'id' => 'date_al', 'readonly']) !!} 
                        </div>

                        <label for="name" class="mtop16"><strong> Numero de Expediente:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('numexp_al', null, ['class'=>'form-control', 'id' => 'numexp_al', 'readonly']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Detalle de la Cita:</strong></label>
                        <table id="detalles1" class= "table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: #c3f3ea">
                                <th><strong> SERVICIO SOLICITANTE </strong></th>
                                <th><strong> ESTUDIO </strong></th>
                            </thead>
                            <tbody>
                                

                            </tbody>
                        </table> 


                        <label class="mtop16" style="color: red; font-size: 1.5em; margin-left: 50px; font-weight: bold; display: none;" id="appointment_msg" >¡No se encontraron citas previas!</label>


                        
                    </div>

                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-calendar-plus"></i><strong> Información Para Cita Nueva</strong></h2>
                    </div>

                    <div class="inside"> 
                        
                        <label for="name"><strong>Fecha a Agendar:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::date('date', null, ['class'=>'form-control']) !!}
                        </div>

                        <br>
                        <label for="idsupplier"><strong> Servicio Solicitante:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>                            
                            <select name="pidservice" id="pidservice" style="width: 88%" >
                                @foreach ($services as $s)
                                    <option value=""></option>
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <br>
                        <label for="idsupplier"><strong> Estudio / Examen A Realizar:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::select('studies', $studies,0,['class'=>'form-select', 'id' => 'studies', 'style' => 'width: 88%']) !!}
                            {!! Form::hidden('studies_actual', 0, ['id' => 'studies_actual']) !!}
                        </div>

                        <label for="name" class="mtop16"><strong> Comentario:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::textarea('pcomment', null, ['class'=>'form-control', 'rows' => '2', 'id'=>'pcomment']) !!}
                        </div>

                        <div class="input-group mtop16">
                            {!! Form::button('Agregar', ['class'=>'btn btn-primary', 'id'=>'btn_agregar']) !!}
                        </div>
                        
                        
                        
                    </div>

                </div>
            </div>

            
        </div>

        <div class="row mtop16">
            <div class="col-md-12">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-calendar-plus"></i><strong> Detalle de Estudio(s) a Realizar</strong></h2>
                    </div>

                    <div class="inside">

                        <div class="card-body table-responsive">
                            <table id="detalles" class= "table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #c3f3ea">
                                    <th><strong> ELIMINAR </strong></th>
                                    <th><strong> SERVICIO </strong></th>
                                    <th><strong> ESTUDIO </strong></th>
                                    <th><strong> COMENTARIO </strong></th>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>                    
            </div>
        </div>

        <div class="row mtop16">
            <div class="col-md-12">
                <div class="panel shadow">
                    <div class="inside">
                        {!! Form::submit('Guardar', ['class'=>'btn btn-success', 'id'=>'btn_guardar']) !!}
                    </div>
                </div>                    
            </div>
        </div>
        {!! Form::close() !!}
    </div>


    <script>
        var modal = document.getElementById('modelId');
        $("#btn_guardar").hide();
        var cont = 0;

        $(document).ready(function(){
            $('#btn_agregar').click(function(){
                agregar_tabla();
            });

            $('#bt_add').click(function(){
                agregar();
            });
            
            $('#bt_search').click(function(){
                $('#modelId').modal("show");
            });
            $('#bt_closeModal').click(function(){
                $('#modelId').modal("hide");
            });
        });

        function agregar(){
            idpatient=$("#ppatient_id").val();
            examen = $("#exam_b").val();
            affiliation = $("#affiliation_b").val();
            name=$("#ppatient_name").val();
            lastname=$("#ppatient_lastname").val();
            contact=$("#ppatient_contact").val();
            code_last = $("#pcodelast").val();
            date_last = $("#pdate").val();
            numexp_last = $("#pnumexp").val();
            studie_last = $("#pstudie").val();
            service_last = $("#pservice").val();

            $("#patient_id").val(idpatient);
            $("#type_exam").val(examen);
            $("#affiliationp").val(affiliation);
            $("#namep").val(name);
            $("#lastnamep").val(lastname);
            $("#contactp").val(contact);
            $("#numexpp").val(code_last);
            $("#date_al").val(date_last);
            $("#numexp_al").val(numexp_last);
            $("#studie_al").val(studie_last);
            $("#service_al").val(service_last);
            $('#modelId').modal("hide");
            limpiar();
        }

        function limpiar(){
            $("#ppatient_id").val("");
            $("#affiliation_b").val("");
            $("#ppatient_name").val("");
            $("#ppatient_lastname").val("");
            $("#ppatient_contact").val("");
            $("#pcodelast").val("");
            $("#pdate").val("");
            $("#pnumexp").val("");
            $("#pstudie").val("");
            $("#pservice").val("");
        }

        function agregar_tabla(){
            idservice=$("#pidservice").val();
            service=$("#pidservice option:selected").text();
            idstudy=$("#studies").val();
            study=$("#studies option:selected").text();
            comment=$("#pcomment").val();
            if (idservice !="" && idstudy !="" ){
                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idservice[]" value="'+idservice+'">'+service+'</td><td><input type="hidden" name="idstudy[]" value="'+idstudy+'">'+study+'</td><td><input type="hidden" name="comment[]" value="'+comment+'">'+comment+'</td></tr>';
                cont++;
                limpiar();
                evaluar();
                $('#detalles').append(fila);
            }else{
                alert("Error al ingresar el detalle de la cita, revise los datos de seleccionados.")
            }
        }

        function evaluar(){
            if (cont > 0){
                $("#btn_guardar").show();
            }else{
                $("#btn_guardar").hide();
            }
        }

        function eliminar(index){
            $("#fila" + index).remove();
            cont--;
            evaluar();
        }
        
    </script>
@endsection