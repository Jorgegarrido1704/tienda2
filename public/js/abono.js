
function informacionAbono(idVenta) {
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const cliente = document.getElementById('cliente').value;

   fetch(`${ROUTES.fetchProducts}?cliente=${cliente}`, {
       method: 'POST',
       headers: {
           'Content-Type': 'application/json',
           'X-CSRF-TOKEN': CSRF_TOKEN
       },
       body: JSON.stringify({ venta_id: idVenta })
   })
   .then(response => response.json())
   .then(data => {
       // Aquí puedes manejar los datos recibidos
       console.log(data);
       // Por ejemplo, mostrar la información en un modal
   })
   .catch(error => {
       console.error('Error fetching abono data:', error);
   });
}
