<?php
	session_start();
	include('../conectar.php');

	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$url = $_POST['url'];
	$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
	$latitud = $_POST['latitud'];
	$longitud = $_POST['longitud'];
	$tel = $_POST['telefono'];
	
	$guardarPizza = "INSERT INTO ubicaciones VALUES (0, '$nombre', '$direccion', '$url', '$imagen', '$tel', '$latitud', '$longitud')";
	$query = mysqli_query($conexion, $guardarPizza);

	if($query) {
		echo "<script>
				alert('Ubicacion guardada existosamente');
				location.href = 'sucursalForm.php';
			  </script>";
	} else {
		echo "<script>
				alert('Error: ".$query->error."');
				location.href = 'sucursalForm.php';
			  </script>";
	}
?>