@extends('layouts.main')

@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4"> </div>
        <script>
        const ROUTES = {
            // Faltaba la comilla despues de las llaves }}
            productos: "{{ route('inventario.datoscategorias') }}",
        };
        const rutaInfoProducto = "{{ route('inventario.datoGeneralesProducto', ':id') }}";
const rutaActualizarProducto = "{{ route('inventario.actualizarProducto', ':id') }}";
    </script>
    <script src="{{ asset('js/inventario.js') }}"></script>

<div class="row">
    <div class="col-md-6">
        <label>Codigo de producto</label>
        <select name="codigo" id="codigo" class="form-control" onchange="verProductos()">
            <option value="" >Seleccione un codigo de producto</option>
            @foreach ($inventario as $inv)
            <option value="{{$inv->categoria}}">{{$inv->categoria}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label>Ingresar un nuevo producto</label>
        <button type="button" class="btn btn-success" ><i class="fas fa-plus" onclick="mostarFormularioNuevoProducto();">
            Nuevo producto</i></button>
    </div>
    <div class = "col-md-12" id="nuevoProducto" style="margin-top: 20px; margin-bottom: 20px; display: none;">
        <br>
        <form action="{{ route('inventario.agregarProducto') }}" method="POST">
            @csrf
            <div class='row'>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="codigo">Codigo del producto:</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" required onchange="setCategoria(this.value);">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="product">Nombre del producto:</label>
                        <input type="text" class="form-control" id="product" name="product" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="qty">Cantidad del producto:</label>
                        <input type="text" class="form-control" id="qty" name="qty" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="CONTADO">Precio contado</label>
                        <input type="text" class="form-control" id="CONTADO" name="CONTADO" required onchange="setPrecio(this.value);">
                    </div>
                </div>
                 <div class="col-md-1">
                    <div class="form-group">
                        <label for="precio1">Precio a 1 mes</label>
                        <input type="text" class="form-control" id="precio1" name="precio1" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="precio2">Precio a 2 meses</label>
                        <input type="text" class="form-control" id="precio2" name="precio2" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="precio3">Precio a 3 meses</label>
                        <input type="text" class="form-control" id="precio3" name="precio3" required>
                    </div>
                </div>
                 <div class="col-md-1">
                    <div class="form-group">
                        <label for="precio4">Precio a 4 meses</label>
                        <input type="text" class="form-control" id="precio4" name="precio4" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="precio5">Precio a 5 meses</label>
                        <input type="text" class="form-control" id="precio5" name="precio5" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="precio6">Precio a 6 meses</label>
                        <input type="text" class="form-control" id="precio6" name="precio6" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="precio7">Precio a 7 meses</label>
                        <input type="text" class="form-control" id="precio7" name="precio7" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="precio8">Precio a 8 meses</label>
                        <input type="text" class="form-control" id="precio8" name="precio8" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="precio9">Precio a 9 meses</label>
                        <input type="text" class="form-control" id="precio9" name="precio9" required>
                    </div>
                </div>
                 <div class="col-md-1">
                    <div class="form-group">
                        <label for="precio10">Precio a 10 meses</label>
                        <input type="text" class="form-control" id="precio10" name="precio10" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="precio11">Precio a 11 meses</label>
                        <input type="text" class="form-control" id="precio11" name="precio11" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="precio12">Precio a 12 meses</label>
                        <input type="text" class="form-control" id="precio12" name="precio12" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="semanal1">Pago Semanal a 1 mes</label>
                        <input type="text" class="form-control" id="semanal1" name="semanal1" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="semanal2">Pago Semanal a 2 meses</label>
                        <input type="text" class="form-control" id="semanal2" name="semanal2" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="semanal3">Pago Semanal a 3 meses</label>
                        <input type="text" class="form-control" id="semanal3" name="semanal3" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="semanal4">Pago Semanal a 4 meses</label>
                        <input type="text" class="form-control" id="semanal4" name="semanal4" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="semanal5">Pago Semanal a 5 meses</label>
                        <input type="text" class="form-control" id="semanal5" name="semanal5" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="semanal6">Pago Semanal a 6 meses</label>
                        <input type="text" class="form-control" id="semanal6" name="semanal6" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="semanal7">Pago Semanal a 7 meses</label>
                        <input type="text" class="form-control" id="semanal7" name="semanal7" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="semanal8">Pago Semanal a 8 meses</label>
                        <input type="text" class="form-control" id="semanal8" name="semanal8" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="semanal9">Pago Semanal a 9 meses</label>
                        <input type="text" class="form-control" id="semanal9" name="semanal9" required>
                    </div>
                </div>
                 <div class="col-md-1">
                    <div class="form-group">
                        <label for="semanal10">Pago Semanal a 10 meses</label>
                        <input type="text" class="form-control" id="semanal10" name="semanal10" required>
                    </div>
                 </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="semanal11">Pago Semanal a 11 meses</label>
                        <input type="text" class="form-control" id="semanal11" name="semanal11" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="semanal12">Pago Semanal a 12 meses</label>
                        <input type="text" class="form-control" id="semanal12" name="semanal12" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <input type="text" class="form-control" id="categoria" name="categoria" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                     <button type="submit" class="btn btn-primary">Agregar Producto</button>
                    </div>
                </div>
            </div>

        </form>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-6">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Inventario</h5>
                </div>
                <div class="card-body" style="overflow-y: auto; height: 85vh;">
                    <div id="productos" name="productos"></div>
                </div>
        </div>
    </div>
</div>





@endsection

