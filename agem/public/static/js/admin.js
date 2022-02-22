const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');
var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function(){

    var btn_search = document.getElementById('btn_search');
    var form_search = document.getElementById('form_search');
    var servicegeneral = document.getElementById('servicegeneral');
    var service = document.getElementById('service');
    var btn_income_product_search = document.getElementById('btn_income_product_search');
    var btn_add_product_search = document.getElementById('btn_add_product_search');


    if(btn_search){
        btn_search.addEventListener('click', function(e){
            e.preventDefault();
            if(form_search.style.display === 'block'){
                form_search.style.display = 'none';
            }else{
                form_search.style.display = 'block';
            }
        });
    }

    if(btn_income_product_search){
        btn_income_product_search.addEventListener('click', function(e){
            e.preventDefault();
            setInfoIncomeProduct();
        });
    }

    if(btn_add_product_search){
        btn_add_product_search.addEventListener('click', function(e){
            e.preventDefault();
            setInfoIncomeProduct();
        });
    }

    if(route == "equipment_add"){
        setServiceToEquipment();
        setEnvironmentToEquipment();
    }

    //if(route == "product_edit"){
        //var btn_product_file_image = document.getElementById('btn_product_file_image');
        //var product_file_image = document.getElementById('product_file_image');

       // btn_product_file_image.addEventListener('click', function(){
           // product_file_image.click();
       // }, false);

       // product_file_image.addEventListener('change', function(){
            //document.getElementById('form_product_gallery').submit();
        //});
   // }

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


    $("#idsupplier").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#idproduct").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });





});



function delete_object(e){
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var action = this.getAttribute('data-action');
    var path = this.getAttribute('data-path');
    var url = base + '/' + path + '/' + object + '/' + action;
    var title, text, icon, arm, ara, comment, status;

    if(action == "delete"){
        title = '¿Esta seguro de marcar como '+'"Anulada"'+' esta solictud?';
        text = "Recuerde que esta acción enviara este elemento a la papelera o lo eliminara de forma definitiva.";
        icon = "error";
    }

    if(action == "restore"){
        title = "¿Quiere restaurar este elemento?";
        text = "Esta acción restaurará este elemento y estará activo en la base de datos.";
        icon = "info";
    }

    if(action == "an_audit"){
        title = '¿Esta seguro de marcar como '+'"En Revision"'+' esta solictud?';
        text = "Recuerde que esta acción no se podra realizar nuevamente.";
        icon = "warning";
    }

    if(action == "in_action"){
        title = '¿Esta seguro de marcar como '+'"En Ejecucion"'+' esta solictud?';
        text = "Recuerde que esta acción no se podra realizar nuevamente.";
        icon = "info";
    }

    if(action == "finish"){
        title = '¿Esta seguro de marcar como '+'"Terminada"'+' esta solictud?';
        text = "Recuerde que esta acción no se podra realizar nuevamente.";
        icon = "question";
    }

    if(action == "authorize_reject"){
        title = '¿Esta seguro de marcar como '+'"Autorizada o Rechazada"'+' esta solictud?';
        text = "Recuerde que esta acción no se podra realizar nuevamente.";
        icon = "question";
    }

    if(action == "receive_reject"){
        title = '¿Esta seguro de marcar como '+'"Recepcionada o Rechazada"'+' esta solictud?';
        text = "Recuerde que esta acción no se podra realizar nuevamente.";
        icon = "question";
    }

    if(action == "accept_reject"){
        title = '¿Esta seguro de marcar como '+'"Aceptar o Rechazar"'+' esta solictud?';
        text = "Recuerde que esta acción no se podra realizar nuevamente.";
        icon = "question";
    }

    if(action == "change_status"){
        title = '¿Esta seguro de cambiar el estado de este equipo?';
        text = "Recuerde que esta acción puede cambiar ciertas funciones sobre el equipo.";
        icon = "question";
    }

    if(action == "assignments_areas_delete"){
        title = '¿Esta seguro de eliminar esta asignacion?';
        text = "Recuerde que esta acción enviara este elemento a la papelera o lo eliminara de forma definitiva.";
        icon = "error";
    }

    if(action == "assignments_personal_delete"){
        title = '¿Esta seguro de eliminar esta asignacion?';
        text = "Recuerde que esta acción enviara este elemento a la papelera o lo eliminara de forma definitiva.";
        icon = "error";
    }

    if(action == "follow_delete"){
        title = '¿Esta seguro de eliminar este registro?';
        text = "Recuerde que esta acción enviara este elemento a la papelera o lo eliminara de forma definitiva.";
        icon = "error";
    }

    if(action == "authorize_reject"){
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonText: 'Autorizar',
            denyButtonText: `Rechazar`,
        }).then((result) =>{

            if (result.isConfirmed) {
                arm = "1";
                window.location.href = url+'/'+arm;
            }else if (result.isDenied){
                arm = "2";
                window.location.href = url+'/'+arm;
            }
        });
    }else if(action == "receive_reject"){
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonText: 'Recepcionar',
            denyButtonText: `Rechazar`,
        }).then((result) =>{

            if (result.isConfirmed) {
                arm = "1";
                window.location.href = url+'/'+arm;
            }else if (result.isDenied){
                arm = "2";
                window.location.href = url+'/'+arm;
            }
        });
    }else if(action == "accept_reject"){
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonText: 'Aceptar',
            denyButtonText: `Rechazar`,
            input: 'textarea',
            inputLabel: 'Comentario:',
            inputAttributes: {
                'aria-label': 'Type your message here'
            },
        }).then((result) =>{

            if (result.isConfirmed) {
                ara = "1";
            }else if (result.isDenied){
                ara = "2";
            }

            if(result.value){
                comment = result.value;
            }else{
                comment = "1";
            }

            window.location.href = url+'/'+ara+'/'+comment;
        });
    }else if(action == "change_status"){
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            input: 'select',
            inputOptions: {
                'Estados Disponibles': {
                    0: 'Funcionamiento Optimo',
                    1: 'En Reparación',
                    2: 'Dañado',
                    3: 'Dado de Baja'
                }
            },
            inputPlaceholder: 'Seleccione una opción'
        }).then((result) =>{

            status = result.value;

            window.location.href = url+'/'+status;
        });
    }
    else{
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
        }).then((result) =>{

            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

}

function setServiceToEquipment(){
    var parent_id = servicegeneral.value;
    console.log(parent_id);
    var servicegeneral_actual = document.getElementById('servicegeneral_actual').value;
    select = document.getElementById('service');
    select.innerHTML = "";

    var url = base + '/admin/sicma/api/load/services/'+parent_id;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            data.forEach( function(element){
                if(servicegeneral_actual == element.id){
                    select.innerHTML += "<option value=\""+element.id+"\" selected>"+element.level+' - '+element.name+"</option>";
                }else{
                    select.innerHTML += "<option value=\""+element.id+"\">"+element.level+' - '+element.name+"</option>";
                }
            });
        }
    }
}

function setEnvironmentToEquipment(){
    var parent_id = service.value;
    var service_actual = document.getElementById('service_actual').value;
    select = document.getElementById('environment');
    select.innerHTML = "";

    var url = base + '/admin/sicma/api/load/environments/'+parent_id;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            data.forEach( function(element){

                if(service_actual == element.id){
                    select.innerHTML += "<option value=\""+element.id+"\" selected>"+element.code+' - '+element.name+"</option>";
                }else{
                    select.innerHTML += "<option value=\""+element.id+"\">"+element.code+' - '+element.name+"</option>";
                    console.log(element.code);
                }
            });
        }
    }
}

function setInfoIncomeProduct(){
    var code_ppr = document.getElementById('code_ppr').value;
    var url = base + '/admin/sicma/api/load/income/product/'+code_ppr;
    var idproduct = document.getElementById('pidarticulo');
    var name = document.getElementById('particulo');
    var description = document.getElementById('description');

    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            data.forEach( function(element){
                  idproduct.value = element.id;
                  name.value = element.name;
                  description.value = element.description;
            });
        }
    }
}

function setInfoEgressProduct(){
    var code_ppr = document.getElementById('code_ppr').value;
    var url = base + '/admin/sicma/api/load/egress/product/'+code_ppr;
    var idproduct = document.getElementById('pidarticulo');
    var name = document.getElementById('particulo');
    var description = document.getElementById('pdescription');

    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);
            data.forEach( function(element){
                  idproduct.value = element.id;
                  name.value = element.name;
                  description.value = element.description;
            });
        }
    }
}

