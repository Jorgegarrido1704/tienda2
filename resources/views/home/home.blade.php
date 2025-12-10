@extends('layouts.main')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">  </div>
                    <!-- Content Row -->
                    <div class="row">
    <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-6">

                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h5 class="m-0 font-weight-bold text-primary">Bienvenido @if(!empty(session('username'))) {{ session('username') }} @endif </h5>

                                </div>

                                <!-- table Body -->
                                <div class="card-body" style="overflow-y: auto; height: 85vh;">
                                    <img  class ="img-fluid w-100" src="{{ asset('image/loginImg/la espanola.png') }}" alt="Image" id="imageHome">

                                </div>
                            </div>
                        </div>
                    </div>

@endsection
