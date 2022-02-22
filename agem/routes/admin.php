<?php

    Route::prefix('/admin')->group(function(){

        //Dashboard
        Route::get('/','Admin\DashboardController@getDashboard')->name('dashboard');
        Route::get('/grafica','Admin\DashboardController@graficaUsuarios')->name('dashboard');
        Route::get('/pdf','Admin\DashboardController@pdf')->name('dashboard');

        //Units
        Route::get('/units', 'Admin\UnitsController@getHome')->name('units');
        Route::post('/unit/add', 'Admin\UnitsController@postUnitAdd')->name('unit_add');
        Route::get('/unit/{id}/edit', 'Admin\UnitsController@getUnitEdit')->name('unit_edit');
        Route::post('/unit/{id}/edit', 'Admin\UnitsController@postUnitEdit')->name('unit_edit');
        Route::get('/unit/{id}/delete', 'Admin\UnitsController@getUnitDelete')->name('unit_delete');

        //Maintenance_areas
        Route::get('/maintenance_areas', 'Admin\MaintenanceAreaController@getHome')->name('maintenance_areas');
        Route::post('/maintenance_area/add', 'Admin\MaintenanceAreaController@postMaintenanceAreaAdd')->name('maintenance_area_add');
        Route::get('/maintenance_area/{id}/edit', 'Admin\MaintenanceAreaController@getMaintenanceAreaEdit')->name('maintenance_area_edit');
        Route::post('/maintenance_area/{id}/edit', 'Admin\MaintenanceAreaController@postMaintenanceAreaEdit')->name('maintenance_area_edit');
        Route::get('/maintenance_area/{id}/delete', 'Admin\MaintenanceAreaController@getMaintenanceAreaDelete')->name('maintenance_area_delete');

        //Bitacora
        Route::get('/bitacoras','Admin\BitacoraController@getBitacora')->name('bitacoras');

        //Users
        Route::get('/users/add', 'Admin\UserController@getUserAdd')->name('user_add');
        Route::post('/users/add', 'Admin\UserController@postUserAdd')->name('user_add');
        Route::get('/users/{status}', 'Admin\UserController@getUsers')->name('user_list');
        Route::get('/user/{id}/edit', 'Admin\UserController@getUserEdit')->name('user_edit');
        Route::post('/user/{id}/edit', 'Admin\UserController@postUserEdit')->name('user_edit');
        Route::post('/user/{id}/reset_password','Admin\UserController@postResetPassword')->name('user_reset_password');
        Route::get('/user/{id}/banned', 'Admin\UserController@getUserBanned')->name('user_banned');
        Route::get('/user/{id}/permissions', 'Admin\UserController@getUserPermissions')->name('user_permissions');
        Route::post('/user/{id}/permissions', 'Admin\UserController@postUserPermissions')->name('user_permissions');
        Route::get('/user/{id}/assignments', 'Admin\UserController@getUserAssignments')->name('user_assignments');
        Route::post('/user/{id}/assignments/units', 'Admin\UserController@postUserAssignmentsUnits')->name('user_permissions');
        Route::post('/user/{id}/assignments/services', 'Admin\UserController@postUserAssignmentsServices')->name('user_permissions');
        Route::get('/user/assignments/service/{id}/delete', 'Admin\UserController@getUserAssignmentsServiceDelete')->name('service_delete');
        Route::get('/user/assignments/unit/{id}/delete', 'Admin\UserController@getUserAssignmentsUnitDelete')->name('service_delete');
        Route::get('/user/account/info','Admin\UserController@getAccountInfo')->name('user_info');
        Route::post('/user/account/chance/password','Admin\UserController@postAccountChangePassword')->name('user_change_password');
        Route::get('/user/{id}/staff', 'Admin\UserController@getUserStaff')->name('user_staff');

        //Suppliers
        Route::get('/suppliers', 'Admin\SupplierController@getHome')->name('suppliers');
        Route::get('/supplier/add', 'Admin\SupplierController@getSupplierAdd')->name('supplier_add');
        Route::post('/supplier/add', 'Admin\SupplierController@postSupplierAdd')->name('supplier_add');
        Route::get('/supplier/{id}/edit', 'Admin\SupplierController@getSupplierEdit')->name('supplier_edit');
        Route::post('/supplier/{id}/edit', 'Admin\SupplierController@postSupplierEdit')->name('supplier_edit');
        Route::get('/supplier/{id}/delete', 'Admin\SupplierController@getSupplierDelete')->name('supplier_delete');

       //Product
       Route::get('/product/add', 'Admin\ProductController@getProductAdd')->name('product_add');
       Route::post('/product/add', 'Admin\ProductController@postProductAdd')->name('product_add');
       Route::get('/product/{status}', 'Admin\ProductController@getProduct')->name('product_list');
       Route::get('/products/home/{renglon}', 'Admin\ProductController@index')->name('product_list');
       Route::get('/products/all/', 'Admin\ProductController@getProductAll')->name('products_index');
       Route::get('/product/{id}/edit', 'Admin\ProductController@getProductEdit')->name('product_edit');
       Route::post('/product/{id}/edit', 'Admin\ProductController@postProductEdit')->name('product_edit');
       Route::post('/product/{id}/edit_stock', 'Admin\ProductController@postProductStockEdit')->name('product_edit_stock');
       Route::get('/product/{id}/banned', 'Admin\ProductController@getProductBanned')->name('product_banned');
       Route::get('/product/{id}/delete', 'Admin\ProductController@getProductDelete')->name('product_delete');
       Route::post('/product/{id}/delete', 'Admin\ProductController@postProductDelete')->name('product_delete');
       Route::get('/product/{id}/search', 'Admin\ProductController@getProductSearch')->name('product_search');
       Route::get('/product/income/add', 'Admin\ProductController@getProductIncome')->name('product_income');
       Route::post('/product/income/add', 'Admin\ProductController@postProductIncome')->name('product_income');
       Route::get('/product/egress/add', 'Admin\ProductController@getProductEgress')->name('product_egress');
       Route::post('/product/egress/add', 'Admin\ProductController@postProductEgress')->name('product_egress');
       Route::get('/product/{id}/record', 'Admin\ProductController@getProductRecord')->name('product_record');
       Route::post('/product/income/search', 'Admin\ProductController@postProductIncomeSearch')->name('product_edit');

        //Kardex
        Route::get('/kardex/add', 'Admin\KardexController@getKardexAdd')->name('kardex_add');
        Route::post('/kardex/add', 'Admin\KardexController@postKardexAdd')->name('kardex_add');
        Route::get('/kardex/{status}', 'Admin\KardexController@getKardex')->name('kardex_list');
        Route::get('/kardex/{id}/edit', 'Admin\KardexController@getKardexEdit')->name('kardex_edit');
        Route::post('/kardex/{id}/edit', 'Admin\KardexController@postKardexEdit')->name('kardex_edit');
        Route::post('/kardex/{id}/edit_stock', 'Admin\KardexController@postKardexStockEdit')->name('kardex_edit_stock');
        Route::get('/kardex/{id}/banned', 'Admin\KardexController@getKardexBanned')->name('kardex_banned');
        Route::get('/kardex/{id}/delete', 'Admin\KardexController@getKardexDelete')->name('kardex_delete');
        Route::post('/kardex/{id}/delete', 'Admin\KardexController@postKardexDelete')->name('kardex_delete');
        Route::get('/kardex/{id}/search', 'Admin\KardexController@postKardexDabSearch')->name('kardex_search');
        Route::post('/kardex/dab/search', 'Admin\KardexController@postKardexDabSearch')->name('kardex_search');
        Route::get('/kardex/income/add', 'Admin\KardexController@getKardexIncome')->name('kardex_income');
        Route::post('/kardex/income/add', 'Admin\KardexController@postKardexIncome')->name('kardex_income');
        Route::get('/kardex/egress/add', 'Admin\KardexController@getKardexEgress')->name('kardex_egress');
        Route::post('/kardex/egress/add', 'Admin\KardexController@postKardexEgress')->name('kardex_egress');
        Route::get('/kardex/{id}/record', 'Admin\KardexController@getKardexRecord')->name('kardex_edit');

        //DAB-75
        Route::get('/dab_75_fr', 'Admin\DabFrController@getHome')->name('dabs');
        Route::get('/dab_75_fr/add', 'Admin\DabFrController@getDabAdd')->name('dabs_add');
        Route::post('/dab_75_fr/add', 'Admin\DabFrController@postDabAdd')->name('dabs_add');
        Route::get('/dab_75_fr/{id}/show', 'Admin\DabFrController@getDabShow')->name('dabs_show');

        //Equipments
        Route::get('/equipment/add', 'Admin\EquipmentController@getEquipmentAdd')->name('equipment_add');
        Route::post('/equipment/add', 'Admin\EquipmentController@postEquipmentAdd')->name('equipment_add');
        Route::get('/equipments/{status}', 'Admin\EquipmentController@getHome')->name('equipments_list');
        Route::get('/equipment/{id}/edit', 'Admin\EquipmentController@getEquipmentEdit')->name('equipment_edit');
        Route::post('/equipment/{id}/edit', 'Admin\EquipmentController@postEquipmentEdit')->name('equipment_edit');
        Route::get('/equipment/{id}/delete', 'Admin\EquipmentController@getSupplierDelete')->name('equipment_delete');
        Route::get('/equipment/{id}/files', 'Admin\EquipmentController@getEquipmentFiles')->name('equipment_file');
        Route::post('/equipment/{id}/files/upload/file', 'Admin\EquipmentController@postEquipmentUploadFile')->name('equipment_file');
        Route::post('/equipment/{id}/files/upload/image', 'Admin\EquipmentController@postEquipmentUploadImage')->name('equipment_file');
        Route::get('/equipment/{id}/data_sheet', 'Admin\EquipmentController@getEquipmentDataSheet')->name('equipment_data_sheet');
        Route::get('/equipment/{id}/equipment_parts', 'Admin\EquipmentController@getEquipmentParts')->name('equipment_parts');
        Route::post('/equipment/{id}/equipment_parts', 'Admin\EquipmentController@postEquipmentParts')->name('equipment_parts');
        Route::get('/equipment/equipment_parts/{id}/delete', 'Admin\EquipmentController@getEquipmentPartsDelete')->name('equipment_parts_delete');
        Route::get('/equipment/{id}/connection_to_equipment', 'Admin\EquipmentController@getEquipmentConecctions')->name('equipment_conecctions');
        Route::post('/equipment/{id}/connection_to_equipment', 'Admin\EquipmentController@postEquipmentConecctions')->name('equipment_conecctions');
        Route::get('/equipment/connection_to_equipment/{id}/delete', 'Admin\EquipmentController@getEquipmentConecctionsDelete')->name('equipment_conecctions_delete');
        Route::get('/equipment/{id}/transfer', 'Admin\EquipmentController@getEquipmentTransfer')->name('equipment_transfer');
        Route::post('/equipment/{id}/transfer', 'Admin\EquipmentController@postEquipmentTransfer')->name('equipment_transfer');
        Route::get('/equipment/{id}/print_label', 'Admin\EquipmentController@getEquipmentPrintLabel')->name('equipment_edit');
        Route::get('/equipment/{id}/panel', 'Admin\EquipmentController@getEquipmentPanel')->name('equipment_edit');
        Route::get('/equipment/{id}/change_status/{status}', 'Admin\EquipmentController@getEquipmentChangeStatus')->name('equipment_change_status');

        //Enviroments
        Route::post('/services_g/add', 'Admin\EnvironmentController@postServicesGeneralAdd')->name('serviceg_add');
        Route::get('/services_g/{status}', 'Admin\EnvironmentController@getHome')->name('serviceg_list');
        Route::get('/services_g/{id}/edit', 'Admin\EnvironmentController@getServicesGeneralEdit')->name('serviceg_edit');
        Route::post('/services_g/{id}/edit', 'Admin\EnvironmentController@postServicesGeneralEdit')->name('serviceg_edit');
        Route::get('/services_g/{id}/services','Admin\EnvironmentController@getServicesGeneralServices')->name('service_list');
        Route::post('/services_g/services/add','Admin\EnvironmentController@postServicesGeneralServicesAdd')->name('service_add');
        Route::get('/services_g/services/{id}/edit','Admin\EnvironmentController@getServicesGeneralServicesEdit')->name('service_edit');
        Route::post('/services_g/services/{id}/edit','Admin\EnvironmentController@postServicesGeneralServicesEdit')->name('service_edit');
        Route::get('/services/{id}/environments','Admin\EnvironmentController@getServicesEnvironments')->name('environment_list');
        Route::post('/services/environments/add','Admin\EnvironmentController@postServicesEnvironmentsAdd')->name('environment_add');
        Route::get('/services/environments/{id}/edit','Admin\EnvironmentController@getServicesEnvironmentsEdit')->name('environment_edit');
        Route::post('/services/environments/{id}/edit','Admin\EnvironmentController@postServicesEnvironmentsEdit')->name('environment_edit');

        //ING-7
        Route::get('/ing_7/add', 'Admin\Ing7Controller@getIng7Add')->name('ing7_add');
        Route::post('/ing_7/add', 'Admin\Ing7Controller@postIng7Add')->name('ing7_add');
        Route::get('/ing_7/{status}', 'Admin\Ing7Controller@getHome')->name('ing7_list');
        Route::get('/ing_7/{id}/print', 'Admin\Ing7Controller@getIng7Print')->name('ing7_print');
        Route::get('/ing_7/{id}/classification', 'Admin\Ing7Controller@getIng7Classification')->name('ing7_classification');
        Route::post('/ing_7/{id}/classification_type_work', 'Admin\Ing7Controller@postIng7ClassificationTypeWork')->name('ing7_classification');
        Route::post('/ing_7/{id}/classification_area_work', 'Admin\Ing7Controller@postIng7ClassificationAreaWork')->name('ing7_classification');
        Route::get('/ing_7/{id}/buy_hire', 'Admin\Ing7Controller@getIng7ClassificationBuyHire')->name('ing7_buy_hire');
        Route::post('/ing_7/{id}/buy_hire', 'Admin\Ing7Controller@postIng7ClassificationBuyHire')->name('ing7_buy_hire');
        Route::get('/ing_7/{id}/follow', 'Admin\Ing7Controller@getIng7Follow')->name('ing7_follow');
        Route::post('/ing_7/{id}/follow', 'Admin\Ing7Controller@postIng7Follow')->name('ing7_follow');
        Route::get('/ing_7/{id}/assignments_areas', 'Admin\Ing7Controller@getIng7AssignmentsAreas')->name('ing7_assignments_areas');
        Route::post('/ing_7/{id}/assignments_areas', 'Admin\Ing7Controller@postIng7AssignmentsAreas')->name('ing7_assignments_areas');
        Route::get('/ing_7/{id}/assignments_personal', 'Admin\Ing7Controller@getIng7AssignmentsPersonal')->name('ing7_assignments_personal');
        Route::post('/ing_7/{id}/assignments_personal', 'Admin\Ing7Controller@postIng7AssignmentsPersonal')->name('ing7_assignments_personal');
        Route::get('/ing_7/{id}/record', 'Admin\Ing7Controller@getIng7Record')->name('ing7_record');
        Route::get('/ing_7/{id}/receive_reject/{rrm}', 'Admin\Ing7Controller@getIng7ReceiveReject')->name('ing7_receive_reject');
        Route::get('/ing_7/{id}/an_audit', 'Admin\Ing7Controller@getIng7AnAudit')->name('ing7_an_audit');
        Route::get('/ing_7/{id}/delete', 'Admin\Ing7Controller@getIng7delete')->name('ing7_delete');
        Route::get('/ing_7/{id}/accept_reject/{ara}/{comment}', 'Admin\Ing7Controller@getIng7AcceptReject')->name('ing7_accept_reject');
        Route::get('/ing_7/{id}/in_action', 'Admin\Ing7Controller@getIng7InAction')->name('ing7_in_action');
        Route::get('/ing_7/{id}/finish', 'Admin\Ing7Controller@getIng7Finish')->name('ing7_finish');
        Route::get('/ing_7/{id}/print/follow', 'Admin\Ing7Controller@getIng7PrintFollow')->name('ing7_print_follow');
        Route::get('/ing_7/{id}/materials', 'Admin\Ing7Controller@getIng7Materials')->name('ing7_materials');
        Route::get('/ing_7/{id}/files', 'Admin\Ing7Controller@getIng7Files')->name('ing7_file');
        Route::post('/ing_7/{id}/files/upload/file', 'Admin\Ing7Controller@postIng7UploadFile')->name('ing7_file');
        Route::post('/ing_7/{id}/files/upload/image', 'Admin\Ing7Controller@postIng7UploadImage')->name('ing7_file');
        Route::get('/ing_7/{id}/follow_delete', 'Admin\Ing7Controller@getIng7Followdelete')->name('ing7_follow_delete');
        Route::get('/ing_7/{id}/assignments_areas_delete', 'Admin\Ing7Controller@getIng7AssignmentsAreasdelete')->name('ing7_assignments_areas_delete');
        Route::get('/ing_7/{id}/assignments_personal_delete', 'Admin\Ing7Controller@getIng7AssignmentsPersonaldelete')->name('ing7_assignments_personal_delete');

        //OT
        Route::get('/ot', 'Admin\OtController@getHome')->name('ot_list');
        Route::get('/ot/add', 'Admin\OtController@getOtAdd')->name('ot_add');
        Route::post('/ot/add', 'Admin\OtController@postOtAdd')->name('ot_add');
        Route::get('/ot/{id}/authorize_reject/{arm}', 'Admin\OtController@getOtAcceptReject')->name('ot_authorize_reject');
        Route::get('/ot/{id}/assignments_personal', 'Admin\OtController@getOtAssignmentsPersonal')->name('ot_assignments_personal');
        Route::post('/ot/{id}/assignments_personal', 'Admin\OtController@postOtAssignmentsPersonal')->name('ot_assignments_personal');
        Route::get('/ot/{id}/print', 'Admin\OtController@getOtPrint')->name('ot_print');
        Route::get('/ot/{id}/materials', 'Admin\OtController@getOtMaterials')->name('ot_materials');
        Route::get('/ot/{id}/files', 'Admin\OtController@getOtFiles')->name('ot_file');
        Route::post('/ot/{id}/files/upload/file', 'Admin\OtController@postOtUploadFile')->name('ot_file');
        Route::post('/ot/{id}/files/upload/image', 'Admin\OtController@postOtUploadImage')->name('ot_file');

        //Request Ajax
        Route::get('/sicma/api/load/services/{parent}', 'Admin\ApiController@getService');
        Route::get('/sicma/api/load/environments/{parent}', 'Admin\ApiController@getEnvironment');
        Route::get('/sicma/api/load/income/product/{code}', 'Admin\ApiController@getProduct');
        Route::get('/sicma/api/load/egress/product/{code}', 'Admin\ApiController@getProduct');
    });
