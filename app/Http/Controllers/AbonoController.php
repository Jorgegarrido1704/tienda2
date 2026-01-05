<?php

namespace App\Http\Controllers;

use App\Models\abono;
use App\Models\venta;
use Illuminate\Http\Request;

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

        return view('abonos.abonos', ['venta' => $venta]);
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

            return redirect()->route('abono.index')->with('success', 'Abono registrado correctamente.');

        } else {
            return redirect()->route('abono.index')->with('error', 'Error al registrar el abono.');
        }
    }
}
