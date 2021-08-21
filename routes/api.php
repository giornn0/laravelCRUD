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

// routes/api.php

//All the authentication routes
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\DB;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class,'login']);

Route::get('unlogged', function (){
    return response()->json($data=['mensaje'=>'No se encuentra logeado, por favor inicie sesion'],$status=401);
});
Route::get('/logout/{id}',function($id){
    DB::delete('delete from personal_access_tokens where tokenable_id = ?', [$id]);
    return response()->json($data=['mensaje'=>'Sesion cerrada correctamente'],$status=200);
});


Route::get('/user', function (Request $request) {
    return $request->user();
});

//http://localhost:8000/api/clientes
use App\Http\Controllers\ClienteController;
Route::resource('/clientes',ClienteController::class)->middleware('auth:sanctum');
// http://localhost:8000/api/productos
use App\Http\Controllers\ProductoController;
Route::resource('/productos',ProductoController::class)->middleware('auth:sanctum');
// http://localhost:8000/api/producto/{id}/etiquetas
use App\Http\Controllers\EtiquetaProductoController;
Route::resource('/producto/{id}/etiquetas', EtiquetaProductoController::class)->middleware('auth:sanctum');
//http://localhost:8000/api/etiqueta_productos
use App\Http\Controllers\EtiquetaController;
Route::resource('/etiquetas_producto',EtiquetaController::class)->middleware('auth:sanctum');
//http://localhost:8000/api/ventas
use App\Http\Controllers\VentaController;
Route::resource('/ventas',VentaController::class)->middleware('auth:sanctum');
//http://localhost:8000/api/ventas/{id}/productos_comprados
use App\Http\Controllers\ProductoVentaController;
Route::resource('/ventas/{id}/productos_comprados',ProductoVentaController::class)->middleware('auth:sanctum');


