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
        $datos = Venta::paginate(5);
        return response()->json($data = $datos, $status = 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venta = request()->all();
        $model = new Venta();
        $validator = Validator::make($venta, $model->rules);
        if ($validator->fails()) {
            return response()->json($data = ['error' => $validator->errors()], $status = 500);
        } else {
            Venta::create($venta);
            return response()->json($data = ['message' => 'Venta cargada correctamente!'], $status = 201);
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
        try {
            $venta = Venta::findOrFail($id);
            return response()->json($data = $venta, $status = 200);
        } catch (\Throwable $th) {
            return response()->json($data = ['message' => 'Error intentando cargar la venta'], $status = 500);
        }
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
        $model = new Venta();
        $editVenta = request()->all();
        $validator = Validator::make($editVenta, $model->rules);
        if ($validator->fails()) {
            return response()->json($data = ['error' => $validator->errors()], $status = 500);
        } else {
            Venta::where('id', '=', $id)->update($editVenta);
            return  response()->json($data = ['message' => 'Venta editada correctamente!'], $status = 202);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venta  $Venta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Venta::truncate($id);
            return response()->json($data = ['message' => 'Venta eliminado correctamente!'], $status = 500);
        } catch (\Throwable $th) {
            return response()->json($data = ['message' => 'Error intentando eliminar la venta'], $status = 500);
        }
    }
}
