<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

Route::get('/', function () {
    return view('welcome');
});

*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::apiResources([
    'documents' => 'API\DoctosController',
    'reasons' => 'API\MotivosController',
]);

Route::get('/reports/documents/codigos_barras_doc', 'ReportsController@uno')->name('codes');
Route::get('/reports/reasons/codigos_barras_mov', 'ReportsController@dos')->name('codes_mov');

Route::get('/loans', 'PrestamosController@index')->name('prestar');
Route::post('/addloan', 'PrestamosController@getStore')->name('agregar');
Route::post('/newloan', 'PrestamosController@getCreate')->name('prestamo');


Route::get('/tracing', 'SeguimientosController@index')->name('seguimiento');
Route::post('/observation/{id}', 'SeguimientosController@getObvs')->name('observation');
Route::get('/observation/full/{id}', 'SeguimientosController@allObvs')->name('allobsv');
Route::get('/observation/docpres/{id}', 'SeguimientosController@allDop')->name('alldopre');
Route::get('/tracing/{id}', 'SeguimientosController@finishPre')->name('finishpre');

Route::post('/search', 'HomeController@searchPrestamo')->name('bucarprestamo');
Route::get('/request/{id}', 'HomeController@getPrestamoInfo')->name('requestsearch');


//Route::resource('documents', 'DoctosController');
//Route::resource('grounds', 'MotivosController');
//Route::get('/documents', 'DoctosController@index')->name('documents');
//Route::get('/documents/create', 'DoctosController@create')->name('create');
