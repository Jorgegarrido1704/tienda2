function verProductos(){
    var codigo = document.getElementById("codigo").value;
    var dynamicContentContainer = document.getElementById("productos");
    dynamicContentContainer.innerHTML = "Cargando...";
     const url = `${productos.productos}?categoria=${codigo}`;
    fetch(url)
    .then(response => response.json())
    .then(data => {
        dynamicContentContainer.innerHTML = `
        <select name="articulo" id="articulo" class="form-control">
            <option value="">Select an Article</option>
            ${data.map(product => `<option value="${product.articulo}">${product.articulo}</option>`).join('')}
        </select>
        `;
    })
    .catch(error => {
        console.error('Error fetching dynamic content:', error);
    });



}
