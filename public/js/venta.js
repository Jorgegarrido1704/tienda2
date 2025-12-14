let dynamicContentCount = 0;

function cantidad() {
    const cant = document.getElementById("cantart").value;
    generateDynamicContent(cant);
}

function generateDynamicContent(quantity) {
    const container = document.getElementById("dynamicContentContainer");
    container.innerHTML = "";
    dynamicContentCount = quantity;

    for (let i = 0; i < quantity; i++) {
        container.insertAdjacentHTML("beforeend", `
            <div class="row mb-3">
                <div class="col-md-2">
                    <label>Cantidad</label>
                    <input type="number" name="cantidpro[]" id="cantidpro${i}" class="form-control" value="1" min="1" max="1">
                </div>

                <div class="col-md-4">
                    <label>Categoría</label>
                    <select name="categoria[]" id="categoria${i}" class="form-control" onchange="fetchProducts(${i})">
                        <option value=""></option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Artículo</label>
                    <select name="articulo[]" id="articulo${i}" class="form-control" onchange="price()">
                        <option value=""></option>
                    </select>
                </div>
            </div>
        `);

        loadCategorias(i);
    }
}

/* CARGAR CATEGORÍAS */
function loadCategorias(index) {
    fetch('/categorias')
        .then(res => res.json())
        .then(data => {
            const select = document.getElementById(`categoria${index}`);
            data.forEach(cat => {
                select.insertAdjacentHTML(
                    "beforeend",
                    `<option value="${cat.category}">${cat.category}</option>`
                );
            });
        });
}

/* CARGAR ARTÍCULOS */
function fetchProducts(index) {
    const categoria = document.getElementById(`categoria${index}`).value;
    const articuloSelect = document.getElementById(`articulo${index}`);
    articuloSelect.innerHTML = `<option value=""></option>`;

    if (!categoria) return;

    fetch(`/productos/${categoria}`)
        .then(res => res.json())
        .then(data => {
            data.forEach(p => {
                articuloSelect.insertAdjacentHTML(
                    "beforeend",
                    `<option value="${p.product}">${p.product}</option>`
                );
            });
        });
}

/* CALCULAR PRECIOS */
function price() {
    let total = 0;
    let semanal = 0;
    const plazo = document.getElementById("plazo").value;

    for (let i = 0; i < dynamicContentCount; i++) {
        const articulo = document.getElementById(`articulo${i}`).value;
        const cantidad = document.getElementById(`cantidpro${i}`).value;

        if (!articulo) continue;

        fetch(`/precio?articulo=${articulo}&plazo=${plazo}`)
            .then(res => res.json())
            .then(data => {
                let subtotal = 0;

                if (plazo > 0) {
                    subtotal = data.precio * cantidad;
                    semanal += data.semana * cantidad;
                } else {
                    subtotal = data.contado * cantidad;
                }

                total += subtotal;

                document.getElementById("prec").value = total;
                document.getElementById("forma").value = semanal;
                document.getElementById("sald").value = total;

                document.getElementById("pre").value = total;
                document.getElementById("sa").value = total;
                document.getElementById("fo").value = semanal;
            });
    }
}

/* ENGANCHE */
function enganche() {
    const subtotal = parseFloat(document.getElementById("prec").value || 0);
    let eng = parseFloat(document.getElementById("eng").value || 0);

    if (eng < 0) eng = 0;
    if (eng > subtotal) eng = subtotal;

    const saldo = subtotal - eng;

    document.getElementById("sald").value = saldo;
    document.getElementById("sa").value = saldo;
}
