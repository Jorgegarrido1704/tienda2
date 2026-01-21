@extends('layouts.main')

@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4"> </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-6">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Detalle del producto</h5>
                </div>
                <div class="card-body" style="overflow-y: auto; height: 40vh;">
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
                            <th>Movimientos</th>
                        </tr>
                        </theader>
                        <tbody>
                            <tr>
                                <td>{{$producto->product}}</td>
                                <td>{{$producto->qty}}</td>
                                <td>{{$producto->CONTADO}}</td>
                                <td>{{$producto->precio1}}</td>
                                <td>{{$producto->precio2}}</td>
                                <td>{{$producto->precio3}}</td>
                                <td>{{$producto->precio4}}</td>
                                <td>{{$producto->precio5}}</td>
                                <td>{{$producto->precio6}}</td>
                                <td>{{$producto->precio7}}</td>
                                <td>{{$producto->precio8}}</td>
                                <td>{{$producto->precio9}}</td>
                                <td>{{$producto->precio10}}</td>
                                <td>{{$producto->precio11}}</td>
                                <td>{{$producto->precio12}}</td>


                            </tr>
                            <tr>
                                <td></td><td></td><td>Semanal</td>
                                <td>{{$producto->semanal1}}</td>
                                <td>{{$producto->semanal2}}</td>
                                <td>{{$producto->semanal3}}</td>
                                <td>{{$producto->semanal4}}</td>
                                <td>{{$producto->semanal5}}</td>
                                <td>{{$producto->semanal6}}</td>
                                <td>{{$producto->semanal7}}</td>
                                <td>{{$producto->semanal8}}</td>
                                <td>{{$producto->semanal9}}</td>
                                <td>{{$producto->semanal10}}</td>
                                <td>{{$producto->semanal11}}</td>
                                <td>{{$producto->semanal12}}</td>
                            </tr>
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


