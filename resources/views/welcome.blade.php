@extends('layouts.main')

@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">  </div>
<style>
    body {
        background-color: #f8f9fa;
        background-image: url('{{ asset('image/loginImg/la espanola.png') }}');
        background-size: cover;
        background-position: center;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card {
        margin-top: 50px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    h1 {
        margin-bottom: 30px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 item-center text-center">
            <div class="card px-4 py-4">
                <div class="col-md-12 text-center  ">
                     <h1>Mueblria la espanola </h1>
                </div>
                  <form name="f1" action="{{ route('login.index') }}" onsubmit="return validation()" method="POST">
                     @csrf
               <div class="form-group item-center text-center">

                    <div class="col-md-12">
                        <label for="user" class="col-md-4 col-form-label text-md-right">Usuario</label>
                        <input id="user" type="text" class="form-control" name="user"  required  autofocus>
                    </div>
                </div>
                 <div class="form-group item-center text-center">

                    <div class="col-md-12">
                        <label for="pass" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                        <input id="pass" type="text" class="form-control" name="pass"  required  autofocus>
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-md-12 ">

                        <button type="submit" class="btn btn-primary">
                            Iniciar Sesion
                        </button>
                    </div>

                </div>
                  </form>

            </div>
        </div>


    <script>
        function validation() {
            var id = document.f1.user.value;
            var ps = document.f1.pass.value;
            if (id.trim() === "" && ps.trim() === "") {
                alert("Username and Password fields are empty");
                return false;
            } else if (id.trim() === "") {
                alert("Username is empty");
                return false;
            } else if (ps.trim() === "") {
                alert("Password field is empty");
                return false;
            }
            return true;
        }

</html>

    @endsection
