<?php

namespace App\Exports;

use App\Models\venta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class reporteExcelVentas implements FromCollection, WithHeadings, WithTitle
{
    private $ruta;

    public function __construct($ruta)
    {
        $this->ruta = $ruta;
    }

    public function collection()
    {
        $ventas = venta::where('ruta', $this->ruta)
            ->select('fecha', 'cuenta', 'cliente', 'articulo', 'precio', 'enganche', 'semanal', 'meses', 'saldo')
            ->get();

        $saldoFinal = $ventas->sum('saldo');

        // fila final con saldo total
        $ventas->push([
            'fecha' => 'SALDO FINAL',
            'cuenta' => '',
            'cliente' => '',
            'articulo' => '',
            'precio' => '',
            'enganche' => '',
            'semanal' => '',
            'meses' => '',
            'saldo' => $saldoFinal,
        ]);

        return $ventas;
    }

    public function headings(): array
    {
        return ['Fecha', 'Cuenta', 'Cliente', 'Artículo', 'Precio', 'Enganche', 'Semanal', 'Meses', 'Saldo'];
    }

    public function title(): string
    {
        return 'Ruta '.$this->ruta;
    }
}
