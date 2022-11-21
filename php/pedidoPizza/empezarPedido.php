<?php
	session_start();
	include '../conexion.php';

	if(isset($_GET['sucursal']))
		$sucursalActual = $_GET['sucursal'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Fuentes de google fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">

	<!-- CSS estilos -->
	<link rel="stylesheet" type="text/css" href="../../css/style.css">	

	<title>Nine Minutes Pizza</title>
	<link rel="shortcut icon" href="../../imges/favicon.ico" type="image/x-icon">
</head>
<body>
<!-- Iniciamos el carrito -->
<?php
	if(isset($_SESSION['carrito'])) {
		$carrito_actual = $_SESSION['carrito'];
		$_SESSION['carrito'] = $carrito_actual;
	}

	if(isset($_SESSION['carrito'])) {
		for($i = 0; $i <= count($carrito_actual)-1; $i++) {
			if($carrito_actual[$i] != NULL) {
				if(isset($_GET['cantidad'])) {
					$total_cantidad = $carrito_actual['cantidad'];
					$total_cantidad++;
					$totalCantidad += $total_cantidad;
				}
			}
		}
	}
?>


	<div class="container-navigation-bar">
		<a href="../../index.php"><img src="../../images/logo.png"></a>

		<a href="#modal" class="btn-open-popup">abrir carrito</a>
	</div>



	<div class="container-carrito" id="modal">
		<div class="popup">
			<a href="#" class="btn-close">X</a>
			<h1>Carrito</h1>
			<div class="container-productos-carrito">
	<?php
		if(isset($_SESSION['carrito'])) {
			$total = 0;
			for($i = 0; $i <= count($carrito_actual)-1; $i++) {
				if($carrito_actual[$i] != NULL) { ?>
				<div class="producto-added">
					<div class="container-info-product">
						<?php echo $carrito_actual[$i]['pizza'] ." ". $carrito_actual[$i]['medida'] .": x". $carrito_actual[$i]['cantidad']; ?>
					</div>
					<div class="conainer-price-product">
						<?php echo ($carrito_actual[$i]['precio'] * $carrito_actual[$i]['cantidad']); ?>
					</div>
				</div>
			<?php 
				$total = $total + ($carrito_actual[$i]['precio'] * $carrito_actual[$i]['cantidad']);
				}
			}
		}
	?>
			</div>
			<div class="container-opciones-carrito" style=""> 
				<?php
					if(isset($total))
						echo "Total: ".$total;

					else
						echo "Total: 0";
				?>
			</div>
			<div class="container-opciones-carrito">
				<a href="unsetCarrito.php">Vaciar carro</a>
				<a href="#">Seguir comprando</a>
				<button onclick="functionSelectMethod(<?php echo $sucursalActual; ?>);">Finalizar orden</button>
			</div>
		</div>
	</div>




	<section class="sucursal-seleccionada">
		<div class="texto-sucursal-select">
			<p>Has seleccionado la sucursal de:</p>
			<h2>Nine minutes <?php echo $sucursalActual; ?></h2>
		</div>
	</section>




	<h1 class="add-order">Agrega lo delicioso a tu orden</h1>

	<section class="container-seleccionar-pizza">
	<?php
		$query = "SELECT * FROM `menu-pizzas`";
        $result = $conexion->query($query);

        while ($mostrar = $result->fetch_assoc()) { ?>
		<div class="container-pizza-seleccion">
			<div class="container-select-pizza">
				<img src="data:image/jpg;base64,<?php echo base64_encode($mostrar['imagen']); ?>">
			</div>
			<div class="container-info-pizza">
				<h2><?php echo $mostrar['pizza']; ?></h2>
				<p><?php echo $mostrar['ingredientes']; ?></p>

				<form action="carrito.php" method="POST">
					<input type="hidden" name="pizza" value="<?php echo $mostrar['pizza'] ?>">
					
					<select name="cantidad">
				<?php
					for($j = 1; $j <= 10; $j++) {
						echo "<option value=".$j.">".$j."</option>";
					}
				?>
					</select>

					<select name="medida">
						<option value="Familiar">Familiar</option>
						<option value="Mediana">Mediana</option>
					</select>

					<button type="submit" class="btn-add">Agregar al carro</button>
				</form>
			</div>
		</div>
	<?php }
	?>
	</section>




	<footer class="container-footer">
		
	</footer>


	<!-- Java Script -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="../../js/main.js"></script>
</body>
</html>