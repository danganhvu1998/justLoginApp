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

Route::post('/users/login','authenController@login');
Route::post('/users/register','authenController@register');
Route::post('/users/token','authenController@token');
Route::post('/users/change','authenController@change');

Route::post('/data', 'dataController@dataStore');//->middleware('userAuthen');
Route::post('/data/edit', 'dataController@edit');//->middleware('userAuthen');
Route::get('/data/{id}', 'dataController@userData');
Route::get('/data', 'dataController@index');