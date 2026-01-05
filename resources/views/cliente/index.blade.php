@extends('layouts.main')

@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4"> </div>
    <script>
        const ROUTES = {
            // Faltaba la comilla despues de las llaves }}
            verVentas: "{{ route('venta.fetchClientes') }}"
        };
    </script>
    <script src="{{ asset('js/clientes.js') }}"></script>
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Clientes registrados</h2>
        </div>
        <div class="col-md-6">
            <label>Cliente</label>
            <input type="text" id="cliente" name="cliente" class="form-control" onchange="informacionClientes()">
        </div>
        <div class="col-md-6">
            <label>Numero de cuenta</label>
            <input type="text" id="numCuenta" name="numCuenta" class="form-control" onchange="informacionClientes()">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Numero de Cuenta</th>
                        <th>Cliente</th>
                        <th>Saldo</th>
                        <th>Fecha Ultimo Abono</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                        <tr>
                            <td><button type="button" class="btn btn-primary"><a class="btn btn-primary"
                                        href="{{ route('venta.imprimir', ['cuenta' => $venta->cuenta]) }}">{{ $venta->cuenta }}</a></button>
                            </td>
                            <td>{{ $venta->cliente }}</td>
                            <td>${{ number_format($venta->saldo, 2) }}</td>
                            <td><button type="button" class="btn btn-primary"><a class="btn btn-primary"
                                        href="{{ route('abono.index', ['cuenta' => $venta->cuenta]) }}">
                                        {{ $venta->fecha_ultimo_abono ? \Carbon\Carbon::parse($venta->fecha_ultimo_abono)->format('d/m/Y') : 'N/A' }}</a></button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    </div>
@endsection
