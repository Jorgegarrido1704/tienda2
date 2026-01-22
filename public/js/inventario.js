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
