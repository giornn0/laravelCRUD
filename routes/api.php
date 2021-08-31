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

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProductoVentaController;

Route::middleware(['cors'])->group(function () {
    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);


    Route::get('unlogged', function () {
        return response()->json($data = ['message' => 'No se encuentra logeado, por favor inicie sesion'], $status = 401);
    });
    Route::delete('/logout/{id}', function ($id) {
        DB::delete('delete from personal_access_tokens where tokenable_id = ?', [$id]);
        return response()->json($data = ['message' => 'Sesion cerrada correctamente'], $status = 200);
    });


    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::middleware(['auth:sanctum'])->group(function () {
        //Verificar estado del loggin        
        Route::get('/logstatus', function () {
            return response()->json($data = ['message' => 'Usuario logeado', $status = 200]);
        });

        //http://localhost:8000/api/clientes
        Route::resource('/clientes', ClienteController::class);

        // http://localhost:8000/api/productos
        Route::resource('/productos', ProductoController::class);

        //http://localhost:8000/api/etiqueta_productos
        Route::resource('/etiquetas_prod', EtiquetaController::class);

        //http://localhost:8000/api/ventas
        Route::resource('/ventas', VentaController::class);

        //http://localhost:8000/api/ventas/{id}/productos_comprados
        Route::resource('/ventas/{id}/productos_ventas', ProductoVentaController::class);
    });
});
