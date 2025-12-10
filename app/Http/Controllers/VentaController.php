<?php

namespace App\Http\Controllers;

class VentaController extends Controller
{
    //
    public function index()
    {
        return view('ventas.venta');
    }

    public function imprimir()
    {
        return view('ventas.impresion');
    }
}
