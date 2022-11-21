<?php
	if(isset($_GET['tipoPedido'])) {
		session_start();
		include '../../conexion.php';

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

	    //$_GET['tipoPedido']; nos devuelve 1 o 0, donde 0 significa pedido a domicilio y 1 pedido en sucursal
	    $pedido = $_GET['tipoPedido'];
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
	<link rel="stylesheet" type="text/css" href="../../../css/style.css">

	<title>Nine Minutes Pizza</title>
	<link rel="shortcut icon" href="../../../imges/favicon.ico" type="image/x-icon">
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
		<a href="index.php"><img src="../../../images/logo.png"></a>
		<table>
			<tr>
		<?php
		if(!$sesion)
			echo '<td><a href="../../inicio_secion/login.php">Iniciar secion</a></td>
				  <td><a href="../../inicio_secion/register.php">Registrarme</a></td>';

		else {
			echo '<td><a href="#modal">abrir carrito</a></td>
				  <td>'.$usuario.'</td>
				  <td><a href="../../inicio_secion/phpQuery/logout.php">Cerrar sesion</a></td>';
		}
		?>
			</tr>
		</table>
	</div>


	<div style="width: 100%; height: 150px;"></div>
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



	


<!-- Hoja del pedido -->
<?php if($sesion){ ?>
	<div class="container-form-info-usuario">
	<?php if($pedido == 0) { ?>
		<form action="finalizarPedidoDom.php" method="POST">
			<div class="container-info-usuario"><?php echo $usuario." ".$apellidos; ?></div>
			<div class="container-info-usuario"><?php echo $apellidos; ?></div>
			<div class="container-info-usuario">Tonalá</div>
			<div class="container-info-usuario">Jalisco</div>
			<div class="container-info-usuario">Lomas del camichin</div>
			<div class="container-info-usuario">Fresno 173</div>
			<p>Si quieres cambiar la direccion de envio hazlo desde el editor de perfiles.</p><br><br>

	<?php
		if(isset($_SESSION['carrito'])) {
			$total = 0;
			$pedidoCompleto = "";
			for($i = 0; $i <= count($carrito_actual)-1; $i++) {
				if($carrito_actual[$i] != NULL) { ?>
				<div class="producto-added">
					<div class="container-info-product">
						<?php echo $carrito_actual[$i]['pizza'] ." ". $carrito_actual[$i]['medida'] .": x". $carrito_actual[$i]['cantidad']; 

							$pedidoCompleto = $pedidoCompleto."".$carrito_actual[$i]['cantidad']."x".$carrito_actual[$i]['pizza']." de tamaño: ".$carrito_actual[$i]['medida']."<br>";
						?>
					</div>
					<div class="conainer-price-product">
						<?php echo ($carrito_actual[$i]['precio'] * $carrito_actual[$i]['cantidad']); ?>
					</div>
				</div>
			<?php 
				$total = $total + ($carrito_actual[$i]['precio'] * $carrito_actual[$i]['cantidad']);
				}
			}
			echo "<h1>Total:".$total."</h1>";
			$id_pedido = rand(10000000, 99999999);
		}
	?>
			<input type="hidden" name="pedido_id" value="<?php echo $id_pedido; ?>">
			<input type="hidden" name="pedido" value="<?php echo $pedidoCompleto; ?>">
			<input type="hidden" name="domicilio" value="Tonalá Jalisco Lomas del camichin Fresno 173">
			<input type="hidden" name="cliente" value="<?php echo $usuario." ".$apellidos; ?>">
			<input type="hidden" name="cliente_id" value="<?php echo $id; ?>">
			<input type="hidden" name="sucursal" value="<?php echo $_GET['sucu']; ?>">

			<h2>Seguro quieres finalizar tu pedido?</h2>
			<button type="submit" name="pedidoDom">Sí, finalizar</button><br>
			<a href="../empezarPedido.php?sucursal=<?php echo $_GET['sucu']; ?>">No, voler al menu</a><br>
		</form>

	<?php } ?>




<!-- Enviar el pedido para regoger en sucursal a la sucursal -->
	<?php if($pedido == 1) { ?>
		<form action="finalizarPedidoSuc.php" method="POST">
			<h2>El pedido es:</h2>
	<?php
		if(isset($_SESSION['carrito'])) {
			$total = 0;
			$pedidoCompleto = "";
			for($i = 0; $i <= count($carrito_actual)-1; $i++) {
				if($carrito_actual[$i] != NULL) { ?>
				<div class="producto-added">
					<div class="container-info-product">
						<?php echo $carrito_actual[$i]['pizza'] ." ". $carrito_actual[$i]['medida'] .": x". $carrito_actual[$i]['cantidad']; 
							$pedidoCompleto = $pedidoCompleto."".$carrito_actual[$i]['cantidad']."x".$carrito_actual[$i]['pizza']." de tamaño: ".$carrito_actual[$i]['medida']."<br>";
						?>
					</div>
					<div class="conainer-price-product">
						<?php echo ($carrito_actual[$i]['precio'] * $carrito_actual[$i]['cantidad']); ?>
					</div>
				</div>
			<?php 
				$total = $total + ($carrito_actual[$i]['precio'] * $carrito_actual[$i]['cantidad']);
				}
			}
			echo "<h1>Total:".$total."</h1>";
		}
	?>
			<input type="hidden" name="pedido_id" value="<?php echo $id_pedido; ?>">
			<input type="hidden" name="pedido" value="<?php echo $pedidoCompleto; ?>">
			<input type="hidden" name="cliente" value="<?php echo $usuario." ".$apellidos; ?>">
			<input type="hidden" name="cliente_id" value="<?php echo $id; ?>">
			<input type="hidden" name="sucursal" value="<?php echo $_GET['sucu']; ?>">

			<h2>Seguro quieres finalizar tu pedido?</h2>
			<button type="submit" name="pedidoSuc">Sí, finalizar</button><br>
			<a href="../empezarPedido.php?sucursal=<?php echo $_GET['sucu']; ?>">No, voler al menu</a><br>
		</form>
	<?php } ?>
	</div>
<?php } 
	  else { ?>
	<div class="container-form-info-usuario">
		<form class="formulario" action="../../inicio_secion/phpQuery/validarLogin.php?idVentana=DP" method="POST">
	    <h1>Login</h1>
	     <div class="contenedor">
	         <div class="input-contenedor">
	         <i class="fas fa-envelope icon"></i>
	         <input type="email" name="mail" placeholder="Correo Electronico">
	         
	         </div>
	         
	         <div class="input-contenedor">
	        <i class="fas fa-key icon"></i>
	         <input type="password" name="pass" placeholder="Contraseña">
	         
	         </div>
	         <input type="submit" value="Login" class="button">
	         <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
	         <p>¿No tienes una cuenta? <a class="link" href="registrar.html">Registrate </a></p>
	     </div>
    </form>
	</div>
<?php } ?>
	<footer class="container-footer">

	</footer>
</body>
</html>
<?php }