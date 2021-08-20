<?php

namespace App\Http\Controllers;

use App\Models\EtiquetaProducto;
use Illuminate\Http\Request;

class EtiquetaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventario = request()->all();
        return $inventario;
        // EtiquetaProducto::insert($inventario);
        // return 'Inventaria creado correctamente';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtiquetaProducto  $EtiquetaProducto
     * @return \Illuminate\Http\Response
     */
    public function show($id_producto)
    {
        $inventarios = EtiquetaProducto::where('product_id','=',$id_producto);
        return $inventarios;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtiquetaProducto  $EtiquetaProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id_producto)
    {
        $inventarios =request()->all();
        EtiquetaProducto::where('product_id','=',$id_producto)->destroy();
        EtiquetaProducto::insert($inventarios);
        return 'Etiquetas editadas correctamente';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtiquetaProducto  $EtiquetaProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_producto, $id_inv)
    {
        EtiquetaProducto::where('product_id','=',$id_producto)->destroy();
        return 'Etiquetas destruidas correctamente!';
    }
}
