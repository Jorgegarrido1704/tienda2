
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="REFRESH" content="3;url={{ route('home.index') }}">

 <style>


    body {
        margin: 0.5in; /* Ajusta el espacio alrededor del contenido */
    }

    .head, .datos  {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 10px; /* Ajusta el espacio entre bloques */
        font-size: x-large;
    }

    .head h1, .datos h1, .datos-linea h1 {
        margin-right: 20px; /* Ajusta el margen entre los elementos */
    }


    .datos div {
        width: 48%; /* Ancho del 48% para que haya dos divs en una fila */
        box-sizing: border-box; /* Incluye el relleno y el borde en el ancho total */
        margin-bottom: 10px; /* Ajusta el espacio entre divs */
        font-size: x-large;
    }
    .datos-linea {
        display: flex;
        flex-direction: row; /* Alinea los elementos en una fila */
        align-items: center; /* Alinea los elementos verticalmente al centro */
        margin-bottom: 10px; /* Ajusta el espacio entre elementos */
        font-size: x-large;
    }
    table {
        width: 100%;
        background-color: lightyellow;
        border: solid 1px #000;
        page-break-inside: avoid; /* Evitar saltos de página dentro de la tabla */
    }

    th .art, tr .art, td .art {
        text-align: center;
        border: 1px solid #000;
        height: 30px;
    }
    th .cob, tr .cob, td .cob {
        text-align: center;
        border: 1px solid #000;
        height: 70px;
    }



 </style>
    <title>Impresion de venta</title>
</head>
<body>

<div class="head">
    <h1>Fecha: {{ $venta['date'] ?? 'N/A' }}</h1>
    <h1>FORMA DE PAGO: $</h1>
    <h1>Plazo:  {{ $venta['plazo'] ?? 1 }} Meses</h1>
    <h1>Ruta:  {{ $venta['ruta'] ?? 'N/A' }}</h1>
    <h1>Cuenta:  {{ $venta['cuenta'] ?? 'N/A' }}</h1>
</div>

<div class="datos">
    <div>
        <h1>Cliente:  {{ $venta['cliente'] ?? 'N/A' }}</h1>
                <h1>Domicilio:  {{ $venta['domcli'] ?? 'N/A' }}</h1>
    </div>

    <div>
       <h1>Aval:  {{ $venta['aval'] ?? 'N/A' }}</h1>
        <h1>Domicilio Aval:  {{ $venta['domav'] ?? 'N/A' }}</h1>
    </div>

    <div>
        <h1>Colonia:  {{ $venta['col'] ?? 'N/A' }}</h1>
       <h1>Ref 1:  {{ $venta['ref1'] ?? 'N/A' }}</h1>
          </div>
    <div>
       <h1>Esposo(a):  {{ $venta['espo'] ?? 'N/A' }}</h1>
        <h1>Domicilio Ref 1:  {{ $venta['domref1'] ?? 'N/A' }}</h1>
    </div>
    <div>
        <h1>Ref 2:  {{ $venta['ref2'] ?? 'N/A' }}</h1></div><div>
       <h1>Domicilio Ref 2:  {{ $venta['domref2'] ?? 'N/A' }}</h1>
    </div></div>
    <div class="datos-linea">
            <div><h1>Promotor:  {{ $venta['promotor'] ?? 'N/A' }}</h1></div>
            <div><h1>Vendedor:  {{ $venta['vendedor'] ?? 'N/A' }}</h1></div>
            <div><h1>Cobrador:  {{ $venta['cobrador'] ?? 'N/A' }}</h1></div>
    </div>
    <div>

            <table class="art">
                <thead>
                    <th class="art"><h1>Cantidad</h1></th>
                    <th class="art"><h1>Articulo</h1></th>
                    <th class="art"><h1>Precio</h1></th>
                </thead>

        <tbody>

                @php
                if(isset($venta['arts']) && strpos($venta['arts'], ',') !== false){
                    $articulos = explode(',', $venta['arts']);
                    
                    array_unshift($articulos, '');
                } else {
                    $articulos = ['',$venta['arts']];
                }


                @endphp

                @for($i = 1; $i < count($articulos); $i++)
                    <tr class="art">
                        <td class="art"><h1>1</h1></td>
                        <td class="art"><h1>{{ $articulos[$i] ?? 'N/A' }}</h1></td>
                        <td class="art"><h1>{{ intval($venta['pre']/(count($articulos))) ?? 1 }}</h1></td>
                    </tr>
                @endfor



            </tbody>
            </table>


    </div>
    <div class="datos">
    <h1>Total:$   {{ $venta['pre'] ?? 'N/A' }}</h1>
    <h1>Enganceh:$  {{ $venta['eng'] ?? 'N/A' }}</h1>
    <h1>Saldo:$  {{ $venta['sa'] ?? 'N/A' }}</h1>
    <h1>Fecha de vencimiento:  {{ date("Y-m-d", strtotime($venta['date'] . ' + ' . $venta['plazo'] . ' months')) ?? 'N/A' }}</h1>
    <table>
        <thead>
        <th class="cob"><h2>Fecha</h2></th>
        <th class="cob"><h2>Abono</h2></th>
        <th class="cob"><h2>Saldo</h2></th>
        <th class="cob"><h2>REC. NO.</h2></th>
        <th class="cob"><h2>Fecha</h2></th>
        <th class="cob"><h2>Abono</h2></th>
        <th class="cob"><h2>Saldo</h2></th>
        <th class="cob"><h2>REC. NO.</h2></th>
        </thead>
        <tbody>


            @for($i=0;$i<3;$i++)
            <tr class="cob"><td class="cob"></td> <td class="cob"></td> <td class="cob"></td>
            <td class="cob"></td> <td class="cob"></td><td class="cob"></td> <td class="cob"></td>
            <td class="cob"></td> </tr>
            @endfor

        </tbody>
    </table>
</div>

    <table>
        <thead>
        <th class="cob"><h1>Fecha</h1></th>
        <th class="cob"><h1>Abono</h1></th>
        <th class="cob"><h1>Saldo</h1></th>
        <th class="cob"><h1>REC. NO.</h1></th>
        <th class="cob"><h1>Fecha</h1></th>
        <th class="cob"><h1>Abono</h1></th>
        <th class="cob"><h1>Saldo</h1></th>
        <th class="cob"><h1>REC. NO.</h1></th>
        </thead>
        <tbody>


            @for($i=0;$i<21;$i++)
            <tr class="cob"><td class="cob"></td> <td class="cob"></td> <td class="cob"></td>
            <td class="cob"></td> <td class="cob"></td><td class="cob"></td> <td class="cob"></td>
            <td class="cob"></td> </tr>
            @endfor
        </tbody>
    </table>
    </body>
</html>

<script>
        // JavaScript function to handle printing when the page loads
        window.onload = function() {
            window.print(); // This opens the print dialog when the page loads
        };
    </script>
