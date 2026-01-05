@extends('layouts.main')

@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4"> </div>
    <script>
        const ROUTES = {
            // Faltaba la comilla despues de las llaves }}
            fetchProducts: "{{ route('venta.fetchProducts') }}"
        };
        const ROUTE_getPrice = "{{ route('venta.getPrice') }}";
    </script>
    <script src="{{ asset('js/venta.js') }}"></script>
    <script>
        const categoriesData = @json($categorias);
    </script>


    <form action="{{ route('venta.store') }}" method="POST" id="ventaForm">
        @csrf

        <div class="container-fluid">

            <h2 class="text-center mb-4">Nota de Venta</h2>

            {{-- FECHA / PAGO / PLAZO / RUTA / CUENTA --}}
            <div class="row mb-3 align-items-end">
                <div class="col-md-2">
                    <label>Fecha</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <div class="col-md-2">
                    <label>Forma de pago $</label>
                    <input type="number" id="forma" name="forma" class="form-control" value="0" readonly>
                </div>

                <div class="col-md-2">
                    <label>Plazo (meses)</label>
                    <select name="plazo" id="plazo" class="form-control" required>
                        <option value=""></option>
                        <option value="0">Contado</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Ruta</label>
                    <input type="number" name="ruta" class="form-control" min="0" required>
                </div>

                <div class="col-md-2">
                    <label>No. Cuenta</label>
                    <input type="number" name="cuenta" class="form-control" value="{{ $venta}}" required>
                </div>
            </div>

            {{-- CLIENTE / AVAL --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Cliente</label>
                    <input type="text" name="cliente" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Aval</label>
                    <input type="text" name="aval" class="form-control">
                </div>
            </div>

            {{-- DOMICILIOS --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Domicilio Cliente</label>
                    <input type="text" name="domcli" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Domicilio Aval</label>
                    <input type="text" name="domav" class="form-control">
                </div>
            </div>

            {{-- COLONIA / FAMILIAR --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Colonia</label>
                    <input type="text" name="col" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Familiar</label>
                    <input type="text" name="espo" class="form-control">
                </div>
            </div>

            {{-- REFERENCIAS --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Ref 1</label>
                    <input type="text" name="ref1" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Domicilio Ref 1</label>
                    <input type="text" name="domref1" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Ref 2</label>
                    <input type="text" name="ref2" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Domicilio Ref 2</label>
                    <input type="text" name="domref2" class="form-control">
                </div>
            </div>

            {{-- PERSONAL --}}
            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Promotor</label>
                    <select name="promotor" class="form-control" required>
                        <option value=""></option>
                        @foreach ($promotores as $p)
                            <option value="{{ $p->nombre }}">{{ $p->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Vendedor</label>
                    <select name="vendedor" class="form-control" required>
                        <option value=""></option>
                        @foreach ($vendedores as $v)
                            <option value="{{ $v->nombre }}">{{ $v->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Cobrador</label>
                    <select name="cobrador" class="form-control" required>
                        <option value=""></option>
                        @foreach ($cobradores as $c)
                            <option value="{{ $c->nombre }}">{{ $c->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- ARTICULOS --}}

                <div class="col-md-3">
                    <label>Cantidad de artículos</label>
                    <input type="number" id="cantart" name="cantart" class="form-control" min="0"
                        onchange="cantidad()" required>
                </div>
            </div>

            <div id="dynamicContentContainer"></div>

            {{-- SUBTOTAL --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Subtotal $</label>
                    <input type="text" id="prec" class="form-control" readonly>
                </div>
                {{-- ENGANCHE / SALDO --}}
                <div class="col-md-4">
                    <label>Enganche $</label>
                    <input type="number" id="eng" name="eng" class="form-control" value="0"
                        onchange="enganche()">
                </div>
                <div class="col-md-4">
                    <label>Saldo $</label>
                    <input type="text" id="sald" class="form-control" readonly>
                </div>
            </div>

            {{-- HIDDEN --}}
            <input type="hidden" name="pre" id="pre">
            <input type="hidden" name="sa" id="sa">
            <input type="hidden" name="fo" id="fo">
            <input type="hidden" name="arts" id="arts">

            <button type="submit" class="btn btn-primary">Guardar</button>

        </div>
    </form>
@endsection
