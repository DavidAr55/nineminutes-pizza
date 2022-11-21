<?php
	include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Scripts -->
	<script type="text/javascript">
		function alerta(latitud, longitud) {
			//alert("Latitud: " + latitud + " | - | Longitud: " + longitud);
			location.href = "compararCords.php?Lat="+latitud+"&Lon="+longitud;
		}
	</script>

	<!-- Fuentes de google fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">

	<!-- CSS estilos -->
	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<title>Nine Minutes Pizza</title>
	<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
</head>
<body>
	

	<div class="container-navigation-bar">
		<a href="../index.php"><img src="../images/logo.png"></a>
	</div>



	<section class="container-vacio"></section>

	<section class="container-colonias">
		<?php
			$codigoPostal = $_POST['cp'];
			$BuscarCP = $conexion->query("SELECT * FROM mexico WHERE cp='$codigoPostal' ORDER BY colonia");

			$contador = 1;
		    while($row = $BuscarCP->fetch_array()) {
		    	$latitud = $row['latitud'];
		    	$longitud = $row['longitud'];

		    	echo "<p><button type='button' onclick='alerta(".$latitud.", ".$longitud.")'>Ver sucursales</button>".$row['colonia']." | ".$row['cp']."</p><br>";
		    	$contador++;
		    }
		?>
	</section>



	<footer class="container-footer">
		
	</footer>
</body>
</html>