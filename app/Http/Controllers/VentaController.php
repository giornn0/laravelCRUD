<?php

namespace App\Http\Controllers;

use App\Models\ProductoVenta;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $venta =request()->all();
        $model = new Venta();
        $validator = Validator::make($venta, $model->rules);
        if($validator->fails()){
            return response()->json($data = ['error' => $validator->errors()],$status=500);
        }
        else{
            Venta::create($venta);
            return 'Venta cargada correctamente!';
        }
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
