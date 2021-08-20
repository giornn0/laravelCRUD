<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['etiquetas']=Etiqueta::all();
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
        $etiqueta = request()->all();
        Etiqueta::insert($etiqueta);
        return 'Etiqueta creada correctamente!';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etiqueta  $Etiqueta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etiqueta  $Etiqueta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $editEtiqueta = request()->all();
        Etiqueta::where('id','=',$id)->update($editEtiqueta);
        return 'Etiqueta editada correctamente';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etiqueta  $Etiqueta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Etiqueta::destroy($id);
        return 'Etiqueta eliminada satisfactoriamente!';
    }
}
