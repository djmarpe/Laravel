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

Route::post('login','controlador@getUsuario');

Route::post('crudUser','controlador@editarBorrarUsuario');

Route::post('selecionarRol','controlador@seleccionRol');

Route::post('insertarUsuario','controlador@insertarUsuario');

Route::post('volverSeleccion','controlador@volverSeleccion');

Route::post('devolverCoche','controlador@devolverCoche');

Route::post('alquilarCoche','controlador@alquilarCoche');

Route::post('cerrarSesion','controlador@cerrarSesion');