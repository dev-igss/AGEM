@extends('admin.master')
@section('title','Calendario de Citas')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/citas') }}" class="nav-link"><i class="fas fa-columns"></i> Citas</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/equipments/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Calendario de Citas</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa fa-th-list"></i><strong> Clasificación de Citas</strong> </h2>                      
                    </div>                

                    <div class="inside">
                        <span><i class="fa fa-square" style="color: #85c1e9;"></i> Cita RX</span><br>
                        <span><i class="fa fa-square" style="color: #e59866;"></i> Cita USG</span><br>
                        <span><i class="fa fa-square" style="color: #f7dc6f;"></i> Cita MMO</span><br>
                        <span><i class="fa fa-square" style="color: #7dcea0;"></i> Cita DMO</span>                        
                    </div>  
                </div> 
            </div>

            <div class="col-md-10">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa fa-calendar"></i><strong> Calendario de Citas</strong> </h2>
                    </div>                

                    <div class="inside">
                        <div id="calendar"></div>                        
                    </div>  
                </div> 
            </div>
        </div>
    </div>

    <script>


        $(document).ready(function() {
            var currentLangCode = 'es';//cambiar el idioma al español
 
            $('#calendar').fullCalendar({
                eventClick: function(calEvent, jsEvent, view) {
 
                    $(this).css('background', 'red');
                    //al evento click; al hacer clic sobre un evento cambiara de background
                    //a color rojo y nos enviara a los datos generales del evento seleccionado
                },
                initialView: "agendaDay",                
                timeZone: "America/Guatemala",
                header: {
                    left: 'prev,next today myCustomButton',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día'
                },
                
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                    dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
                    dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
                    
                
 
                lang:currentLangCode,
                editable: true,
                eventLimit: true,
                
                events:{
                    //para obtener los resultados del controlador y mostrarlos en el calendario
                    //basta con hacer referencia a la url que nos da dicho resultado, en el ejemplo
                    //en la propiedad url de events ponemos el enlace
                    //y listo eso es todo ya el plugin se encargara de acomodar los eventos
                    //segun la fecha.
                    //url:'http://localhost/agem/public/admin/agem/api/load/appointments',
                    url:'http://10.11.0.30:8800/admin/agem/api/load/appointments',
                    
                    
                },
                eventRender: function(event, element) {

                if(event.area == "0") {
                    element.css('background-color', '#85c1e9');
                    element.css('border-color', '#85c1e9');
                    element.css('color', '#000');
                }
                if(event.area == "2") {
                    element.css('background-color', '#e59866');
                    element.css('border-color', '#e59866');
                    element.css('color', '#000');
                }
                if(event.area == "3") {
                    element.css('background-color', '#f7dc6f');
                    element.css('border-color', '#f7dc6f');
                    element.css('color', '#000');
                }
                if(event.area == "4") {
                    element.css('background-color', '#7dcea0');
                    element.css('border-color', '#7dcea0');
                    element.css('color', '#000');
                }
            },
            });
 
        });

        
    </script>
@endsection