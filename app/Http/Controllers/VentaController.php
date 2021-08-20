<?php

namespace App\Http\Controllers;

use App\Models\ProductoVenta;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['ventas'] = Venta::paginate(5);
        return $datos;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venta = Venta::create(request()->except('productos'));
        $productos =  array(array('id' => 1, 'cantidad' => 20, 'precio' => 20, 'total' => 400), array('id' => 2, 'cantidad' => 20, 'precio' => 20, 'total' => 400), array('id' => 3, 'cantidad' => 20, 'precio' => 20, 'total' => 400), array('id' => 4, 'cantidad' => 20, 'precio' => 20, 'total' => 400),);
        foreach ($productos as $producto) {
            ProductoVenta::create(['venta_id' => $venta['id'], 'producto_id' => $producto['id'], 'cantidad' => $producto['cantidad'], 'precio' => $producto['precio'], 'total' => $producto['total']]);
        }
        return 'Venta cargada correctamente!';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $Venta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Venta::findOrFail($id);
        return $venta;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venta  $Venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $editVenta = request()->all();
        Venta::where('id', '=', $id)->update($editVenta);
        return 'Venta editada correctamente!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venta  $Venta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Venta::truncate($id);
        return 'Venta eliminada correctamente!';
    }
}
