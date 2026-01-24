function informacionClientes(idVenta) {
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const cliente = document.getElementById('cliente').value;
    const numCuenta = document.getElementById('numCuenta').value;
    //clean dataInHtml tbody
    const dataInHtml = document.getElementById('informacionClientes');

    const url = `${ROUTES.verVentas}?cliente=${cliente}&numCuenta=${numCuenta}`;
    fetch(url, {
       method: 'GET',
       headers: {
           'Content-Type': 'application/json',
           'X-CSRF-TOKEN': CSRF_TOKEN
       }

   })
   .then(response => response.json())
   .then(data => {
       console.log(data);


       dataInHtml.innerHTML.value = "";
       dataInHtml.innerHTML = `
         <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>Numero de Cuenta</th>
                        <th>Cliente</th>
                        <th>Saldo</th>
                        <th>Fecha Ultimo Abono</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="informacionClientes">
                    ${data.map(cliente => {
                         const abono = ROUTES.abonos.replace('__cuenta__', cliente.cuenta);
                         const imprimir = ROUTES.imprimirCliente.replace('__cuenta__', cliente.cuenta);
                         const editar = ROUTES.editarCliente.replace('__cuenta__', cliente.cuenta);
                        return `
                           <tr>
                            <td><button type="button" class="btn btn-primary"><a class="btn btn-primary"
                                        href="${imprimir}">${cliente.cuenta}</a></button>
                            </td>
                            <td>${cliente.cliente}</td>
                            <td>${cliente.saldo}</td>
                            <td><button type="button" class="btn btn-primary"><a class="btn btn-primary"
                                        href="${abono}">
                                        ${cliente.fechab}</a></button>

                            </td>
                            <td><button type="button" class="btn btn-primary"><a class="btn btn-primary"
                                        href="${editar}">Editar informacion de cliente</a></button>
                            </td>
                        </tr>
                           
                        `;
                    }).join('')}
                </tbody>
                <table>
            `;
   })
   .catch(error => {
       console.error('Error fetching abono data:', error);
   });
}
