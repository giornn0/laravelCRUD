<?php

namespace App\Http\Controllers;

use App\Models\ProductoVenta;
use Illuminate\Http\Request;

class ProductoVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        echo $id;
        echo 'index de los productos comprados';
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id_venta)
    {
        $ProductoVentado = request()->all();
        $ProductoVentado['factura_venta_id']=$id_venta;
        ProductoVenta::insert($ProductoVentado);
        return 'Producto cargado correctamente!';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductoVenta  $ProductoVenta
     * @return \Illuminate\Http\Response
     */
    public function show($id_venta)
    {
         $datos = ProductoVenta::where('factura_venta_id','=',$id_venta);
         return $datos;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductoVenta  $ProductoVenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id_venta, $id_product)
    {
        $productoEditado = request()->all();
        ProductoVenta::where([['id','=',$id_product],['factura_venta_id','=',$id_venta]])->update($productoEditado);
        return 'Producto de la compra editado correctamente!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductoVenta  $ProductoVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_venta, $id_product)
    {
        ProductoVenta::destroy($id_product);
        return 'Producto de la compra eliminado correctamente';
    }
}
