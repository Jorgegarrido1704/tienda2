<?php

namespace App\Http\Controllers;

use App\Models\venta;
use Illuminate\Http\Request;
use App\Models\personal;
use App\Models\inventario;

class VentaController extends Controller
{
    //
    public function index()
    {
        $venta = venta::orderBy('cuenta', 'desc')->limit(1)->first();
        $promotores = $vendedores = $cobradores =[];
        $venta ='';
        $personal = personal::all();
        foreach($personal as $p){
            if($p->puesto == 'Promotor'){
                $promotores[] = $p;
            }
            if($p->puesto == 'Vendedor'){
                $vendedores[] = $p;
            }
            if($p->puesto == 'Cobrador'){
                $cobradores[] = $p;
            }
        }
        $categorias = inventario::select('categoria')->distinct()->get();
        return view('ventas.venta',['promotores'=>$promotores, 'vendedores'=>$vendedores,
        'cobradores'=>$cobradores, 'venta'=>$venta, 'categorias'=>$categorias]);
    }

    public function create(Request $request) {}

    public function imprimir()
    {
        return view('ventas.impresion');
    }


public function fetchProducts(Request $request) {
    $category = $request->query('category');

    $data = inventario::where('categoria', $category)->get();

    return response()->json($data);
}
public function getPrice(Request $request) {
    $articulo = $request->query('articulo');
    $plazo = $request->query('plazo');


    $columnaBusqueda = 'product'; // O 'articulo', revisa tu BD

    if ($plazo == 0) {
        // --- CASO CONTADO ---
        $datos = Inventario::where($columnaBusqueda, $articulo)
                           ->select('CONTADO')
                           ->first();

        // Validación: Si no existe el producto
        if (!$datos) return response()->json(['error' => 'No encontrado'], 404);

        // Sintaxis correcta de array PHP: []
        $data = [
            'precio' => $datos->CONTADO, // Acceso con flecha ->
            'semanal' => 0
        ];

        return response()->json($data);

    } else {
        // --- CASO CRÉDITO ---
        // Construimos los nombres de las columnas dinámicamente
        $colPrecio = 'precio' . $plazo;   // Ej: precio12
        $colSemana = 'semanal' . $plazo;  // Ej: semanal12

        $datos = Inventario::where($columnaBusqueda, $articulo)
                           ->select($colPrecio, $colSemana)
                           ->first();

        if (!$datos) return response()->json(['error' => 'No encontrado'], 404);

        $data = [

            'precio' => $datos->$colPrecio,
            'semanal' => $datos->$colSemana
        ];

        return response()->json($data);
    }
}

    public function store(Request $request) {

    }
}
