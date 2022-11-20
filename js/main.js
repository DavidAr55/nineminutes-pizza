//Funcion para saber el metodo de reclamo de la pizza
function functionSelectMethod(sucursal) {
  Swal.fire({
    title: 'Selecciona el metodo',
    text: "¿Quieres pedir a domicilio o pasar a recojer a la sucursal " + sucursal,
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonColor: '#0F4B9B',
    denyButtonColor: '#0F4B9B',
    confirmButtonText: 'A domicilio',
    denyButtonText: `Recoger en sucursal`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
    location.href = '../../index.php';
    } else if (result.isDenied) {
    location.href = '#';
    }
  })
}