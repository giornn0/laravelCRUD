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
    public function index(Request $request)
    {
        $page = $request->query('page');
        if ($page and is_numeric($page)) {
            $datos = Cliente::paginate(5);
            return response()->json($data = $datos, $status = 200);
        }
        $datos['clientes'] = Cliente::all();
        return response()->json($data = $datos, $status = 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $cliente = request()->all();
        $model = new Cliente();
        $validator = Validator::make($cliente, $model->rules);

        if ($validator->fails()) {
            return response()->json($data = ['error' => $validator->errors()], $status = 500);
        } else {
            Cliente::create($cliente);
            return response()->json($data = ['message' => 'Cliente creado correctamente'], $status = 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            return response()->json($data = $cliente, $status = 200);
        } catch (\Throwable $th) {
            return response()->json($data =['message' => 'Error trtando de encontrar el cliente'], $status = 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $editCliente = request()->all();
        $model = new Cliente;
        $validator = Validator($editCliente, $model->rulesUpdate);
        if ($validator->fails()) {
            return response()->json($data = ['error' => $validator->errors()]);
        } else {
           $test= Cliente::findOrFail($id)->update($editCliente);
            return response()->json($data = ['messsage' => 'Cliente editado correctamente','test'=>$test], $status = 202);
        }
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
        return response()->json($data = ['message' => 'Cliente eliminado correctamente'], $status = 200);
    }
}
