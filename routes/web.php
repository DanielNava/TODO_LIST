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

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => '/tareas'], function () {
    Route::get('/activas','HomeController@TareasActivas')->name('tareas_activas');
    Route::get('/completas','HomeController@TareasCompletas')->name('tareas_completas');
    Route::post('/crear_tarea','HomeController@CrearTarea')->name('crear_tarea');
    Route::post('/borra_tarea/{id}', 'HomeController@Borrar_Tarea')->name('borrar_tarea');
    Route::post('/editar_tarea','HomeController@EditarTarea')->name('editar_tarea');
    Route::post('/completar/{id}', 'HomeController@CompletarTareas')->name('completar_tareas');


});


