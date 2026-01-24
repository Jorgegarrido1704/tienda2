@extends('layouts.main')

@section('contenido')
    <div class="d-sm-flex align-items-center justify-content-between mb-4"> </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros de Reportes</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('reportes.generar') }}" method="GET">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                        </div>
                        <div class="form-group">
                            <label for="fecha_fin">Fecha de Fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                        </div>
                        <div class="form-group">
                            <label for="tipo_reporte">Tipo de Reporte</label>
                            <select class="form-control" id="tipo_reporte" name="tipo_reporte">
                                <option value="ventas">Ventas</option>
                                <option value="inventario">Inventario</option>
                                <option value="clientes">Clientes</option>
                                <option value="cobradores">Cobradores</option>
                                <option value="vendedores">Vendedores</option>
                                <option value="promotores">Promotores</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Generar Reporte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
