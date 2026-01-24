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

    public function agregarProducto(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string',
            'product' => 'required|string',
            'qty' => 'required|numeric',
            'CONTADO' => 'required|numeric',
            'precio1' => 'required|numeric',
            'precio2' => 'required|numeric',
            'precio3' => 'required|numeric',
            'precio4' => 'required|numeric',
            'precio5' => 'required|numeric',
            'precio6' => 'required|numeric',
            'precio7' => 'required|numeric',
            'precio8' => 'required|numeric',
            'precio9' => 'required|numeric',
            'precio10' => 'required|numeric',
            'precio11' => 'required|numeric',
            'precio12' => 'required|numeric',
            'semanal1' => 'required|numeric',
            'semanal2' => 'required|numeric',
            'semanal3' => 'required|numeric',
            'semanal4' => 'required|numeric',
            'semanal5' => 'required|numeric',
            'semanal6' => 'required|numeric',
            'semanal7' => 'required|numeric',
            'semanal8' => 'required|numeric',
            'semanal9' => 'required|numeric',
            'semanal10' => 'required|numeric',
            'semanal11' => 'required|numeric',
            'semanal12' => 'required|numeric',
            'categoria' => 'required|string',
        ]);
        $request->merge(['codigo' => strtoupper($request->input('codigo'))]);
        $request->merge(['product' => strtoupper($request->input('product'))]);
        $request->merge(['categoria' => strtoupper($request->input('categoria'))]);
        // add to $request the anoprecio
        $request->merge(['anoPrecio' => date('Y')]);
        $producto = inventario::create($request->all());

        return back()->with('success', 'Producto agregado exitosamente.');
    }

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

    public function actualizarProducto(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'qty' => 'required|numeric',
            'CONTADO' => 'required|numeric',
            'precio1' => 'required|numeric',
            'precio2' => 'required|numeric',
            'precio3' => 'required|numeric',
            'precio4' => 'required|numeric',
            'precio5' => 'required|numeric',
            'precio6' => 'required|numeric',
            'precio7' => 'required|numeric',
            'precio8' => 'required|numeric',
            'precio9' => 'required|numeric',
            'precio10' => 'required|numeric',
            'precio11' => 'required|numeric',
            'precio12' => 'required|numeric',
            'semanal1' => 'required|numeric',
            'semanal2' => 'required|numeric',
            'semanal3' => 'required|numeric',
            'semanal4' => 'required|numeric',
            'semanal5' => 'required|numeric',
            'semanal6' => 'required|numeric',
            'semanal7' => 'required|numeric',
            'semanal8' => 'required|numeric',
            'semanal9' => 'required|numeric',
            'semanal10' => 'required|numeric',
            'semanal11' => 'required|numeric',
            'semanal12' => 'required|numeric',
        ]);
        inventario::where('id', $request->input('id'))->update(
            [
                'qty' => $request->input('qty'),
                'CONTADO' => $request->input('CONTADO'),
                'precio1' => $request->input('precio1'),
                'precio2' => $request->input('precio2'),
                'precio3' => $request->input('precio3'),
                'precio4' => $request->input('precio4'),
                'precio5' => $request->input('precio5'),
                'precio6' => $request->input('precio6'),
                'precio7' => $request->input('precio7'),
                'precio8' => $request->input('precio8'),
                'precio9' => $request->input('precio9'),
                'precio10' => $request->input('precio10'),
                'precio11' => $request->input('precio11'),
                'precio12' => $request->input('precio12'),
                'semanal1' => $request->input('semanal1'),
                'semanal2' => $request->input('semanal2'),
                'semanal3' => $request->input('semanal3'),
                'semanal4' => $request->input('semanal4'),
                'semanal5' => $request->input('semanal5'),
                'semanal6' => $request->input('semanal6'),
                'semanal7' => $request->input('semanal7'),
                'semanal8' => $request->input('semanal8'),
                'semanal9' => $request->input('semanal9'),
                'semanal10' => $request->input('semanal10'),
                'semanal11' => $request->input('semanal11'),
                'semanal12' => $request->input('semanal12'),
            ]
        );

        return redirect()->route('inventario.datoGeneralesProducto', ['id' => $request->input('id')]);
    }
}
