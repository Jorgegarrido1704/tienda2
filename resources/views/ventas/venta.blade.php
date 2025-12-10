@extends('layouts.main')

@section('contenido')
    <script src="{{ asset('js/venta.js') }}"></script>
    <div class="d-sm-flex align-items-center justify-content-between mb-4"> </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-6">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Punto de venta </h5>

                </div>

                <!-- table Body -->
                <div class="card-body" style="overflow-y: auto; height: 85vh;">
                    <form action="#" method="POST">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-1 text-center  ">
                                <div class="form-group">
                                    <div class="col-md-12 ">
                                        <label for="fehca">Fecha</label>
                                        <input id="fehca" type="date" class="form-control" name="fehca" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 text-center  ">
                                <div class="form-group">
                                    <div class="col-md-12 ">
                                        <label for="pago">Pago Semanal</label>
                                        <input id="pago" type="numer" class="form-control" name="pago" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 text-center  ">
                                <div class="form-group">
                                    <div class="col-md-12 ">
                                        <label for="meses">Meses de pago</label>
                                        <select name="meses" id="meses" class="form-control">
                                            <option value="0">Contado</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}">{{ $i }} Meses</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 text-center  ">
                                <div class="form-group">
                                    <div class="col-md-12 ">
                                        <label for="ruta">Ruta</label>
                                        <select name="ruta" id="ruta" class="form-control">
                                            <option value="1">Ruta 1</option>
                                            @for ($i = 2; $i <= 12; $i++)
                                                <!-- Falta crear las rutas en BD para que se muestren -->
                                                <option value="{{ $i }}">Ruta {{ $i }} </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 text-center  ">
                                <div class="form-group">
                                    <div class="col-md-12 ">
                                        <label for="cuenta">Cuenta</label>
                                        <input name="cuenta" id="cuenta" class="form-control" value="{{ $cuenta??1 }}" min="1" step="1">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
