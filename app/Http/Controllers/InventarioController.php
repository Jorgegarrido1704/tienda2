<?php

namespace App\Http\Controllers;

use App\Models\inventario;

class InventarioController extends Controller
{
    //

    public function index()
    {
        $inventario = inventario::select('categoria')->get();

        return view('inventario.index', ['inventario' => $inventario]);
    }

    public function datoscategorias(Request $request)
    {
        $categoria = $request->query('categoria');

        $data = inventario::select('productos')->where('categoria', $categoria)->get();

        return response()->json($data);
    }

    public function datoGeneralesProducto(Request $request)
    {
        $articulo = $request->query('articulo');

        $data = inventario::where('product', $articulo)->first();

        return response()->json($data);
    }

    public function actualizarProducto(Request $request) {}

    public function agregarProducto(Request $request) {}
}
