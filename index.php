<?php
	session_start();
	include 'php/conexion.php';

	if(isset($_SESSION['email'])){
        $sesion = true;

        $identificador = $_SESSION['email'];
        $buscarUsuario = $conexion->query("SELECT * FROM usuarios WHERE mail='$identificador'");

        $row = $buscarUsuario->fetch_array();
        
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
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<title>Nine Minutes Pizza</title>
	<link rel="shortcut icon" href="imges/favicon.ico" type="image/x-icon">
</head>
<body>
	<script type="text/javascript">
		function success(geolocationPosition) {
			let coords = geolocationPosition.coords;
			document.getElementById("mymap").innerHTML = "Latitud: " + coords.latitude + "<br>Longitud: " + coords.longitude;
			document.getElementById("mymap").innerHTML = "<p class='blue-title'>El navegador ya detectó tu ubicación, buscando sucursal más cercana</p><a href='php/compararCords.php?Lat="+coords.latitude+"&Lon="+coords.longitude+"'>Clic aquí</a>";
			//console.log(geolocationPosition);
			//alert("El navegador ya detectó tu ubicación, buscando sucursal más cercana...");
			//location.href = "compararCords.php?Lat="+coords.latitude+"&Lon="+coords.longitude;
		}

		function error(err) {
		    console.warn(`ERROR(${err.code}): ${err.message}`);
		}

		const options = {
		    enableHighAccuracy: true,
		    timeout: 5000,
		    maximumAge: 0
		};


		if(navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(success, error, options);
		}
		else {
			alert("El navegador no permite el uso de ubicación :(");
		}
	</script>



	<div class="container-navigation-bar">
		<a href="index.php"><img src="images/logo.png"></a>
		<table>
			<tr>
				<td>Carro</td>
		<?php
		if(!$sesion)
			echo '<td><a href="php/inicio_secion/login.php">Iniciar secion</a></td>
				  <td><a href="php/inicio_secion/register.php">Registrarme</a></td>';

		else {
			echo '<td>'.$usuario.'</td>
				  <td><a href="php/inicio_secion/phpQuery/logout.php">Cerrar sesion</a></td>';
		}
		?>
			</tr>
		</table>
	</div>



	<div class="container-searching-bar">
		<div class="container-tambor">
			<img src="images/tambor-1.png">
		</div>
		<div class="container-form-search">
			<form action="php/buscar.php" method="POST">
				<h1 class="dark-title">PIDE TU PIZZA</h1>
				<h1 class="blue-title">EN LÍNEA</h1>
				<div class="container-browser">
					<div class="browser">
						<h2>Elige la sucursal más cercana</h2>
						<input type="text" name="cp" pattern="[0-9]{5}" placeholder="Ingresa tu codigo postal*" required>
					</div>
					<button><img src="images/boton.png"></button>
				</div>
				<div id="mymap">
					
				</div>
			</form>
		</div>
	</div>




	<section class="container-pizzas">
		<div class="especialidades">
		<?php
        	$query = "SELECT * FROM `menu-pizzas`";
            $result = $conexion->query($query);
            $contPizzas = 0;

            while ($mostrar = $result->fetch_assoc()) {	
            	if($contPizzas < 6) {?>
				<div class="menu-box">
					<div class="pizza-imagen">
						<img src="data:image/jpg;base64,<?php echo base64_encode($mostrar['imagen']); ?>">
					</div>
					<div class="container-pizza-info">
						<div class="container-pizza-nombre">
							<h2><?php echo $mostrar['pizza']; ?></h2>
							<p><?php echo $mostrar['ingredientes']; ?></p>
						</div>
						<div class="container-precio">
							<h1>115$</h1>
						</div>
					</div>
				</div>
		<?php 	}
			$contPizzas++; 
			} ?>
		</div>
		<a href="#" class="boton">
			<div class="boton-menu">
				menú completo
			</div>
		</a>	
	</section>



	<footer class="container-footer">
		
	</footer>
</body>
</html>