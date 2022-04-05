const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');
var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function(){
    var servicegeneral = document.getElementById('servicegeneral');
    var service = document.getElementById('service');
    var btn_add_patient_search = document.getElementById('btn_add_patient_search');
    var btn_generate_code_rx = document.getElementById('btn_generate_code_rx');
    var btn_generate_code_usg = document.getElementById('btn_generate_code_usg');
    var btn_generate_code_mmo = document.getElementById('btn_generate_code_mmo');
    var btn_generate_code_dmo = document.getElementById('btn_generate_code_dmo');
    var btn_manual_code_rx = document.getElementById('btn_manual_code_rx');
    var btn_manual_code_usg = document.getElementById('btn_manual_code_usg');
    var btn_manual_code_mmo = document.getElementById('btn_manual_code_mmo');
    var btn_manual_code_dmo = document.getElementById('btn_manual_code_dmo');
    var btn_update_affiliation = document.getElementById('btn_update_affiliation');
    var btn_disponibilidad = document.getElementById('btn_disponibilidad');


    if(btn_add_patient_search){
        btn_add_patient_search.addEventListener('click', function(e){
            e.preventDefault();
            setInfoAddPatient();
        });
    }

    if(btn_generate_code_rx){
        btn_generate_code_rx.addEventListener('click', function(e){
            e.preventDefault();
            setGenerateCodeRx();
        });
    }

    if(btn_generate_code_usg){
        btn_generate_code_usg.addEventListener('click', function(e){
            e.preventDefault();
            setGenerateCodeUsg();
        });
    }

    if(btn_generate_code_mmo){
        btn_generate_code_mmo.addEventListener('click', function(e){
            e.preventDefault();
            setGenerateCodeMmo();
        });
    }

    if(btn_generate_code_dmo){
        btn_generate_code_dmo.addEventListener('click', function(e){
            e.preventDefault();
            setGenerateCodeDmo();
        });
    }

    if(btn_manual_code_rx){
        btn_manual_code_rx.addEventListener('click', function(e){
            e.preventDefault();
            document.getElementById("div_manual_code_rx").style.display = "block";
        });
    }

    if(btn_manual_code_usg){
        btn_manual_code_usg.addEventListener('click', function(e){
            e.preventDefault();
            document.getElementById("div_manual_code_usg").style.display = "block";
        });
    }

    if(btn_manual_code_mmo){
        btn_manual_code_mmo.addEventListener('click', function(e){
            e.preventDefault();
            document.getElementById("div_manual_code_mmo").style.display = "block";
        });
    }

    if(btn_manual_code_dmo){
        btn_manual_code_dmo.addEventListener('click', function(e){
            e.preventDefault();
            document.getElementById("div_manual_code_dmo").style.display = "block";
        });
    }

    if(btn_update_affiliation){
        btn_update_affiliation.addEventListener('click', function(e){
            e.preventDefault();
            document.getElementById("div_update_affiliation").style.display = "block";
        });
    }

    getDisponibilidadHorario();
   
    if(route == "equipment_add"){
        setServiceToEquipment();
        setEnvironmentToEquipment();
    }

    document.getElementsByClassName('lk-'+route)[0].classList.add('active');

    btn_deleted = document.getElementsByClassName('btn-deleted');
    for(i=0; i < btn_deleted.length; i++){
        btn_deleted[i].addEventListener('click', delete_object);
    }

    if(servicegeneral){
        servicegeneral.addEventListener('change', setServiceToEquipment);
    }

    if(service){
        service.addEventListener('change', setEnvironmentToEquipment);
    }

    $('#table-modules').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        language: {
            "decimal": "",
            "emptyTable": "No hay registros",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
            "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });

    $('#table-modules1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        language: {
            "decimal": "",
            "emptyTable": "No hay registros",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
            "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });

    $("#pidservice").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#pidstudy").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#idsupplier").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#idproduct").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#studies").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#schedules").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

});



function delete_object(e){
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var action = this.getAttribute('data-action');
    var path = this.getAttribute('data-path');
    var url = base + '/agem/public/' + path + '/' + object + '/' + action;
    //var url = base + '/' + path + '/' + object + '/' + action;
    var title, text, icon, date, status;
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    } 
        
    today = yyyy + '-' + mm + '-' + dd;
    console.log(today);
    if(action == "reprogramar"){
        title = '¿Esta seguro de '+'"Reprogramar"'+' esta cita?';
        text = "Recuerde que esta acción no se podra realizar nuevamente.";
        icon = "warning";
    }

    if(action == "reprogramacion_forzada"){
        title = '¿Esta seguro de '+'"Reprogramar"'+' esta cita?';
        text = "Recuerde que esta acción no se podra realizar nuevamente.";
        icon = "warning";
    }

    if(action == "paciente_presente"){
        title = '¿Esta seguro de marcar como'+'"Paciente Presente"'+' en esta cita?';
        text = "Recuerde que esta acción no se podra realizar nuevamente.";
        icon = "success";
    }

    if(action == "paciente_ausente"){
        title = '¿Esta seguro de marcar como'+'"Paciente Ausente"'+' en esta cita?';
        text = "Recuerde que esta acción no se podra realizar nuevamente.";
        icon = "error";
    }

    if(action == "reprogramar"){ 
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            showCancelButton: true,
            html: '<input type="date" id="swal-input" class="swal2-input" min="'+today+'">',
            focusConfirm: false,
            allowOutsideClick: false,
            preConfirm: () => {
                
                return document.getElementById('swal-input').value;
            }
        }).then((result) =>{
            if (result.isConfirmed) {
                date = result.value;
                
                window.location.href = url+'/'+date;
            }            
        });
    }else if(action == "reprogramacion_forzada"){
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            showCancelButton: true,
            html: '<input type="date" id="swal-input" class="swal2-input" min="'+today+'"><label>Motivo:</label><input type="text" id="swal-input" class="swal2-input" min="'+today+'">',
            focusConfirm: false,
            allowOutsideClick: false,
            preConfirm: () => {
                
                return document.getElementById('swal-input').value;
            }
        }).then((result) =>{
            if (result.isConfirmed) {
                date = result.value;
                
                window.location.href = url+'/'+date;
            }            
        });
    }else if(action == "paciente_presente"){
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            showCancelButton: true
        }).then((result) =>{
            if (result.isConfirmed) {
                status = "1";
                window.location.href = url+'/'+status;
            }            
        });
    }else if(action == "paciente_ausente"){
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            showCancelButton: true
        }).then((result) =>{
            if (result.isConfirmed) {
                status = "2";
                window.location.href = url+'/'+status;
            }            
        });
    }

    

}

function setInfoAddPatient(){
    var exam = document.getElementById('exam_b').value;
    var affiliation_b = document.getElementById('affiliation_b').value;
    var url = base + '/agem/public/admin/agem/api/load/add/patient/'+affiliation_b+'/'+exam;
    //var url = base + '/admin/agem/api/load/add/patient/'+affiliation_b+'/'+exam;
    var patient_id = document.getElementById('ppatient_id');
    var name = document.getElementById('ppatient_name');
    var lastname = document.getElementById('ppatient_lastname');
    var contact = document.getElementById('ppatient_contact');
    var code_last = document.getElementById('pcodelast');
    var date_al = document.getElementById('pdate');
    var numexp_al = document.getElementById('pnumexp'); 

    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send(); 
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            if('patient' in data){
                patient_id.value = data.patient[0].id;
                name.value = data.patient[0].name;
                lastname.value = data.patient[0].lastname;
                contact.value = data.patient[0].contact;
            }            
            if('code_last' in data){
                code_last.value = data.code_last[0].code;
            }
            //console.log(data);
            if('appointment_last' in data){
                date_al.value = data.appointment_last[0].date;
                numexp_al.value = data.appointment_last[0].num_study;
                for(i=0; i<data.detalles.length; i++){
                    var fila='<tr><td><input type="hidden" >'+data.detalles[i].service.name+'</td><td><input type="hidden" >'+data.detalles[i].study.name+'</td></tr>';
                    $('#detalles1').append(fila);
                }
            }else{
                document.getElementById("appointment_msg").style.display = "block";
            }

            var studies_actual = document.getElementById('studies_actual').value;
            select = document.getElementById('studies');
            select.innerHTML = "";
            var url = base + '/agem/public/admin/agem/api/load/studies/'+exam;
            //var url = base + 'admin/agem/api/load/studies/'+exam;
            http.open('GET', url, true);
            http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            http.send();
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    var data = this.responseText;
                    data = JSON.parse(data);
                    data.forEach( function(element){
                        if(studies_actual == element.id){
                            select.innerHTML += "<option value=\""+element.id+"\" selected>"+element.name+"</option>";
                        }else{
                            select.innerHTML += "<option value=\""+element.id+"\">"+element.name+"</option>";
                        }
                    });

                    

                }
            }

        }
    }
}

function setGenerateCodeRx(){
    var nomenclatura = 'RX';
    var url = base + '/agem/public/admin/agem/api/load/generate/code/'+nomenclatura;
    //var url = base + '/admin/agem/api/load/generate/code/'+nomenclatura;
    var num_rx = document.getElementById('pnum_rx');
    var nomenclature = document.getElementById('pnum_rx_nom');
    var correlative = document.getElementById('pnum_rx_cor');
    var year = document.getElementById('pnum_rx_y');

    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            num_rx.value = data.code;
            nomenclature.value = data.nomenclature;
            correlative.value = data.correlative;
            year.value = data.year;            
        }
    }
}

function setGenerateCodeUsg(){
    var nomenclatura = 'USG';
    var url = base + '/agem/public/admin/agem/api/load/generate/code/'+nomenclatura;
    //var url = base + '/admin/agem/api/load/generate/code/'+nomenclatura;
    var num_usg = document.getElementById('pnum_usg');
    var nomenclature = document.getElementById('pnum_usg_nom');
    var correlative = document.getElementById('pnum_usg_cor');
    var year = document.getElementById('pnum_usg_y');

    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            num_usg.value = data.code;
            nomenclature.value = data.nomenclature;
            correlative.value = data.correlative;
            year.value = data.year;
        }
    }
}

function setGenerateCodeMmo(){
    var nomenclatura = 'MMO';
    var url = base + '/agem/public/admin/agem/api/load/generate/code/'+nomenclatura;
    //var url = base + '/admin/agem/api/load/generate/code/'+nomenclatura;
    var num_mmo = document.getElementById('pnum_mmo');
    var nomenclature = document.getElementById('pnum_mmo_nom');
    var correlative = document.getElementById('pnum_mmo_cor');
    var year = document.getElementById('pnum_mmo_y');

    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            num_mmo.value = data.code;
            nomenclature.value = data.nomenclature;
            correlative.value = data.correlative;
            year.value = data.year;
        }
    }
}

function setGenerateCodeDmo(){
    var nomenclatura = 'DMO';
    var url = base + '/agem/public/admin/agem/api/load/generate/code/'+nomenclatura;
    //var url = base + '/admin/agem/api/load/generate/code/'+nomenclatura;
    var num_dmo = document.getElementById('pnum_dmo');
    var nomenclature = document.getElementById('pnum_dmo_nom');
    var correlative = document.getElementById('pnum_dmo_cor');
    var year = document.getElementById('pnum_dmo_y');

    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            num_dmo.value = data.code;
            nomenclature.value = data.nomenclature;
            correlative.value = data.correlative;
            year.value = data.year;
        }
    }
}

function getDisponibilidadHorario(){
    
    var inputdate = document.getElementById('date_new_app');
    var options=$('#schedules option').clone();

    $(inputdate).change(function(){

        var fecha = document.getElementById("date_new_app").value;
        //console.log(fecha);
        var dia = fecha[8]+fecha[9];
        var mes = fecha[6];
        var year = fecha[0]+fecha[1]+fecha[2]+fecha[3];
        var exam = document.getElementById('exam_b').value;
        
        var url = base + '/agem/public/admin/agem/api/load/schedules/'+fecha+'/'+exam;
        //var url = base + '/admin/agem/api/load/schedules/'+fecha+'/'+exam;
        http.open('GET', url, true);
        http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        http.send();
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                var data = this.responseText;
                data = JSON.parse(data);
                //console.log(data);   
                if(data.length > 0){
                    data.forEach( function(schedule, index){
                        if(schedule.total >= 2){
                            for(i=1; i <= 18; i++){
                                //console.log(i);
                                if(schedule.schedule_id == i){
                                    $('#schedules option[value="'+schedule.schedule_id+'"]').remove();    
                                }
                            }                                                          
                        }    
                    });  
                }else{
                    $('#schedules').html(options);
                }
            }
        }
    });
}


