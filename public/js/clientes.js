function informacionClientes(idVenta) {
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const cliente = document.getElementById('cliente').value;
    const numCuenta = document.getElementById('numCuenta').value;

    // Agregamos venta_id a la URL
    const url = `${ROUTES.verVentas}?cliente=${cliente}&numCuenta=${numCuenta}`;

    fetch(url, {
       method: 'GET',
       headers: {
           'Content-Type': 'application/json',
           'X-CSRF-TOKEN': CSRF_TOKEN
       }
       // ELIMINAMOS EL BODY AQUÍ
   })
   .then(response => response.json())
   .then(data => {
       console.log(data);
   })
   .catch(error => {
       console.error('Error fetching abono data:', error);
   });
}
