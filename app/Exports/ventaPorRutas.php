<?php

namespace App\Exports;

use App\Models\venta;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ventaPorRutas implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];
        $rutas = venta::select('ruta')->distinct()->pluck('ruta');

        foreach ($rutas as $ruta) {
            $sheets[] = new \App\Exports\reporteExcelVentas($ruta);
        }

        return $sheets;
    }
}
