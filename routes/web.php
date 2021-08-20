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
    $cliente =["nombre"=>"cliente1","apellido"=>"apellido","email"=>"mail"];
    $cliente["nombre"]="ahora tiene otro nombre";
   return $cliente;
});
Route::get('/clientes',function(){
    return'clientes';
});
Route::get('/jiji',function(){
    return'clientes';
});

