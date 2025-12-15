var dynamicContentCount = 0;


function generateDynamicContent(quantity) {
     const plazo = document.getElementById("plazo").value;
    if(plazo ==""){
        alert("Seleccione un plazo primero");
        return;
    }
    var dynamicContentContainer = document.getElementById(
        "dynamicContentContainer"
    );

    // Clear existing content
    dynamicContentContainer.innerHTML = "";

    // Generate new content based on quantity
    for (var i = 0; i < quantity; i++) {
        var dynamicContent = document.createElement("div");
        dynamicContent.className = "seg-oct";

        // 1. Generate the options HTML string first
const categoryOptions = categoriesData.map(cat =>
    `<option value="${cat.categoria}">${cat.categoria}</option>`
).join('');


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
                ${categoryOptions}  </select>
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
}

function cantidad() {
    var cant = document.getElementById("cantart").value;
    var plazo = document.getElementById("plazo").value;

    generateDynamicContent(cant);
    price(); // Calculate total price initially
}
async function fetchProducts(index) {
    const categorySelect = document.getElementById("categoria" + index);
    const productSelect = document.getElementById("articulo" + index);



    // 1. Validación: Si no existen los elementos, salir.
    if (!categorySelect || !productSelect) return;

    // 2. Obtener el valor de la categoría
    const category = categorySelect.value;

    // Si no hay categoría seleccionada, limpiar el artículo y salir
    if (!category) {
        productSelect.innerHTML = '<option value="">Select an Article</option>';
        return;
    }

    // 3. UX: Mostrar "Cargando..." y deshabilitar
    productSelect.innerHTML = '<option value="">Loading...</option>';
    productSelect.disabled = true;

   try {
        const category = encodeURIComponent(categorySelect.value);

        // Aquí usamos la variable que definimos en el Blade
        const url = `${ROUTES.fetchProducts}?category=${category}`;


        console.log("Intentando cargar:", url); // 1. Ver qué URL se está llamando

        const response = await fetch(url);

        // IMPRIMIR EL ESTATUS ANTES DE QUE TRUENE
        console.log("Estatus del servidor:", response.status);

        if (!response.ok) {
            // Si hay error, mostrar el texto del error (el HTML de Laravel)
            const errorText = await response.text();
            console.error("Error de Laravel:", errorText);
            throw new Error(`HTTP Error: ${response.status}`);
        }
        // ------------------------------------------------------------------------------

        const data = await response.json();

        // 4. Limpiar y llenar el select
        productSelect.innerHTML = '<option value="">Select an Article</option>';

        data.forEach(product => {
            const option = document.createElement("option");

            // Asegúrate de que 'product.product' es el nombre real de la columna en tu BD
            // Si tu columna se llama 'articulo', cambia esto a: product.articulo
            const productName = product.product;

            option.value = productName;
            option.text = productName;

            productSelect.appendChild(option);
        });

    } catch (error) {
        console.error("Error fetching products:", error);
        productSelect.innerHTML = '<option value="">Error loading data</option>';
    } finally {
        // 5. Reactivar el select
        productSelect.disabled = false;
    }
}

// 1. Esta función obtiene el precio INDIVIDUAL del servidor
async function price(index) {
    const articuloSelect = document.getElementById("articulo" + index);
    const cantidadInput = document.getElementById("cantidpro" + index);
    const plazoInput = document.getElementById("plazo"); // Asumo que es un campo general

    // Validaciones
    if (!articuloSelect.value || !cantidadInput.value) return;

    try {
        // Preparamos los datos
        const articulo = encodeURIComponent(articuloSelect.value);
        const plazo = encodeURIComponent(plazoInput.value);

        // Usamos la ruta definida en ROUTES (ver Paso 3)
        const url = `${ROUTE_getPrice}?articulo=${articulo}&plazo=${plazo}`;

        const response = await fetch(url);

        if (!response.ok) throw new Error("Error del servidor");

        const data = await response.json();

        // --- LÓGICA DE PRECIOS POR FILA ---
        let precioUnitario = 0;
        let pagoSemanalUnitario = 0;

        // Tu lógica original para decidir qué precio usar
        if (data.precio > 0) {
            precioUnitario = parseFloat(data.precio);
            pagoSemanalUnitario = parseFloat(data.semanal);
       }
        // Guardamos los valores unitarios en inputs ocultos (o atributos data) en esa fila
        // Si no tienes estos inputs ocultos, créalos dinámicamente o úsalos en el HTML
        let hiddenPrice = document.getElementById(`hidden_price_${index}`);
        let hiddenWeekly = document.getElementById(`hidden_weekly_${index}`);

        if (!hiddenPrice) {
            // Crear input oculto si no existe (opcional, mejor tenerlo en el HTML)
            console.error("Falta input hidden para precio en fila " + index);
            return;
        }

        hiddenPrice.value = precioUnitario;
        hiddenWeekly.value = pagoSemanalUnitario;
        alert("El precio unitario es: " + precioUnitario);
        alert("El pago semanal es: " + pagoSemanalUnitario);

        // 2. Una vez que tenemos el precio de ESTA fila, recalculamos el total general
        calculateGrandTotal();

    } catch (error) {
        console.error("Error obteniendo precio:", error);
        alert("Error obteniendo precio");
    }
}

// 3. Esta función SUMA todo lo que hay en pantalla (síncrona, instantánea)
function calculateGrandTotal() {
    let totalContado = 0;
    let totalSemanal = 0;

    for (let i = 0; i < dynamicContentCount; i++) {
        // Aseguramos obtener los elementos
        const cantidadEl = document.getElementById("cantidpro" + i);
        const precioEl = document.getElementById("hidden_price_" + i); // Input oculto con precio unitario
        const semanalEl = document.getElementById("hidden_weekly_" + i); // Input oculto con pago semanal

        // Validamos que existan y tengan valor numérico
        if (cantidadEl && precioEl && cantidadEl.value && precioEl.value) {
            const cant = parseFloat(cantidadEl.value) || 0;
            const precio = parseFloat(precioEl.value) || 0;
            const semanal = parseFloat(semanalEl.value) || 0;

            totalContado += ( precio);
            totalSemanal += ( semanal);
        }
    }

    // --- CORRECCIÓN 1: Usar .value en lugar de .innerText ---

    // 1. Mostrar Subtotal (Input visible)
    document.getElementById("prec").value = totalContado.toFixed(2);

    // 2. Mostrar Pago Semanal (Si tienes un elemento visual para esto)
    const formaVisual = document.getElementById("forma");
    if(formaVisual) {
         // Si 'forma' es un div/span/label usa innerText. Si es input, usa value.
         formaVisual.value = totalSemanal.toFixed(2);
    }

    // 3. Guardar en los Inputs Ocultos (para enviar al backend)
    document.getElementById("pre").value = totalContado; // Hidden Total
    document.getElementById("fo").value = totalSemanal;  // Hidden Semanal

    // --- CORRECCIÓN 2: Calcular el Saldo final restando el enganche ---
    calcularSaldoFinal();
}


function enganche() {
    calcularSaldoFinal();
}

function calcularSaldoFinal() {
    // 1. Obtener el Total acumulado (del input hidden o del visible)
    const total = parseFloat(document.getElementById("pre").value) || 0;

    // 2. Obtener el Enganche introducido por el usuario
    const engancheInput = document.getElementById("eng");
    const enganche = parseFloat(engancheInput.value) || 0;

    // 3. Calcular Saldo (Total - Enganche)
    const saldo = total - enganche;

    // 4. Actualizar Inputs Visibles y Ocultos
    // Nota: El saldo no debería ser negativo
    const saldoFinal = saldo < 0 ? 0 : saldo;

    document.getElementById("sald").value = saldoFinal.toFixed(2); // Input visible
    document.getElementById("sa").value = saldoFinal; // Input hidden
}
