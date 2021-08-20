<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['clientes']= Cliente::all();
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
        // $validator = Validator::make($cliente, [
        //     'email' => 'required|unique:clientes|max:255',
        //     'nombre' => 'required|max:255',
        //     'apellido' => 'required|max:255',
        // ]);

        // if ($validator->fails()) {
        //     return 'error en la creacion de cliente!';
        // }
        $cliente = request()->all();
        Cliente::create($cliente);
        return 'Creado con suceso!';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $cliente = Cliente::findOrFail($id);
        return $cliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $editCliente = request()->all();
        Cliente::where('id','=',$id)->update($editCliente);
        return 'Editado con suceso!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cliente::truncate($id);
        return 'Eliminado con exito!';
    }
}
