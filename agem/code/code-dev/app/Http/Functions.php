<?php
    //Rol de usuarios
    function getRoleUserArray($mode, $id){
        $roles = [
            '0' => 'Administrador General',
            '1' => 'Administrador',
            '2' => 'Encargado de Area',
            '3' => 'Operador - Tecnico',
            '4' => 'Bodeguero',
            '5' => 'Inventario',
            '6' => 'Jefe de Servicio',
            '7' => 'Secretaria Mantenimiento'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    //Estado de Usuarios
    function getUserStatusArray($mode, $id){
        $status = [
            '0' => 'Suspendido',
            '1' => 'Activo'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Encargados de Mantenimiento y Seguridad Ocupacional
    function getEncargadosManttoArray($mode, $id){
        $status = [
            '0' => 'Mantenimiento',
            '1' => 'Seguridad y Salud Ocupacional',
            '2' => 'Biomedica'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    function getProductStatusArray($mode, $id){
        $status = [
            '0' => 'Desabastecido',
            '1' => 'Abastecido'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Estado de insumos/herramientas/equipos de Bodega/Inventario
    function getStoreStatusArray($mode, $id){
        $status = [
            '0' => 'Desabastecido',
            '1' => 'Abastecido',
            '2' => 'De baja',
            '3' => 'De alta'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Estado de insumos/herramientas/equipos de Kardex Transitorio
    function getKardexStatusArray($mode, $id){
        $status = [
            '0' => 'Desabastecido',
            '1' => 'Abastecido',
            '2' => 'De baja',
            '3' => 'De alta'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

     //Estado de insumos/herramientas/equipos de Bodega/Inventario
    function getTipoBodegaArray($mode, $id){
        $status = [
            '0' => 'Insumo',
            '1' => 'Herramienta',
            '2' => 'Repuesto',
            '3' => 'Sin Asignar'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    function getIngresoBodegaArray($mode, $id){
        $status = [
            '0' => 'FACTURA'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    function getEgresoBodegaArray($mode, $id){
        $status = [
            '0' => 'DAB-75',
            '1' => 'ING-7'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Forma para agregar o quitar Inventario / Bodega
    function getFormaBodegaArray($mode, $id){
        $status = [
            '0' => 'DAB-75',
            '1' => 'ING-7',
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Forma para agregar  kardex Transitorio
    function getFormaDABAddArray($mode, $id){
        $status = [
            '0' => 'DAB-75'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Forma para agregar  kardex Transitorio
    function getFormaKardexIncomeArray($mode, $id){
        $status = [
            '0' => 'DAB-75',
            '1' => 'INVENTARIO INICIAL / GENERAL',
            '2' => 'DEVOLUCION',
            '3' => 'VALE EPP'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Forma para quitar kardex Transitorio
    function getFormaKardexEgressArray($mode, $id){
        $status = [
            '0' => 'ING-7',
            '1' => 'OT´S',
            '2' => 'ASIGNADO',
            '3' => 'VALE EPP'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Estado de equipos y ambientes
    function getStatusEquipEnvironmentArray($mode, $id){
        $status = [
            '0' => 'Activo',
            '1' => 'Inactivo'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }
    //Tipos de manuales de equipos
    function getTypeFilesArray($mode, $id){
        $status = [
            '0' => 'Manual de Usuario',
            '1' => 'Manual Técnico',
            '2' => 'Especificaciones Tecnicas'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Nivel critico de equipos
    function getLevelEquipment($mode, $id){
        $roles = [
            '0' => 'Bajo',
            '1' => 'Medio',
            '2' => 'Alto'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

     //Estado de insumos/herramientas/equipos de Bodega/Inventario
    function getFrecuenciasUsosArray($mode, $id){
        $status = [
            '0' => 'Diario',
            '1' => '2 veces por semana',
            '2' => 'Semanal',
            '3' => 'Quincenal',
            '4' => 'Mensual',
            '5' => 'Semestral',
            '6' => 'Anual',
            '7' => 'Emergencia'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    function getBuyHireArray($mode, $id){
        $status = [
            '0' => 'Sin Asignar',
            '1' => 'Sí',
            '2' => 'No'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //tipos de estados
    function getTypeIng7($mode, $id){
        $roles = [
            '0' => 'Registrado',
            '1' => 'Traslado a Firma',
            '2' => 'Recepcionado por secretaria',
            '3' => 'Area de Trabajo Asignado ',
            '4' => 'Personal de Trabajo Asignado',
            '5' => 'En Revision',
            '6' => 'Autorizado por Mantenimiento',
            '7' => 'Rechazado por Mantenimiento',
            '8' => 'En Ejecución',
            '9' => 'Terminado',
            '100' => 'Anulado por el solicitante',
            '110' => 'Rechazado por secretaria'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getTypeIngSecretaria($mode, $id){
        $roles = [
            '2' => 'Recepcionado',
            '110' => 'Rechazado'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getTypeIngPersonal($mode, $id){
        $roles = [
            '6' => 'Autorizado',
            '7' => 'Rechazado'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    //Tipo de Trabajos Mantenimiento
    function TipoTrabajosMantto(){
        $p = [

            'trabajos' => [
                'icon' => '<i class="fas fa-tachometer-alt"></i>',
                'title' => 'Area ',
                'keys' => [

                    't_1' => 'Supervisión de Trabajos Contratados',
                    't_2' => 'Evaluación y Mediciones para Contratar',
                    't_3' => 'Supervisión y Reparación de Trabajos'
                ]
            ]

        ];

        return $p;
    }

    function areasMantto(){
        $p = [

            'area' => [
                'keys' => [
                    'a_1' => 'Pintura e Impermeabilización',
                    'a_2' => 'Autoclaves',
                    'a_3' => 'Herreria',
                    'a_4' => 'Equipos Médicos',
                    'a_5' => 'Plomería y Drenajes',
                    'a_6' => 'Calderas',
                    'a_7' => 'Carpinteria',
                    'a_8' => 'Otros',
                    'a_9' => 'Electricidad y Telefonia',
                    'a_10' => 'Albañiles',
                    'a_11' => 'Plantas Electricas'
                ]
            ]

        ];

        return $p;
    }

    //Estado de Usuarios
    function getTrainedStaff($mode, $id){
        $status = [
            '0' => 'No',
            '1' => 'Sí'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    function getTypeWorkOT($mode, $id){
        $roles = [
            '0' => 'Mantenimiento Preventivo',
            '1' => 'Mantenimiento Correctivo'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getPriorityOT($mode, $id){
        $roles = [
            '0' => 'Baja',
            '1' => 'Media',
            '2' => 'Alta'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getStatusOT($mode, $id){
        $roles = [
            '0' => 'Registrada',
            '1' => 'Autorizada',
            '100' => 'Rechazada'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getApprovalOT($mode, $id){
        $roles = [
            '0' => 'Ing. Jahen Figueroa',
            '1' => 'Ing. Manuel Alberto Velarde Gonzalez'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getTypePersonalOT($mode, $id){
        $roles = [
            '0' => 'Personal Interno',
            '1' => 'Personal Contratista'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getStatusEquipment($mode, $id){
        $roles = [
            '0' => 'Funcionamiento Optimo',
            '1' => 'En Reparación',
            '2' => 'Dañado',
            '3' => 'Dado de Baja'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    //Key Value From JSON
    function kvfj($json, $key){
        if($json == null):
            return null;
        else:
            $json = $json;
            $json = json_decode($json, true);

            if(array_key_exists($key, $json)):
                return $json[$key];
            else:
                return null;
            endif;
        endif;
    }

    function user_permissions(){
        $p = [

            'dashboard' => [
                'icon' => '<i class="fas fa-tachometer-alt"></i>',
                'title' => 'Modulo de Dashboard',
                'keys' => [
                    'dashboard' => 'Puede ver el dashboard.',
                    'dashboard_small_stats' => 'Puede ver las estadísticas rápidas.'
                ]
            ],

            'units' => [
                'icon' => '<i class="fas fa-hospital-user"></i>',
                'title' => 'Modulo de Unidades Medicas',
                'keys' => [
                    'units' => 'Puede ver el listado de unidades.',
                    'unit_add' => 'Puede agregar nuevas unidades.',
                    'unit_edit' => 'Puede editar unidades.',
                    'unit_delete' => 'Puede eliminar unidades.',
                    'unit_search' => 'Puede buscar unidades.'
                ]
            ],

            'bitacoras' => [
                'icon' => '<i class="fas fa-clipboard-list"></i> ',
                'title' => 'Modulo de Bitacoras',
                'keys' => [
                    'bitacoras' => 'Puede ver el listado de bitacoras.'
                ]
            ],

            'users' => [
                'icon' => '<i class="fas fa-user-lock"></i> ',
                'title' => 'Modulo de Usuarios',
                'keys' => [
                    'user_list' => 'Puede ver el listado de usuarios.',
                    'user_add' => 'Puede agregar nuevos usuarios.',
                    'user_edit' => 'Puede editar usuarios.',
                    'user_banned' => 'Puede suspender usuarios.',
                    'user_delete' => 'Puede eliminar usuarios.',
                    'user_reset_password' => 'Puede restablecer contraseña de usuarios.',
                    'user_permissions' => 'Puede administrar los permisos de los usuarios.',
                    'user_info' => 'Puede ver información de su cuenta',
                    'user_change_password' => 'Puede cambiar su contraseña de inicio de sesión'
                ]
            ]

        ];

        return $p;
    }

    function getUserYears(){
        $ya = date('Y');
        $ym = $ya - 18;
        $yo = $ym - 62;

        return [$ym, $yo];
    }

    function getMonths($mode, $key){
        $m = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        ];

        if($mode == "list"){
            return $m;
        }else{
            return $m[$key];
        }
    }

    function number($number){
        return 'Q'.number_format($number, 2, '.', ',' );
    }

?>
