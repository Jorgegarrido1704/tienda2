<nav class="nav nav-pills nav-fill">
    <a class="nav-link " id="spaceLine" aria-current="page" href="{{ route('home.index') }}">Home</a>
    <a class="nav-link " id="spaceLine" href="{{ route('venta.index') }}">Venta</a>
    <a class="nav-link " id="spaceLine" href="{{ route('venta.verVentas') }}">Clientes</a>
 <!--   <a class="nav-link " id="spaceLine" href="{{ route('abono.index') }}">Abonos</a> -->
    <a class="nav-link" id="spaceLine" href="{{ route('inventario.index') }}">Inventario</a>
    <a class="nav-link " id="spaceLine" href="{{ route('reportes.index') }}">Reportes</a>
    <a class="nav-link " id="spaceLine" href="{{ route('reportes.comisiones') }}">Comisiones</a>
   <!-- <a class="nav-link" id="spaceLine" href="#">Historico</a>-->
    <a class="nav-link " id="spaceLine" href="{{ route('logout') }}">Salir</a>
</nav>
