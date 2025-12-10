var dynamicContentCount = 0;

function generateDynamicContent(quantity) {
    var dynamicContentContainer = document.getElementById(
        "dynamicContentContainer"
    );

    // Clear existing content
    dynamicContentContainer.innerHTML = "";

    // Generate new content based on quantity
    for (var i = 0; i < quantity; i++) {
        var dynamicContent = document.createElement("div");
        dynamicContent.className = "seg-oct";

        dynamicContent.innerHTML = `
            <h2>
                <label for="cantidpro" id="art">Cantidad</label>
                <input type="number" name="cantidpro[]" id="cantidpro${i}"  min="1" max="1" required>


                <label for="categoria" id="art">Categoria</label>
                <select name="categoria[]" id="categoria${i}" onchange="fetchProducts(${i});">
                    <option value=""></option>
                    <?php
                        $qry=mysqli_query($con,"SELECT DISTINCT category FROM inventario");
                        while($rowcat=mysqli_fetch_array($qry)){
                            $category=$rowcat['category'];
                            echo "<option value='".$category."'>".$category."</option>";
                        }
                    ?>
                </select>

                <label for="articulo" id="art">Articulo</label>
                <select name="articulo[] " id="articulo${i}" onchange="price(${i});"></select>

                <!-- Adding an input for the price -->
                <input type="hidden" id="precio${i}" value="0">
            </h2>
        `;

        dynamicContentContainer.appendChild(dynamicContent);
    }
    dynamicContentCount = quantity;
}

function cantidad() {
    var cant = document.getElementById("cantart").value;
    var plazo = document.getElementById("plazo").value;

    generateDynamicContent(cant);
    price(); // Calculate total price initially
}

function fetchProducts(index) {
    var categorySelect = document.getElementById("categoria" + index);
    var productSelect = document.getElementById("articulo" + index);

    // Clear existing options
    productSelect.innerHTML = '<option value=""></option>';

    // Fetch products based on the selected category
    if (categorySelect.value !== "") {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);

                for (var i = 0; i < response.length; i++) {
                    var product = response[i];
                    var option = document.createElement("option");
                    option.value = product.product;
                    option.text = product.product;
                    productSelect.appendChild(option);
                }
            }
        };

        xhttp.open(
            "GET",
            "get_products.php?category=" + categorySelect.value,
            true
        );
        xhttp.send();
    }
}

function price(index) {
    var total = 0;
    var totals = 0;

    for (var i = 0; i < dynamicContentCount; i++) {
        // Fetch additional data based on selected options
        var plazo = document.getElementById("plazo").value;
        var cant = document.getElementById("cantidpro" + i).value;
        var articulo = document.getElementById("articulo" + i).value;

        console.log("plazo:", plazo);
        console.log("cant:", cant);
        console.log("articulo:", articulo);

        if (cant !== "" && articulo !== "") {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    console.log(response);
                    // Actualiza el campo de precio con el valor devuelto por el servidor
                    if (response.precio > 0) {
                        var precioPorCantidad = response.precio * cant;
                        var semanales = response.semana * cant;
                    } else {
                        var precioPorCantidad = response.contado * cant;
                        var semanales = 0;
                    }
                    document.getElementById("prec").innerText =
                        precioPorCantidad;

                    // Add the price to the total
                    total += precioPorCantidad;
                    totals += semanales;
                    // Update the total price after processing each article
                    document.getElementById("prec").innerText = total;
                    document.getElementById("forma").innerText = totals;
                    document.getElementById("sald").innerText = total;

                    document.getElementById("pre").value = total;
                    document.getElementById("sa").value = total;
                    document.getElementById("fo").value = totals;
                }
            };

            // Ajusta la URL según tu estructura de URL
            xhttp.open(
                "GET",
                "get_price.php?articulo=" + articulo + "&plazo=" + plazo,
                true
            );
            xhttp.send();
        }
    }

    // Log information to the console
    console.log("Total price:", total);
    console.log("Total sem:", totals);
}

function enganche() {
    var precio = document.getElementById("prec").innerText;
    var enganche = document.getElementById("eng").value;

    if (enganche < 0) {
        alert("El enganche no puede ser menor a 0 ");
        document.getElementById("eng").value = 0;
        document.getElementById("sald").innerText = precio;
    } else if (precio > 0 && enganche >= 0) {
        var resto = precio - enganche;

        document.getElementById("sa").value = resto;
        document.getElementById("fo").value =
            document.getElementById("forma").innerText;
        document.getElementById("sald").innerText = resto;
    }
}
