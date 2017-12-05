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



Route::get('/resumen/meses', function () {
    return view('resumen_meses');
});

//api general

Route::get('/api/cantidad/sismos/',[
        'as'=> 'cantidad.sismos',
        'uses'=>'DahsboardController@cantidadSismos']
);

//api
Route::get('/api/resumen/meses/',[
        'as'=> 'resumen.meses',
        'uses'=>'DahsboardController@resumenMeses']
);
//================================================


Route::get('/sismos/fuertes', function () {
    return view('sismos_fuertes');
});

//api
Route::get('/api/sismos/fuertes/',[
        'as'=> 'sismos.fuertes',
        'uses'=>'DahsboardController@sismosFuertes']
);
//================================================

Route::get('/mapa/paises', function () {
    return view('mapa_paises');
});
//api
Route::get('/api/mapa/paises/',[
        'as'=> 'mapa.paises',
        'uses'=>'DahsboardController@mapaPaises']
);
Route::get('/api/mapa/detalle_sismo/',[
        'as'=> 'detalle.sismo',
        'uses'=>'DahsboardController@detalleSismo']
);


//================================================

Route::get('/resumen/paises', function () {
    return view('resumen_paises');
});

//api
Route::get('/api/resumen/paises/',[
        'as'=> 'resumen.paises',
        'uses'=>'DahsboardController@resumenPaises']
);

//================================================









