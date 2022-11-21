<?php
	session_start();
	include '../../../conexion.php';

	if(isset($_SESSION['email'])){
        $sesion = true;

        $identificador = $_SESSION['email'];
        $buscarUsuario = $conexion->query("SELECT * FROM usuarios WHERE mail='$identificador'");

        $row = $buscarUsuario->fetch_array();
        
        $id  = $row['id'];
        $usuario = $row['user'];
        $apellidos = $row['surname'];
        $verificar_foto = $row['verify_pic'];
        $foto = $row['pic'];
        $type = $row['type'];
    }

    else {
        $sesion = false;
    }
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
	<link rel="stylesheet" type="text/css" href="../../../../css/style.css">

	<title>Nine Minutes Pizza</title>
	<link rel="shortcut icon" href="../../../../imges/favicon.ico" type="image/x-icon">
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
		<a href="../../../../index.php"><img src="../../../../images/logo.png"></a>
		<table>
			<tr>
		<?php
		if(!$sesion)
			echo '<td><a href="../../../inicio_secion/login.php">Iniciar secion</a></td>
				  <td><a href="../../../inicio_secion/register.php">Registrarme</a></td>';

		else {
			echo '<td><a href="#modal">abrir carrito</a></td>
				  <td>'.$usuario.'</td>
				  <td><a href="../../../inicio_secion/phpQuery/logout.php">Cerrar sesion</a></td>';
		}
		?>
			</tr>
		</table>
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



	<div style="width: 100%; height: 150px;"></div>
	<div class="container-timer">
		<img src="../../../../images/pedido_pronto.png">
		<div class="divs-timer">
			<div class="info-timer">
				<h2>Nine minutes <?php echo $_GET['suc']; ?></h2>
			</div>
			<div class="info-timer" id="timer">
				<h2>Tu pedido estará listo en:</h2>
				<h1 id="h2Timer"></h1>
			</div>
		</div>
	</div>




	<footer class="container-footer">

	</footer>

	<!-- Java Script -->
	<script src="../../../../js/temporizador.js"></script>
</body>
</html>