<?php

namespace App\Http\Controllers;

use App\Models\ensal;
use App\Models\inventario;
use App\Models\personal;
use App\Models\venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    //
    public function index()
    {
        $venta = venta::select('cuenta')->orderBy('cuenta', 'desc')->limit(1)->first();
        $venta = $venta->cuenta ?? 0 + 1;
        $promotores = $vendedores = $cobradores = [];

        $personal = personal::all();
        foreach ($personal as $p) {
            if ($p->puesto == 'PROMOTOR') {
                $promotores[] = $p;
            }
            if ($p->puesto == 'VENDEDOR') {
                $vendedores[] = $p;
            }
            if ($p->puesto == 'COBRADOR') {
                $cobradores[] = $p;
            }
        }
        $categorias = inventario::select('categoria')->distinct()->get();

        return view('ventas.venta', ['promotores' => $promotores, 'vendedores' => $vendedores,
            'cobradores' => $cobradores, 'venta' => $venta, 'categorias' => $categorias]);
    }

    public function create(Request $request) {}

    public function imprimir(Request $request)
    {
        $cuenta = $request->input('cuenta');

        $venta = venta::where('cuenta', $cuenta)->first();
        $venta['date'] = date('d-m-Y', strtotime($venta->fecha));
        $venta['forma'] = number_format($venta->semanal, 2);
        $venta['plazo'] = $venta->meses;
        $venta['ruta'] = $venta->ruta;
        $venta['cuenta'] = $venta->cuenta;
        $venta['cliente'] = $venta->cliente;
        $venta['aval'] = $venta->aval;
        $venta['domcli'] = $venta->domcli;
        $venta['espo'] = $venta->espo;
        $venta['domav'] = $venta->domaval;
        $venta['col'] = $venta->col;
        $venta['ref2'] = $venta->ref2;
        $venta['domref2'] = $venta->domre2;
        $venta['ref1'] = $venta->ref1;
        $venta['domref1'] = $venta->domref1;
        $venta['promotor'] = $venta->promotor;
        $venta['vendedor'] = $venta->vendedor;
        $venta['entrego'] = $venta->entrego;
        $venta['cobrador'] = $venta->cobrador;
        $venta['cantart'] = $venta->cantArt;
        $venta['arts'] = $venta->articulo;
        $venta['pre'] = intval($venta->precio);
        $venta['eng'] = intval($venta->enganche);
        $venta['sa'] = intval($venta->saldo);

        return view('ventas.impresion', ['venta' => $venta]);
    }

    public function fetchProducts(Request $request)
    {
        $category = $request->query('category');

        $data = inventario::where('categoria', $category)->get();

        return response()->json($data);
    }

    public function getPrice(Request $request)
    {
        $articulo = $request->query('articulo');
        $plazo = $request->query('plazo');

        $columnaBusqueda = 'product'; // O 'articulo', revisa tu BD

        if ($plazo == 0) {
            // --- CASO CONTADO ---
            $datos = Inventario::where($columnaBusqueda, $articulo)
                ->select('CONTADO')
                ->first();

            // Validación: Si no existe el producto
            if (! $datos) {
                return response()->json(['error' => 'No encontrado'], 404);
            }

            // Sintaxis correcta de array PHP: []
            $data = [
                'precio' => $datos->CONTADO, // Acceso con flecha ->
                'semanal' => 0,
            ];

            return response()->json($data);

        } else {
            // --- CASO CRÉDITO ---
            // Construimos los nombres de las columnas dinámicamente
            $colPrecio = 'precio'.$plazo;   // Ej: precio12
            $colSemana = 'semanal'.$plazo;  // Ej: semanal12

            $datos = Inventario::where($columnaBusqueda, $articulo)
                ->select($colPrecio, $colSemana)
                ->first();

            if (! $datos) {
                return response()->json(['error' => 'No encontrado'], 404);
            }

            $data = [

                'precio' => $datos->$colPrecio,
                'semanal' => $datos->$colSemana,
            ];

            return response()->json($data);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (venta::where('cuenta', $data['cuenta'])->exists()) {
            return back()->with('error', 'El numero de cuenta ya existe.');
        }
        $venta = venta::insert([
            'fecha' => $data['date'],
            'semanal' => $data['forma'],
            'meses' => $data['plazo'],
            'ruta' => $data['ruta'],
            'cuenta' => $data['cuenta'],
            'cliente' => $data['cliente'],
            'aval' => $data['aval'],
            'domcli' => $data['domcli'],
            'espo' => $data['espo'],
            'domaval' => $data['domav'],
            'col' => $data['col'],
            'ref2' => $data['ref2'],
            'domre2' => $data['domref2'],
            'ref1' => $data['ref1'],
            'domref1' => $data['domref1'],
            'promotor' => $data['promotor'],
            'vendedor' => $data['vendedor'],
            'entrego' => $data['vendedor'],
            'cobrador' => $data['cobrador'],
            'cantArt' => $data['cantart'],
            'articulo' => $data['arts'],
            'precio' => $data['pre'],
            'enganche' => $data['eng'],
            'saldo' => $data['sa'],
            'estatus' => 'ACTIVO',
        ]);

        if (strpos($data['arts'], ',') !== false) {
            $articulos = explode(',', $data['arts']);
            array_unshift($articulos, '');
        } else {
            $articulos = ['', $data['arts']];
        }
        for ($i = 1; $i < count($articulos); $i++) {
            ensal::insert([
                'fecha' => $data['date'],
                'producto' => $articulos[$i],
                'cantidad' => 1,
                'concepto' => 'VENTA',
            ]);
        }

        return view('ventas.impresion', ['venta' => $data]);
    }

    public function verVentas()
    {
        $ventas = venta::all();

        return view('cliente.index', ['ventas' => $ventas]);
    }

    public function fetchClientes(Request $request)
    {
        $cliente = $request->input('cliente');
        $numCuenta = $request->input('numCuenta');

        $query = venta::query();

        if (! empty($cliente)) {
            $query->where('cliente', 'LIKE', "%$cliente%");
        }

        if (! empty($numCuenta)) {
            $query->where('cuenta', '=', "$numCuenta");
        }

        $data = $query->get();

        return response()->json($data);
    }

    public function EditarInformacion(Request $request)
    {
        $cuenta = $request->input('cuenta');
        $venta = venta::where('cuenta', $cuenta)->first();

        return view('cliente.editarCliente', ['venta' => $venta]);

    }

    public function edicion(Request $request)
    {
        $data = $request->all();
        $cuenta = $data['cuenta'];

        $venta = Venta::where('cuenta', $data['cuenta'])->firstOrFail();

        $venta->update([
            'fecha' => $data['date'],
            'semanal' => $data['forma'],
            'meses' => $data['plazo'],
            'ruta' => $data['ruta'],
            'cuenta' => $data['cuenta'],
            'cliente' => $data['cliente'],
            'aval' => $data['aval'],
            'domcli' => $data['domcli'],
            'espo' => $data['espo'],
            'domaval' => $data['domav'],
            'col' => $data['col'],
            'ref2' => $data['ref2'],
            'domre2' => $data['domref2'],
            'ref1' => $data['ref1'],
            'domref1' => $data['domref1'],
            'promotor' => $data['promotor'],
            'vendedor' => $data['vendedor'],
            'entrego' => $data['vendedor'],
            'cobrador' => $data['cobrador'],
            'cantArt' => $data['cantart'],
            'articulo' => $data['arts'],
            'precio' => $data['pre'],
            'enganche' => $data['eng'],
            'saldo' => $data['sa'],
            'estatus' => 'ACTIVO - EDITADO',
        ]);

        return view('ventas.impresion', ['cuenta' => $cuenta]);
    }
}
