<?php

    Route::prefix('/admin')->group(function(){

        //Dashboard
        Route::get('/','Admin\DashboardController@getDashboard')->name('dashboard');

        //Units
        Route::get('/units', 'Admin\UnitsController@getHome')->name('units');
        Route::post('/unit/add', 'Admin\UnitsController@postUnitAdd')->name('unit_add');
        Route::get('/unit/{id}/edit', 'Admin\UnitsController@getUnitEdit')->name('unit_edit');
        Route::post('/unit/{id}/edit', 'Admin\UnitsController@postUnitEdit')->name('unit_edit');
        Route::get('/unit/{id}/delete', 'Admin\UnitsController@getUnitDelete')->name('unit_delete');

        //Bitacora
        Route::get('/bitacoras','Admin\BitacoraController@getBitacora')->name('bitacoras');

        //Users        
        Route::get('/users', 'Admin\UserController@getUsers')->name('user_list');
        Route::post('/user/add', 'Admin\UserController@postUserAdd')->name('user_add');
        Route::get('/user/{id}/edit', 'Admin\UserController@getUserEdit')->name('user_edit');
        Route::post('/user/{id}/edit', 'Admin\UserController@postUserEdit')->name('user_edit');
        Route::post('/user/{id}/reset_password','Admin\UserController@postResetPassword')->name('user_reset_password');
        Route::get('/user/{id}/banned', 'Admin\UserController@getUserBanned')->name('user_banned');
        Route::get('/user/{id}/permissions', 'Admin\UserController@getUserPermissions')->name('user_permissions');
        Route::post('/user/{id}/permissions', 'Admin\UserController@postUserPermissions')->name('user_permissions');
        Route::get('/user/account/info','Admin\UserController@getAccountInfo')->name('user_info');
        Route::post('/user/account/chance/password','Admin\UserController@postAccountChangePassword')->name('user_change_password');

        //Services
        Route::get('/services_g', 'Admin\ServiceController@getHome')->name('serviceg_list');
        Route::post('/services_g/add', 'Admin\ServiceController@postServicesGeneralAdd')->name('serviceg_add');        
        Route::get('/services_g/{id}/edit', 'Admin\ServiceController@getServicesGeneralEdit')->name('serviceg_edit');
        Route::post('/services_g/{id}/edit', 'Admin\ServiceController@postServicesGeneralEdit')->name('serviceg_edit');
        Route::get('/services_g/{id}/services','Admin\ServiceController@getServicesGeneralServices')->name('service_list');
        Route::post('/services_g/services/add','Admin\ServiceController@postServicesGeneralServicesAdd')->name('service_add');
        Route::get('/services_g/services/{id}/edit','Admin\ServiceController@getServicesGeneralServicesEdit')->name('service_edit');
        Route::post('/services_g/services/{id}/edit','Admin\ServiceController@postServicesGeneralServicesEdit')->name('service_edit');

        //Studies
        Route::post('/studie/add', 'Admin\StudieController@postStudieAdd')->name('studie_add'); 
        Route::get('/studies/{type}', 'Admin\StudieController@getHome')->name('studie_list');       
        Route::get('/studie/{id}/edit', 'Admin\StudieController@getStudieEdit')->name('studie_edit');
        Route::post('/studie/{id}/edit', 'Admin\StudieController@postStudieEdit')->name('studie_edit');

        //Patients
        Route::get('/patients', 'Admin\PatientController@getHome')->name('patient_list');
        Route::get('/patient/add', 'Admin\PatientController@getPatientAdd')->name('patient_add');        
        Route::post('/patient/add', 'Admin\PatientController@postPatientAdd')->name('patient_add');         
        Route::get('/patient/{id}/edit', 'Admin\PatientController@getPatientEdit')->name('patient_edit');
        Route::post('/patient/{id}/edit', 'Admin\PatientController@postPatientEdit')->name('patient_edit');
        Route::get('/patient/{id}/history_exam', 'Admin\PatientController@getPatientHistoryExam')->name('patient_history_exam');
        Route::get('/patient/{id}/history_codes', 'Admin\PatientController@getPatientHistoryCode')->name('patient_history_exam');

        //Appointments
        Route::get('/appointments', 'Admin\AppointmentController@getHome')->name('appointment_list');
        Route::get('/appointment/add', 'Admin\AppointmentController@getAppointmentAdd')->name('appointment_add');        
        Route::post('/appointment/add', 'Admin\AppointmentController@postAppointmentAdd')->name('appointment_add');
        Route::get('/appointment/{id}/materials', 'Admin\AppointmentController@getAppointmentMaterials')->name('appointment_materials');
        Route::get('/appointment/{id}/reschedule/{date}', 'Admin\AppointmentController@getAppointmentReschedule')->name('appointment_reschedule');
        Route::get('/appointment/{id}/patients_in/{status}', 'Admin\AppointmentController@getAppointmentPatientsStatus')->name('appointment_patients_status');
        Route::get('/appointment/{id}/patients_out/{status}', 'Admin\AppointmentController@getAppointmentPatientsStatus')->name('appointment_patients_status');


        //Request Ajax 
        Route::get('/agem/api/load/add/patient/{code}/{exam}', 'Admin\ApiController@getPatient');
        Route::get('/agem/api/load/generate/code/{code}', 'Admin\ApiController@getCodePatient');
        Route::get('/agem/api/load/studies/{type}', 'Admin\ApiController@getStudies');
    });
