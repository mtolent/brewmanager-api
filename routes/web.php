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
*/
use App\Hop;
use App\BaseModel;

Route::get('/', function () {
    return 'BrewManager API';
});

Route::get('/data/{table}', 'DataController@index');
Route::post('/data/{table}', 'DataController@store');
Route::get('/data/{table}/{field}/{id}', 'DataController@filter');
Route::get('/data/{table}/{id}', 'DataController@show');
Route::delete('/data/{table}/{id}', 'DataController@destroy');
Route::put('/data/{table}/{id}', 'DataController@update');

Route::get('/teste', 'DataController@teste');


//Route::resource('data.id', 'DataController');
//Route::resource('{table}{id?}', 'DataController');


//Route::any( '(.*)', function( $page ){
//    dd($page);
//});
