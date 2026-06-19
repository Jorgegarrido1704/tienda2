var dynamicContentCount = 0;

function generateDynamicContent(quantity, savedArticles = []) {
    const plazo = document.getElementById("plazo").value;
    if (plazo == "") {
        alert("Seleccione un plazo primero");
        return;
    }

    var dynamicContentContainer = document.getElementById("dynamicContentContainer");
    dynamicContentContainer.innerHTML = "";

    const categoryOptions = categoriesData.map(cat =>
        `<option value="${cat.categoria}">${cat.categoria}</option>`
    ).join('');

    for (var i = 0; i < quantity; i++) {
        var dynamicContent = document.createElement("div");
        dynamicContent.className = "seg-oct";

        dynamicContent.insertAdjacentHTML('beforeend', `
            <div class="row g-3 align-items-end mb-3 border-bottom pb-3">
                <div class="col-md-2">
                    <label for="cantidpro${i}" class="form-label fw-bold">Cantidad</label>
                    <input type="number"
                        class="form-control"
                        name="cantidpro[]"
                        id="cantidpro${i}"
                        min="1"
                        max="1"
                        value="1"
                        required>
                </div>

                <div class="col-md-5">
                    <label for="categoria${i}" class="form-label fw-bold">Categoría</label>
                    <select class="form-select"
                            name="categoria[]"
                            id="categoria${i}"
                            onchange="fetchProducts(${i});"
                            required>
                        <option value="" selected disabled>Seleccione una categoría...</option>
                        ${categoryOptions}
                    </select>
                </div>

                <div class="col-md-5">
                    <label for="articulo${i}" class="form-label fw-bold">Artículo</label>
                    <select class="form-select"
                            name="articulo[]"
                            id="articulo${i}"
                            onchange="price(${i});">
                        <option value="">Esperando categoría...</option>
                    </select>
                </div>

                <input type="hidden" id="hidden_price_${i}" value="0">
                <input type="hidden" id="hidden_weekly_${i}" value="0">
            </div>
        `);

        dynamicContentContainer.appendChild(dynamicContent);
    }

    dynamicContentCount = quantity;

    // Prefill rows that have a previously saved article (modo edición)
    for (var i = 0; i < quantity; i++) {
        if (savedArticles[i]) {
            prefillRow(i, savedArticles[i]);
        }
    }
}

function cantidad() {
    var cant = document.getElementById("cantart").value;
    var saved = (typeof articulosGuardados !== 'undefined') ? articulosGuardados : [];
    generateDynamicContent(cant, saved);
}

// Busca la categoría del artículo guardado, la selecciona, carga
// la lista de productos de esa categoría, selecciona el artículo
// guardado y calcula su precio.
async function prefillRow(index, articuloName) {
    try {
        const catUrl = `${ROUTES.getArticleCategory}?articulo=${encodeURIComponent(articuloName)}`;
        const catResp = await fetch(catUrl);

        if (!catResp.ok) {
            console.error("No se encontró categoría para", articuloName);
            return;
        }

        const catData = await catResp.json();
        const categorySelect = document.getElementById("categoria" + index);
        categorySelect.value = catData.categoria;

        await fetchProducts(index);

        const articuloSelect = document.getElementById("articulo" + index);
        articuloSelect.value = articuloName;

        await price(index);
    } catch (error) {
        console.error("Error prefilling row " + index, error);
    }
}

async function fetchProducts(index) {
    const categorySelect = document.getElementById("categoria" + index);
    const productSelect = document.getElementById("articulo" + index);

    if (!categorySelect || !productSelect) return;

    const category = categorySelect.value;

    if (!category) {
        productSelect.innerHTML = '<option value="">Select an Article</option>';
        return;
    }

    productSelect.innerHTML = '<option value="">Loading...</option>';
    productSelect.disabled = true;

    try {
        const url = `${ROUTES.fetchProducts}?category=${encodeURIComponent(category)}`;
        const response = await fetch(url);

        if (!response.ok) {
            const errorText = await response.text();
            console.error("Error de Laravel:", errorText);
            throw new Error(`HTTP Error: ${response.status}`);
        }

        const data = await response.json();

        productSelect.innerHTML = '<option value="">Select an Article</option>';

        data.forEach(product => {
            const option = document.createElement("option");
            option.value = product.product;
            option.text = product.product;
            productSelect.appendChild(option);
        });

    } catch (error) {
        console.error("Error fetching products:", error);
        productSelect.innerHTML = '<option value="">Error loading data</option>';
    } finally {
        productSelect.disabled = false;
    }
}

async function price(index) {
    const articuloSelect = document.getElementById("articulo" + index);
    const cantidadInput = document.getElementById("cantidpro" + index);
    const plazoInput = document.getElementById("plazo");

    if (!articuloSelect.value || !cantidadInput.value) return;

    try {
        const articulo = encodeURIComponent(articuloSelect.value);
        const plazo = encodeURIComponent(plazoInput.value);
        const url = `${ROUTE_getPrice}?articulo=${articulo}&plazo=${plazo}`;

        const response = await fetch(url);
        if (!response.ok) throw new Error("Error del servidor");

        const data = await response.json();

        let precioUnitario = 0;
        let pagoSemanalUnitario = 0;

        if (data.precio > 0) {
            precioUnitario = parseFloat(data.precio);
            pagoSemanalUnitario = parseFloat(data.semanal);
        }

        let hiddenPrice = document.getElementById(`hidden_price_${index}`);
        let hiddenWeekly = document.getElementById(`hidden_weekly_${index}`);

        if (!hiddenPrice) {
            console.error("Falta input hidden para precio en fila " + index);
            return;
        }

        hiddenPrice.value = precioUnitario;
        hiddenWeekly.value = pagoSemanalUnitario;

        calculateGrandTotal();

    } catch (error) {
        console.error("Error obteniendo precio:", error);
    }
}

function calculateGrandTotal() {
    let totalContado = 0;
    let totalSemanal = 0;

    for (let i = 0; i < dynamicContentCount; i++) {
        const cantidadEl = document.getElementById("cantidpro" + i);
        const precioEl = document.getElementById("hidden_price_" + i);
        const semanalEl = document.getElementById("hidden_weekly_" + i);

        if (cantidadEl && precioEl && cantidadEl.value && precioEl.value) {
            const precio = parseFloat(precioEl.value) || 0;
            const semanal = parseFloat(semanalEl.value) || 0;

            totalContado += precio;
            totalSemanal += semanal;
        }
    }

    document.getElementById("prec").value = totalContado.toFixed(2);

    const formaVisual = document.getElementById("forma");
    if (formaVisual) {
        formaVisual.value = totalSemanal.toFixed(2);
    }

    document.getElementById("pre").value = totalContado;
    document.getElementById("fo").value = totalSemanal;

    calcularSaldoFinal();
}

function calcularSaldoFinal() {
    const total = parseFloat(document.getElementById("pre").value) || 0;
    const engancheInput = document.getElementById("eng");
    const enganche = parseFloat(engancheInput.value) || 0;

    const saldo = total - enganche;
    const saldoFinal = saldo < 0 ? 0 : saldo;

    document.getElementById("sald").value = saldoFinal.toFixed(2);
    document.getElementById("sa").value = saldoFinal;

    let cantiArt = document.getElementById("cantart").value;
    let articulosConcatenados = "";

    for (let i = 0; i < cantiArt; i++) {
        let articuloSelect = document.getElementById("articulo" + i);
        if (!articuloSelect || !articuloSelect.value) {
            continue;
        }
        articulosConcatenados += (articulosConcatenados ? ", " : "") + articuloSelect.value;
    }

    document.getElementById("arts").value = articulosConcatenados;
}
