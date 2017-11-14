<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/mapa', function () {
    return view('mapa');
});

Route::get('/resumen/meses', function () {
    return view('resumen_meses');
});
//api
Route::get('/api/resumen/meses/',[
        'as'=> 'resumen.meses',
        'uses'=>'DahsboardController@resumenMeses']
);








