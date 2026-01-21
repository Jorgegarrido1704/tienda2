<?php

namespace App\Http\Controllers;

use App\Models\inventario;
use App\Models\venta;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    //

    public function index()
    {
        $inventario = inventario::select('categoria')->orderBy('categoria')->groupBy('categoria')->get();

        return view('inventario.index', ['inventario' => $inventario]);
    }

    public function datoscategorias(Request $request)
    {
        $categoria = $request->input('categoria');

        $data = inventario::where('categoria', $categoria)->get();

        return response()->json($data);
    }

    public function agregarProducto(Request $request) {}

    public function datoGeneralesProducto($id)
    {
        // $id ya contiene el valor de la URL
        $producto = inventario::findOrFail($id);
        $nombre = strtoupper($producto->product);
        $nombre = str_replace([';', ','], '', $nombre);
        $nombre = preg_replace('/\s+/', ' ', $nombre);

        // dd($nombre);

        $ventas = venta::whereRaw(
            "REPLACE(REPLACE(UPPER(articulo), ';', ''), ',', '') LIKE ?",
            ['%'.$nombre.'%']
        )->get();

        return view('inventario.detalle', ['producto' => $producto, 'ventas' => $ventas]);
    }

    public function actualizarProducto($id)
    {
        $producto = inventario::findOrFail($id);

        return view('inventario.actualizar', compact('producto'));
    }
}
