<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//RUTAS DE Autentificacion
Route::get('/inicio_sesion','ConnectController@getLogin')->name('login');
Route::post('/inicio_sesion','ConnectController@postLogin')->name('login');
Route::get('/logout','ConnectController@getLogout')->name('logout');

Route::get('/citas_del_dia_rx', 'PatientDayController@getPatientDayRx')->name('patient_day');
Route::get('/citas_del_dia_umd', 'PatientDayController@getPatientDayUmd')->name('patient_day');
Route::get('/citas_del_dia/{id}/materiales', 'PatientDayController@getMaterials')->name('materials');
Route::post('/citas_del_dia/materiales', 'PatientDayController@postMaterials')->name('materials');

//Request Ajax
Route::get('/agem/api/load/name/study/{id}', 'ApiController@getStudyName');