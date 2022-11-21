<?php
	session_start();

	if(isset($_SESSION['carrito'])) {
		$carrito_actual = $_SESSION['carrito'];

		if(isset($_POST['pizza'])) {
			$pizza = $_POST['pizza'];
			$medida = $_POST['medida'];
			
			if($medida == "Familiar")
				$precio = 125;

			else
				$precio = 95;

			$cantidad = $_POST['cantidad'];
			$num = 0;

			$carrito_actual[] = array("pizza" => $pizza,
								"medida" => $medida,
								"precio" => $precio,
								"cantidad" => $cantidad);
		}
	}

	else {
		$pizza = $_POST['pizza'];
		$medida = $_POST['medida'];
		
		if($medida == "Familiar")
			$precio = 125;

		else
			$precio = 95;
			
		$cantidad = $_POST['cantidad'];

		$carrito_actual[] = array("pizza" => $pizza,
							"medida" => $medida,
							"precio" => $precio,
							"cantidad" => $cantidad);
	}

	$_SESSION['carrito'] = $carrito_actual;
	/*echo "<script>
			alert('Hola: ".$pizza.": ".$cantidad."');
			location.href = 'empezarPedido.php';
		  </script>";*/

	header("Location: ".$_SERVER['HTTP_REFERER']."");
