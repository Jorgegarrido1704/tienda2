<?php

namespace App\Http\Controllers;

use App\Exports\ventaPorRutas;
use App\Models\personal;
use App\Models\venta;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class reportesController extends Controller
{
    //

    public function index()
    {
        return view('reportes.index');
    }

    public function generar(Request $request)
    {
        // Lógica para generar el reporte según los parámetros recibidos
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        $tipo_reporte = $request->input('tipo_reporte');
        if ($tipo_reporte == 'ventas') {
            $ventas = venta::whereBetween('fecha', [$fecha_inicio, $fecha_fin])->get();

        } elseif ($tipo_reporte == 'inventario') {
            // Generar reporte de inventario
        }

    }

    public function exportVentas()
    {
        return Excel::download(
            new ventaPorRutas,
            'ventas_por_ruta.xlsx'
        );
    }

    public function exportInventario()
    {
        // Lógica para exportar inventario
    }

    public function comisiones()
    {
        $empleados = personal::select('nombre')->distinct()->whereIn('puesto', ['VENDEDOR', 'PROMOTOR'])->get();

        return view('reportes.comisiones', ['empleados' => $empleados]);
    }

    public function reporteComisiones() {}
}
