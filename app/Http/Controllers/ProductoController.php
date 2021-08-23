<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = request()->query('page');
        if ($page and is_numeric($page)) {
            $datos = Producto::paginate(5);
        } else {
            $datos['productos'] = Producto::all();
        }
        return response()->json($data = [$datos], $status = 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Producto();
        $producto = request()->all();
        $validator = Validator::make($producto, $model->rules);
        if ($validator->fails()) {
            return response()->json($data = ['error' => $validator->errors()]);
        } else {
            $etiquetas = request()->only('etiquetas');
            $productoCreado = Producto::create($producto);
            foreach ($etiquetas as $id) {
                $productoCreado->etiquetas()->attach($id);
            }
            return response()->json($data = ['message' => 'Producto creado correctamente!'], $status = 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $producto = Producto::findOrfail('id', '=', $id);
            return response()->json($data = $producto, $status = 200);
        } catch (\Throwable $th) {
            return response()->json($data = ['message' => 'Error intentando encontrar el producto'], $status = 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $editProducto = request()->all();
        $model = new Producto;
        $validator = Validator::make($editProducto, $model->rules);
        if ($validator->fails()) {
            return response()->json($data = ['error' => $validator->errors()]);
        } else {
            $etiquetas = request()->only('etiquetas');
            Producto::where('id', '=', $id)->update(request()->except('etiquetas'));
            $producto = Producto::findOrfail($id);
            return response()->json($data = ['message' => 'Producto editado correctamente'], $status = 202);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Producto::destroy($id);
            return response()->json($data = ['message' => 'Producto eliminado correctamente']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($data = ['message' => 'Error intentando eliminar el producto'], $status = 500);
        }
    }
}
