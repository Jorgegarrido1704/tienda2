function verProductos() {

    var codigo = document.getElementById("codigo").value;
    var dynamicContentContainer = document.getElementById("productos");
    dynamicContentContainer.innerHTML = "Cargando...";
    const url = `${ROUTES.productos}?categoria=${codigo}`;
    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            dynamicContentContainer.innerHTML = "";
            dynamicContentContainer.innerHTML = `<table class="table table-responsive"><theader>
        <tr><th>Producto</th>
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
        </tr><tbody>
      ${data.map(producto => {
    const infoUrl = rutaInfoProducto.replace(':id', producto.id);
    const updateUrl = rutaActualizarProducto.replace(':id', producto.id);

    return `
    <tr>
        <td>${producto.product}</td>
        <td>${producto.qty}</td>
        <td>${producto.CONTADO}</td>
        <td>${producto.precio1}</td>
        <td>${producto.precio2}</td>
        <td>${producto.precio3}</td>
        <td>${producto.precio4}</td>
        <td>${producto.precio5}</td>
        <td>${producto.precio6}</td>
        <td>${producto.precio7}</td>
        <td>${producto.precio8}</td>
        <td>${producto.precio9}</td>
        <td>${producto.precio10}</td>
        <td>${producto.precio11}</td>
        <td>${producto.precio12}</td>
        <td>
            <a class="btn" href="${infoUrl}">
                Información de producto y cambio de precio
            </a>
        </td>
    </tr>
    <tr>
        <td></td><td></td><td>Semanal</td>
        <td>${producto.semanal1}</td>
        <td>${producto.semanal2}</td>
        <td>${producto.semanal3}</td>
        <td>${producto.semanal4}</td>
        <td>${producto.semanal5}</td>
        <td>${producto.semanal6}</td>
        <td>${producto.semanal7}</td>
        <td>${producto.semanal8}</td>
        <td>${producto.semanal9}</td>
        <td>${producto.semanal10}</td>
        <td>${producto.semanal11}</td>
        <td>${producto.semanal12}</td>
        <td>

        </td>
    </tr>`;
}).join('')}
        </tbody></table>
        `;
        })
        .catch((error) => {
            console.error("Error fetching dynamic content:", error);
        });
}
   function setCategoria(valor) {

    var categoria = valor.substring(0, 3);
    document.getElementById("categoria").value = categoria;
    console.log(valor);
}

function mostarFormularioNuevoProducto() {
    var formulario = document.getElementById("nuevoProducto");
    if (formulario.style.display === "none") {
        formulario.style.display = "block";
    } else {
        formulario.style.display = "none";
    }
}
function setPrecio(valor) {
    var contado = parseInt(valor);
   var precio1 = Math.round(contado * 1.05);
   var semanal1 = Math.round(precio1 / 4);
   document.getElementById("precio1").value = precio1;
   document.getElementById("semanal1").value = semanal1;
   var precio2 = Math.round(precio1 * 1.05);
   var semanal2 = Math.round(precio2 / 8);
    document.getElementById("precio2").value = precio2;
    document.getElementById("semanal2").value = semanal2;
    var precio3 = Math.round(precio2 * 1.05);
    var semanal3 = Math.round(precio3 / 12);
    document.getElementById("semanal3").value = semanal3;
    document.getElementById("precio3").value = precio3;
    var precio4 = Math.round(precio3 * 1.05);
    var semanal4 = Math.round(precio4 / 16);
    document.getElementById("semanal4").value = semanal4;
    document.getElementById("precio4").value = precio4;
    var precio5 = Math.round(precio4 * 1.05);
    var semanal5 = Math.round(precio5 / 20);
    document.getElementById("semanal5").value = semanal5;
    document.getElementById("precio5").value = precio5;
    var precio6 = Math.round(precio5 * 1.05);
    var semanal6 = Math.round(precio6 / 24);
    document.getElementById("semanal6").value = semanal6;
    document.getElementById("precio6").value = precio6;
    var precio7 = Math.round(precio6 * 1.05);
    var semanal7 = Math.round(precio7 / 28);
    document.getElementById("semanal7").value = semanal7;
    document.getElementById("precio7").value = precio7;
    var precio8 = Math.round(precio7 * 1.05);
    var semanal8 = Math.round(precio8 / 32);
    document.getElementById("semanal8").value = semanal8;
    document.getElementById("precio8").value = precio8;
    var precio9 = Math.round(precio8 * 1.05);
    var semanal9 = Math.round(precio9 / 36);
    document.getElementById("semanal9").value = semanal9;
    document.getElementById("precio9").value = precio9;
    var precio10 = Math.round(precio9 * 1.05);
    var semanal10 = Math.round(precio10 / 40);
    document.getElementById("semanal10").value = semanal10;
    document.getElementById("precio10").value = precio10;
    var precio11 = Math.round(precio10 * 1.05);
    var semanal11 = Math.round(precio11 / 44);
    document.getElementById("semanal11").value = semanal11;
    document.getElementById("precio11").value = precio11;
    var precio12 = Math.round(precio11 * 1.05);
    var semanal12 = Math.round(precio12 / 48);
    document.getElementById("semanal12").value = semanal12;
    document.getElementById("precio12").value = precio12;
}
