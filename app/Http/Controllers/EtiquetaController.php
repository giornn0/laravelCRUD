<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EtiquetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $datos['etiquetas'] = Etiqueta::all();
            return $datos;
        } catch (\Throwable $th) {
            return response()->json($data = ['message' => 'Error uscando el indice de etiquetas'], $status = 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $etiqueta = request()->all();
        $model = new Etiqueta();
        $validator = Validator::make($etiqueta, $model->rules);
        if ($validator->fails()) {
            return response()->json($data = ['error' => $validator->errors()], $status = 500);
        } else {
            Etiqueta::create($etiqueta);
            return response()->json($data = ['message' => 'Etiqueta creada correctamente'], $status = 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etiqueta  $Etiqueta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $etiqueta = Etiqueta::findOrFail($id);
            return response()->json($data = $etiqueta, $status = 200);
        } catch (\Throwable $th) {
            return response()->json($data = ['message' => 'Error buscando la etiqueta'], $status = 500);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etiqueta  $Etiqueta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $editEtiqueta = request()->all();
        $model = new Etiqueta;
        $validator = Validator::make($editEtiqueta, $model->rules);
        if ($validator->fails()) {
            return response()->json($data = ['error' => $validator->errors()], $status = 500);
        } else {
            Etiqueta::where('id', '=', $id)->update($editEtiqueta);
            return response()->json($data = ['message' => 'Etiqueta editada correctamente'], $status = 202);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etiqueta  $Etiqueta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Etiqueta::destroy($id);
            return response()->json($data = ['message' => 'Etiqueta eliminado correctamente']);
        } catch (\Throwable $th) {
            return response()->json($data = ['message' => 'Error intentando eliminar la etiqueta'], $status = 500);
        }
    }
}
