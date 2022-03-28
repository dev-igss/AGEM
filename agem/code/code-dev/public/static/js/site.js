const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');
var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function(){
   
    btn_deleted = document.getElementsByClassName('btn-deleted');
    for(i=0; i < btn_deleted.length; i++){
        btn_deleted[i].addEventListener('click', delete_object);
    }

});



function delete_object(e){
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var idstudyappointment = this.getAttribute('data-study');
    var action = this.getAttribute('data-action');
    var path = this.getAttribute('data-path');
    var url = base + '/agem/public/' + path + '/' + object + '/' + action;
    var title, text, icon, material, cant, tecnico;

    if(action == "materials"){
        title = "Registro de Materiales";
        text = "Recuerde verificar que la información seleccionada sea la correcta.";
        icon = "warning";
    }

    if(action == "materials"){
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            html:
            '<label> <strong> Seleccione el material utilizado </strong> </label>'
            +
            '<select id="swal-input2" class="swal2-input"> <option value="0">Placa 8x10</option> <option value="1">Placa 10x12</option> <option value="2">Placa 11x14</option> <option value="3">Placa 14x17</option> <option value="4">Hojas</option> <option value="5">Fotos</option> <option value="6">Pelicula 8x10</option> <option value="7">Pelicula 10x12</option><option value="8">Singoplaza</option></select>' 
            + 
            '<label> <strong> Cantidad de material utilizado </strong> </label>'
            +
           '<input id="swal-input3" class="swal2-input">',
            preConfirm: () => {
                return [
                    mat = document.getElementById('swal-input2').value,
                    cant = document.getElementById('swal-input3').value
                ]
            }
        }).then((result) =>{
            if (result.isConfirmed) {
                //var url = base + '/agem/public/agem/api/load/name/study/'+idstudyappointment;
                var url = base + '/agem/api/load/name/study/'+idstudyappointment;
                http.open('GET', url, true);
                http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                http.send();
                http.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        var data = this.responseText;
                        data = JSON.parse(data);
                        name_study = data.name;

                        idappointment = document.getElementById('appointmentid').value;
                        idstudy = idstudyappointment;
                        material_name=$("#swal-input2 option:selected").text();
                        material = mat;
                        cantidad = cant;
                        cont = 0; 

                        if (material != ""){
                            var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><input type="hidden" name="idappointment[]" value="'+idappointment+'"><td><input type="hidden" name="idstudy[]" value="'+idstudy+'">'+name_study+'</td><td><input type="hidden" name="material[]" value="'+material+'">'+material_name+'</td><td><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td></tr>';
                            cont++;
                            evaluar();
                            $('#detalles').append(fila);
                        }else{
                            alert("Error al ingresar el detalle de materiales, revise la informacion ingresada.")
                        }

                    }
                }

                
            }
            
        });
    }

    

}




