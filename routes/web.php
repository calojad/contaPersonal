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
//*********** PAGINA DE INICIO
Route::get('/', function () {
    return view('welcome');
});
//*********** LOGIN
Route::get('/login-dialog', function () {
    return view('auth.login-dialog');
});
//*********** REGISTRAR
Route::get('/register-dialog', function () {
    return view('auth.register-dialog');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/inicio', 'HomeController@inicio')->name('inicio');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::post('/cuenta/nueva','CuentaController@crear');
    Route::post('/transaccion/ingreso/create','TransaccionController@crearIngreso');
});