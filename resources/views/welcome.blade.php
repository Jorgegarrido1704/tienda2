<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Muebleria la espanola</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
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
        <div class="col-md-6 item-center text-center" id="login">
            <div class="card px-4 py-4">
                <div class="col-md-12 text-center  ">
                     <h1>Mueblria la espanola </h1>
                </div>
                  <form name="f1" action="{{ route('login.login') }}" onsubmit="return validation()" method="POST">
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
</body>
</html>


