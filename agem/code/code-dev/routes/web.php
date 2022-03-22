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
Route::get('/login','ConnectController@getLogin')->name('login');
Route::post('/login','ConnectController@postLogin')->name('login');
Route::get('/logout','ConnectController@getLogout')->name('logout');

Route::get('/patients_days', 'PatientDayController@getPatientDay')->name('patient_day');
Route::get('/patients_days/{id}/materials', 'PatientDayController@getMaterials')->name('materials');
Route::post('/patients_days/materials', 'PatientDayController@postMaterials')->name('materials');

//Request Ajax
Route::get('/agem/api/load/name/study/{id}', 'ApiController@getStudyName');