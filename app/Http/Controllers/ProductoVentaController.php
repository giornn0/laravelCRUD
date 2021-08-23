<?php

namespace App\Http\Controllers;

use App\Models\ProductoVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_venta)
    {
        try {
            $datos = ProductoVenta::where('venta_id', '=', $id_venta);
            return response()->json($data = $datos, $status = 200);
        } catch (\Throwable $th) {
            return response()->json($data = ['message' => 'Error intentando encontrar los productos'], $status = 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_venta)
    {
        $productoVenta = request()->all();
        $productoVenta['factura_venta_id'] = $id_venta;
        $model = new ProductoVenta();
        $validator = Validator::make($productoVenta, $model->rules);
        if ($validator->fails()) {
            return response()->json($data = ['error' => $validator->errors()], $status = 500);
        } else {
            ProductoVenta::create($productoVenta);
            return response()->json($data = ['message' => 'Producto vargado correctamente en la venta'], $status = 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductoVenta  $ProductoVenta
     * @return \Illuminate\Http\Response
     */
    public function show($id_venta)
    {
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductoVenta  $ProductoVenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_venta, $id_product)
    {
        $productoEditado = request()->all();
        $model = new ProductoVenta;
        $validator = Validator::make($productoEditado, $model->rules);
        if ($validator->fails()) {
            return response()->json($data = ['error' => $validator->errors()], $status = 500);
        } else {
            ProductoVenta::where([['id', '=', $id_product], ['venta_id', '=', $id_venta]])->update($productoEditado);
            return response()->json($data = ['message' => 'Producto de la venta editado correctamente!'], $status = 202);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductoVenta  $ProductoVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_venta, $id_product)
    {
        try {
            ProductoVenta::destroy($id_product);
            return response()->json($data = ['message' => 'Producto de la venta eliminado correctamente'], $status = 200);
        } catch (\Throwable $th) {
            return response()->json($data = ['message' => 'Error al intentar eliminar el producto'], $status = 500);
        }
    }
}
