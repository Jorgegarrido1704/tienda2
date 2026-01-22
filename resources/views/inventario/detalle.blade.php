@extends('layouts.main')

@section('contenido')
<style>
    .num-40{
    width: 50px;
    -moz-appearance: textfield;
}

.num-40::-webkit-inner-spin-button,
.num-40::-webkit-outer-spin-button{
    -webkit-appearance: none;
    margin: 0;
}

</style>
    <div class="d-sm-flex align-items-center justify-content-between mb-4"> </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-6">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Detalle del producto</h5>
                </div>
                <div class="card-body" style="overflow-y: auto; height: 22vh;">
                    <table class="table table-responsive">
                        <theader>
                        <tr>
                            <th>Producto</th>
                            <th>Existencia</th>
                            <th>Contado</th>
                            <th>1 mes</th>
                            <th>2 meses</th>
                            <th>3 meses</th>
                            <th>4 meses</th>
                            <th>5 meses</th>
                            <th>6 meses</th>
                            <th>7meses</th>
                            <th>8 meses</th>
                            <th>9 meses</th>
                            <th>10 meses</th>
                            <th>11 meses</th>
                            <th>12 meses</th>

                        </tr>
                        </theader>
                        <tbody>
                                 <form action="{{ route('inventario.actualizarProducto') }}" method="POST">
                                   <tr>
                                    <td>{{$producto->product}}</td>
                                    @csrf
                                    <td><input type="number" class="num-40" name="qty" value="{{$producto->qty}}" min="0" step="1" required> </td></td>
                                    <td><input type="number" class="num-40" name="CONTADO" value="{{$producto->CONTADO}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="precio1" value="{{$producto->precio1}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="precio2" value="{{$producto->precio2}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="precio3" value="{{$producto->precio3}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="precio4" value="{{$producto->precio4}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="precio5" value="{{$producto->precio5}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="precio6" value="{{$producto->precio6}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="precio7" value="{{$producto->precio7}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="precio8" value="{{$producto->precio8}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="precio9" value="{{$producto->precio9}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="precio10" value="{{$producto->precio10}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="precio11" value="{{$producto->precio11}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="precio12" value="{{$producto->precio12}}" min="0" step="1" required> </td>
                                </tr>
                                <tr>
                                    <td></td><td></td><td>Semanal</td>
                                     <td><input type="number" class="num-40" name="semanal1" value="{{$producto->semanal1}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="semanal2" value="{{$producto->semanal2}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="semanal3" value="{{$producto->semanal3}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="semanal4" value="{{$producto->semanal4}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="semanal5" value="{{$producto->semanal5}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="semanal6" value="{{$producto->semanal6}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="semanal7" value="{{$producto->semanal7}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="semanal8" value="{{$producto->semanal8}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="semanal9" value="{{$producto->semanal9}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="semanal10" value="{{$producto->semanal10}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="semanal11" value="{{$producto->semanal11}}" min="0" step="1" required> </td>
                                    <td><input type="number" class="num-40" name="semanal12" value="{{$producto->semanal12}}" min="0" step="1" required> </td>

                                </tr>
                                <tr>
                               <td> <input type="hidden" name="id" value="{{$producto->id}}">
                                <button class="btn btn-success">Guardar</button></td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <div class="col-md-6">
                <div class="card shadow mb-6">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">Movimientos de productos en cuentas</h5>
                    </div>
                    <div class="card-body" style="overflow-y: auto; height: 85vh;">
                        <table class="table table-responsive">
                            <theader>
                            <tr>
                                <th>Numero de cuenta</th>
                                <th>Cliente</th>
                                <th>Saldo</th>
                                <th>Fecha de venta</th>

                                <th></th>
                            </tr>
                            </theader>
                            <tbody>
                                @foreach($ventas as $movimiento)
                                <tr>
                                    <td>{{$movimiento->cuenta}}</td>
                                    <td>{{$movimiento->cliente}}</td>
                                    <td>{{$movimiento->saldo}}</td>
                                    <td>{{$movimiento->fecha}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-6">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">Compras de mercancias</h5>
                    </div>
                    <div class="card-body" style="overflow-y: auto; height: 85vh;">
                    </div>
                </div>
            </div>
        </div>





@endsection


