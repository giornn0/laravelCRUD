<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//http://localhost:8000/api/clientes
use App\Http\Controllers\ClienteController;
Route::resource('/clientes',ClienteController::class);
// http://localhost:8000/api/productos
use App\Http\Controllers\ProductoController;
Route::resource('/productos',ProductoController::class);
// http://localhost:8000/api/producto/{id}/etiquetas
use App\Http\Controllers\EtiquetaProductoController;
Route::resource('/producto/{id}/etiquetas', EtiquetaProductoController::class);
//http://localhost:8000/api/etiqueta_productos
use App\Http\Controllers\EtiquetaController;
Route::resource('/etiquetas_producto',EtiquetaController::class);
//http://localhost:8000/api/ventas
use App\Http\Controllers\VentaController;
Route::resource('/ventas',VentaController::class);
//http://localhost:8000/api/ventas/{id}/productos_comprados
use App\Http\Controllers\ProductoVentaController;
Route::resource('/ventas/{id}/productos_comprados',ProductoVentaController::class);


