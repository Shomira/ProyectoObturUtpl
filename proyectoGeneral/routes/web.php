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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/obtur', function () {
    return view('obtur');
});
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/datosEstadisticos', 'App\Http\Controllers\DatosEstadisticosController@index');
Route::post('/datosEstadisticos', 'App\Http\Controllers\DatosEstadisticosController@mostrar');
Route::post('/datosEstadisticos/all', 'App\Http\Controllers\DatosEstadisticosController@all');

Route::get('/informacionTuristica', function () {
    return view('informacionTuristica');
});

Route::post('import-excel', 'App\Http\Controllers\ImportExcel\ImportExcelController@import');


Route::group(['prefix'=>'home', 'as'=>'home'], function(){
    Route::get('/visualizarGraficas', 'App\Http\Controllers\EstablecimientoController@index');
    Route::post('/visualizarGraficas/all', 'App\Http\Controllers\EstablecimientoController@all');
    Route::post('/visualizarGraficas/dias', 'App\Http\Controllers\EstablecimientoController@dias');
    Route::post('/visualizarGraficas', 'App\Http\Controllers\EstablecimientoController@mostrar');
    Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
    Route::get('/gestionUsuarios', 'App\Http\Controllers\UsersController@index');
    Route::resource('/gestionUsuarios', 'App\Http\Controllers\UsersController');
    Route::get('/visualizarArchivos', 'App\Http\Controllers\VisualizarArchivosController@index');
    Route::post('/visualizarArchivos', 'App\Http\Controllers\VisualizarArchivosController@mostrar');
    Route::get('/visualizarRegistros', 'App\Http\Controllers\VisualizarRegistrosController@index');
    Route::post('/visualizarRegistros', 'App\Http\Controllers\VisualizarRegistrosController@mostrar');
    Route::post('/gestionUsuarios/edit', 'App\Http\Controllers\UsersController@editarUsuario');
    Route::get('/archivos', 'App\Http\Controllers\ImportExcel\ImportExcelController@index');
    Route::delete('/archivos/{file}', 'App\Http\Controllers\ImportExcel\ImportExcelController@destroy');

    Route::get('/metricas', function () {return view('metricas');});
});