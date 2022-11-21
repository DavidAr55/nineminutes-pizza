<?php
	session_start();
	include('../conectar.php');

	//Guardar checkboxes
	$rows = $conexion->query("SELECT * FROM `ingredientes-pizza`");
	$contador = mysqli_num_rows($rows);
	//echo "<script>alert('Numero de filas ".$contador."');</script>";
	$i=0;
	$ingredientesArray = array();

	while ($rowsId = $rows->fetch_assoc()) {
		if(isset($_POST['opc'.$rowsId['id']])) {
			$ingredientesArray[$i] = 'º '.$_POST['opc'.$rowsId['id']];
			$i++;
		}
	}

	$ingredientes = "";
	for ($j=0; $j < $i; $j++)
		$ingredientes = $ingredientes.$ingredientesArray[$j]."<br>";

	$pizza = $_POST['pizza'];
	$description = $_POST['descripcion'];
	$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
	
	$guardarPizza = "INSERT INTO `menu-pizzas` VALUES (0, '$pizza', '$description', '$imagen', '$ingredientes')";
	$query = mysqli_query($conexion, $guardarPizza);

	if($query) {
		echo "<script>
				alert('Pizza guardada existosamente');
				location.href = 'menuForm.php';
			  </script>";
	} else {
		echo "<script>
				alert('Error: ".$query->error."');
				location.href = 'menuForm.php';
			  </script>";
	}
?>