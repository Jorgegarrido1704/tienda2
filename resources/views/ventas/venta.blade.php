@extends('layouts.main')

@section('content')
    <script src="{{ asset('js/venta.js') }}"></script>

    <form action="punto.php" method="POST" id="form">
    <div>
        <div align="center"> <h1>Nota de Venta</h1></div>

     <div class="prim"> <h2>  <label for="date" id="dat">Fecha</label><input type="date" name="date" id="date" required>
     <label for="forma" id="form">Forma de pago $</label><span name="forma" id="forma"></span>
     <label for="plazo" id="pla">Plazo a meses </label><select name="plazo" id="plazo" required>
        <option value=""></option>
        <option value="0">Contado</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
     </select>
     <label for="ruta" id="rut">Ruta</label><input type="number" name="ruta" id="ruta"  min="0" required>
     <label for="cuenta" id="cuen">No° Cuenta</label><input type="number" name="cuenta" id="cuenta" min="0" value='0'></h2>
    </div>
        <div class="segunda">
        <div class="seg-prim">
    <h1>        <label for="cliente" id="clie">Cliente</label><input type="text" name="cliente" id="cliente" required>
     <label for="aval" id="ava">Aval</label><input type="text" name="aval" id="aval"></h1>
        </div>
        <div class="seg-seg">
    <h1>        <label for="domcli" id="domc">Domicilio Cliente</label><input type="text" name="domcli" id="domcli" required >
    <label for="domav" id="doma">Domicilio Avala</label><input type="text" name="domav" id="domav" ></h1>
        </div>
        <div class="seg-terc">
    <h1>        <label for="col" id="colonia">Colonia</label><input type="text" name="col" id="col" required >
    <label for="espo" id="esp">Familiar</label><input type="text" name="espo" id="espo" > </h1>
        </div>

        <div class="seg-sex">
    <h1>   <label for="ref1" id="r1">Ref 1</label><input type="text" name="ref1" id="ref1" >
    <label for="domref1" id="r2">Domicilio Ref 1</label><input type="text" name="domref1" id="domref1" ></h1>
        </div>
        <div class="seg-cuart">
    <h1>     <label for="ref2" id="re2">Ref 2</label><input type="text" name="ref2" id="ref2">
     <label for="domref" id="dref">Domicilio Ref 2</label><input type="text" name="domref" id="domref"></h1>
        </div>
        <div class="seg-quin">
    <h1>        <label for="promotor" id="trab">PROMOTOR</label><select name="promotor" id="promotor" required>
        <option value=""></option>
        <?php
        $cobrador=mysqli_query($con,"SELECT nombre FROM personal WHERE puesto='PROMOTOR'");
        while($row=mysqli_fetch_array($cobrador)){
            $cob=$row['nombre'];
        ?>
        <option value="<?php echo $cob;  ?>"><?php echo $cob;  ?></option>
        <?php } ?>
    </select>
     <label for="vendedor" id="vend">Vendedor</label><select type="text" name="vendedor" id="vendedor" required>
<option value=""></option>
<?php
        $cobrador=mysqli_query($con,"SELECT nombre FROM personal WHERE puesto='VENDEDOR'");
        while($row=mysqli_fetch_array($cobrador)){
            $cob=$row['nombre'];
        ?>
        <option value="<?php echo $cob;  ?>"><?php echo $cob;  ?></option>
        <?php } ?>
</select>
     </h1>
        </div>

        <div class="seg-sep">
    <h2>   <label for="cobrador" id="sep">Cobrador</label><select type="text" name="cobrador" id="cobrador" required>
        <option value=""></option>
        <?php
        $cobrador=mysqli_query($con,"SELECT nombre FROM personal WHERE puesto='COBRADOR'");
        while($row=mysqli_fetch_array($cobrador)){
            $cob=$row['nombre'];
        ?>
        <option value="<?php echo $cob;  ?>"><?php echo $cob;  ?></option>
        <?php } ?>
        </select>
     <label for="cantart">Cantidad de articulos</label> <input type="number" name="cantart" id="cantart"  min="0" required onchange="return cantidad()">
    </h2>   </div>

<div class="container" id="dynamicContentContainer">
    <!-- Dynamic content will be inserted here -->
</div>
<div id="precContainer">
    <label for="prec" id="preci">SUBTOTAL $</label>
    <span name="prec" id="prec">0</span>
</div>

<!-- Additional div tag was missing here -->

<div class="tercero">
    <h1>
        <label for="eng" id="enga">ENGANCHE $</label>
        <input type="number" name="eng" id="eng" value="0"  onchange="return enganche()">
        <label for="sald" id="sal">SALDO $</label>
        <span name="sald" id="sald"></span>
    </h1>
</div>
<br>
<div class="btn-sub">
    <input type="hidden" name="pre" id="pre" value="">
    <input type="hidden" name="sa" id="sa" value="">
    <input type="hidden" name="fo" id="fo" value="">
    <input type="submit" name="enviar" id="enviar" value="Guardar">
</div>

    </div>
    </form>

@endsection
