<?php

namespace App\Http\Controllers;

use App\Models\venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    //
    public function index()
    {
        $venta = venta::orderBy('cuenta', 'desc')->limit(1)->first();
        $promotores = $vendedores = $cobradores =[];
        $venta ='';
        return view('ventas.venta',['promotores'=>$promotores, 'vendedores'=>$vendedores,
        'cobradores'=>$cobradores, 'venta'=>$venta]);
    }

    public function create(Request $request) {}

    public function imprimir()
    {
        return view('ventas.impresion');
    }

    public function fetchProducts(Request $request) {}

    public function store(Request $request) {

    }
}
