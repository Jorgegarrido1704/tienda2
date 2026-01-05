@extends('layouts.main')

@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4"> </div>
    <script>
        const ROUTES = {
            // Faltaba la comilla despues de las llaves }}
            abonos: "{{ route('abono.datos') }}"
        };
    </script>
    <script src="{{ asset('js/abono.js') }}"></script>
    <div class="row">
        <div class="col-md-2">
            <label>Cliente</label>
            <input type="text" id="cliente" name="cliente" class="form-control" onchange="abonos()">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Numero de cuenta</th>
                        <th>Cliente</th>
                        <th>Saldo</th>
                        <th>Fecha abono</th>
                        <th>Abono</th>
                        <th>Saldo restante</th>
                        <th>Numero de recibo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($venta))
                        <tr>
                            <form action="{{ route('abono.store') }}" method="POST">
                                @csrf

                                <td><input type="text" name="cuenta" id="cuenta" class="form-control"
                                        value="{{ $venta->cuenta }}" readonly></td>
                                <td><input type="text" name="cliente" id="cliente" class="form-control"
                                        value="{{ $venta->cliente }}" readonly></td>
                                <td><input type="number" name="saldo" id="saldo" class="form-control"
                                        value="{{ $venta->saldo }}" readonly></td>
                                <td><input type="date" name="fechaAbono" id="fechaAbono" class="form-control" required>
                                </td>
                                <td><input type="number" name="abono" id="abono" class="form-control" required
                                        min="0" max="{{ $venta->saldo }}" step="1" onchange="resto();">
                                </td>
                                <td><input type="number" name="restoCuenta" id="retoCuenta" class="form-control"
                                        value="{{ $venta->saldo }}" readonly>
                                </td>
                                <td><input type="text" name="numRec" id="numRec" class="form-control" required></td>
                                <td> <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function resto() {
            var saldo = parseFloat(document.getElementById('saldo').value) || 0;
            var abono = parseFloat(document.getElementById('abono').value) || 0;
            var resto = saldo - abono;
            document.getElementById('retoCuenta').value = resto >= 0 ? resto : 0;
        }
    </script>
@endsection
