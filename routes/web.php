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

//*********** LOGIN MODAL
Route::get('/login-dialog/', function () {
    return view('auth.login-dialog');
});
Route::post('/login/credenciales','Auth\LoginController@comprobarCredenciales');
//*********** REGISTRAR MODAL
Route::get('/register-dialog', function () {
    return view('auth.register-dialog');
});
//*********** AUTENTICADOR
Auth::routes();
//*********** PAGINA DE INICIO
Route::get('/', function () {
    return view('welcome');
});
Route::get('/validasesion', 'HomeController@validaSesion');

//*********** URLS AUTENTICACION
Route::group(['middleware' => 'auth'], function () {
//*********** HOME
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/cuenta/nueva','CuentaController@crear');
    Route::post('/transaccion/ingreso/create','TransaccionController@crearIngreso');
    Route::post('/transaccion/gasto/create','TransaccionController@crearGasto');
    Route::get('/home/{tabActive}','HomeController@index');
//*********** CONTROLLERS
    AdvancedRoute::controller('/transaccion','TransaccionController');
    AdvancedRoute::controller('/cuenta','CuentaController');
    AdvancedRoute::controller('/perfil','PerfilController');
    AdvancedRoute::controller('/categoria','CategoriasController');
    AdvancedRoute::controller('/tipo','TiposController');
    AdvancedRoute::controller('/presupuesto','PresupuestoController');
    AdvancedRoute::controller('/dashboard','DashboardController');
});