<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('cliente.')->group(function(){
	Route::get('/encuesta','EvaluacionController@api_createEncuesta');
	Route::get('/medica','EvaluacionController@api_createMedica');
	Route::post('/encuesta','EvaluacionController@api_storeEncuesta');
	Route::post('/medica','EvaluacionController@api_storeMedica');
});