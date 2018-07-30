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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/users/{id}/assignedroles', 'AssignedroleController@index')->name('abilities');
Route::get('/users', 'UserController@index')->name('users');

Route::get('/roles', 'RoleController@index')->name('roles');
Route::get('/roles/create', 'RoleController@create')->name('roles');
Route::get( '/roles/search', array('as' => 'roles.search', 'uses' => 'RoleController@search'));
Route::get('/roles/{id}/permissions', 'PermissionController@index')->name('permissions');
Route::post('/roles', [ 'as' => 'roles.store', 'uses' => 'RoleController@store']);
Route::get('/roles/{id}/destroy', 'RoleController@destroy')->name('roles');

Route::get('/abilities/create', 'AbilitieController@create')->name('abilities');
Route::get('/abilities', 'AbilitieController@index')->name('abilities');
Route::post('/abilities', [ 'as' => 'abilities.store', 'uses' => 'AbilitieController@store']);
Route::get( '/abilities/search', array('as' => 'abilities.search', 'uses' => 'AbilitieController@search'));

Route::post('/assignedroles', [ 'as' => 'assignedroles.store', 'uses' => 'AssignedroleController@store']);
Route::post('/permissions', [ 'as' => 'permissions.store', 'uses' => 'PermissionController@store']);

Route::post('/categorias/finder', [ 'as' => 'categorias.finder', 'uses' => 'CategoriaController@finder']);
Route::get('/categorias/{id}/destroy', 'CategoriaController@destroy')->name('categorias');
Route::get( '/categorias/search', array('as' => 'categorias.search', 'uses' => 'CategoriaController@search'));
Route::get( '/categorias/{id}/preguntas', array('as' => 'preguntas.index', 'uses' => 'PreguntaController@index'));

Route::resource('categorias', 'CategoriaController');

Route::post('/preguntas/finder', [ 'as' => 'preguntas.finder', 'uses' => 'PreguntaController@finder']);
Route::get( '/preguntas/search', array('as' => 'preguntas.search', 'uses' => 'PreguntaController@search'));
Route::get('/preguntas/{id}/create', 'PreguntaController@create')->name('preguntas');
Route::get( '/preguntas/{id}/respuestas', array('as' => 'respuestas.index', 'uses' => 'RespuestaController@index'));
Route::resource('preguntas', 'PreguntaController');

Route::post('/respuestas/finder', [ 'as' => 'respuestas.finder', 'uses' => 'RespuestaController@finder']);
Route::get( '/respuestas/search', array('as' => 'respuestas.search', 'uses' => 'RespuestaController@search'));
Route::get('/respuestas/{id}/create', 'RespuestaController@create')->name('respuestas');
Route::resource('respuestas', 'RespuestaController');
