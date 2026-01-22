<?php

namespace App\Http\Controllers;

use App\Models\abono;
use App\Models\venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbonoController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $user = session('username');
        $role = session('role');
        if (! $user) {
            return redirect()->route('login.index');
        }
        $cuenta = $request->input('cuenta');
        if (! empty($cuenta)) {
            $venta = venta::where('cuenta', $cuenta)->first();
        } else {
            $venta = null;
        }
        $abonos = abono::where('cuenta', $cuenta)->get();

        return view('abonos.abonos', ['venta' => $venta, 'abonos' => $abonos]);
    }

    public function datos(Request $request)
    {
        //

    }

    public function store(Request $request)
    {
        //
        $datosAbonos = $request->all();
        $abono = new abono;
        $abono->fechab = $datosAbonos['fechaAbono'];
        $abono->cuenta = $datosAbonos['cuenta'];
        $abono->client = $datosAbonos['cliente'];
        $abono->abono = $datosAbonos['abono'];
        $abono->noRec = $datosAbonos['numRec'];
        if ($abono->save()) {
            venta::where('cuenta', $datosAbonos['cuenta'])
                ->update(['saldo' => $datosAbonos['restoCuenta']]);

            return redirect()->route('abono.index', ['cuenta' => $datosAbonos['cuenta']])->with('success', 'Abono registrado correctamente.');

        } else {
            return redirect()->route('abono.index', ['cuenta' => $datosAbonos['cuenta']])->with('error', 'Error al registrar el abono.');
        }
    }

    public function editarAbono(Request $request)
    {
        //
        if ($request->input('editar') != null) {
            $id = $request->input('editar');
            $abono = $request->input('abono');
            $recibo = $request->input('noRec');
            $fechaAbono = $request->input('fecha_abono');
            $informacion = abono::select('abono', 'cuenta')->where('id', $id)->first();
            if ($abono != $informacion->abono) {
                $nuevoAbono = $informacion->abono - $abono;
                venta::where('cuenta', $informacion->cuenta)
                    ->update([
                        'saldo' => DB::raw('saldo + '.$nuevoAbono),
                    ]);

            }
            abono::where('id', $id)->update(['abono' => $abono, 'noRec' => $recibo, 'fechab' => $fechaAbono]);

            return redirect()->route('abono.index', ['cuenta' => $informacion->cuenta])->with('success', 'Abono editado correctamente.');

        } elseif ($request->input('eliminar') != null) {
            $id = $request->input('eliminar');
            $abono = abono::select('abono', 'cuenta')->where('id', $id)->first();
            venta::where('cuenta', $abono->cuenta)
                ->update([
                    'saldo' => DB::raw('saldo + '.$abono->abono),
                ]);
            abono::where('id', $id)->delete();

            return redirect()->route('abono.index', ['cuenta' => $abono->cuenta])->with('success', 'Abono eliminado correctamente.');
        }
    }
}
