@extends('layouts.main')

@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4"> </div>
        <script>
        const ROUTES = {
            // Faltaba la comilla despues de las llaves }}
            productos: "{{ route('inventario.datoscategorias') }}",
            verProductos: "{{ route('inventario.datoGeneralesProducto') }}"
        };

    </script>
    <script src="{{ asset('js/inventario.js') }}"></script>

<div class="row">
    <div class="col-md-6">
        <label>Codigo de producto</label>
        <select name="codigo" id="codigo" class="form-control" onchange="verProductos()">
            <option value="" disabled>Seleccione un codigo de producto</option>
            @foreach ($inventario as $inv)
            <option value="{{$inv->codigo}}">{{$inv->codigo}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label>Producto</label>
        <div id="productos"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-6">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Inventario</h5>
                </div>
                <div class="card-body" style="overflow-y: auto; height: 85vh;">

                </div>
        </div>







@endsection
