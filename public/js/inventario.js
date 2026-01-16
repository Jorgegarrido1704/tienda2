function verProductos(){
    var codigo = document.getElementById("codigo").value;
    var dynamicContentContainer = document.getElementById("productos");
    dynamicContentContainer.innerHTML = "Cargando...";
     const url = `${ROUTES.productos}?categoria=${codigo}`;
    fetch(url)
    .then(response => response.json())
    .then(data => {

        console.log(data);
        dynamicContentContainer.innerHTML="";
        dynamicContentContainer.innerHTML=`<table class="table table-responsive"><theader>
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
        </tr><tbody>
        `;


    })
    .catch(error => {
        console.error('Error fetching dynamic content:', error);
    });



}
