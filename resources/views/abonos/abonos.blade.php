@extends('layouts.main')

@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">  </div>
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
        <input type="text" id="cliente" name="cliente" class="form-control" onchange="abonos()" >

    </div>
</div>
<div class="row">
    <div class="col-md-3">
            <form action="{{ route('abono.store') }}" method="POST">
            @csrf

            </form>
    </div>
</div>
@endsection
