<?php
	include "conexion.php";

	$latitud = $_GET['Lat'];
	$longitud = $_GET['Lon'];

	//echo $latitud."<br>".$longitud;
	$BuscarSucursal = $conexion->query("SELECT * FROM ubicaciones");
	$contador = 0;
	$arregloSucursales = array(array(), array());

	while ($row = $BuscarSucursal->fetch_array()) {
		$distancia = calcularDistanciaEntreDosCoordenadas($latitud, $longitud, $row['latitud'], $row['longitud']);

		$arregloSucursales[$contador][0] = $distancia;
		$arregloSucursales[$contador][1] = $row['nombre'];
		$arregloSucursales[$contador][2] = $row['direccion'];
		$arregloSucursales[$contador][3] = $row['url'];
		$arregloSucursales[$contador][4] = $row['tel'];

    	$contador++;
	}





	function calcularDistanciaEntreDosCoordenadas($lat1, $lon1, $lat2, $lon2) {
		// Convertir todas las coordenadas a radianes
	    $lat1 = gradosARadianes($lat1);
	    $lon1 = gradosARadianes($lon1);
	    $lat2 = gradosARadianes($lat2);
	    $lon2 = gradosARadianes($lon2);

	    // Aplicar fórmula
		$RADIO_TIERRA_EN_KILOMETROS = 6371;
	    $diferenciaEntreLatitudes = ($lat2 - $lat1);
	    $diferenciaEntreLongitudes = ($lon2 - $lon1);
	    $a = pow(sin($diferenciaEntreLatitudes / 2.0), 2) + cos($lat1) * cos($lat2) * pow(sin($diferenciaEntreLongitudes / 2.0), 2);
	    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
	    $d = $RADIO_TIERRA_EN_KILOMETROS * $c;
	    return $d;
	}

	function gradosARadianes($grados) {
		return ($grados * 3.1415926535 / 180);
	}

	function bubble_sort($arr) {
	    $size = count($arr)-1;
	    for ($i = 0; $i < $size; $i++) {
	        for ($j = 0; $j < $size-$i; $j++) {
	            $k = $j+1;
	            if ($arr[$k][0] < $arr[$j][0]) {
	                list($arr[$j][0], $arr[$k][0]) = array($arr[$k][0], $arr[$j][0]);
	                list($arr[$j][1], $arr[$k][1]) = array($arr[$k][1], $arr[$j][1]);
	                list($arr[$j][2], $arr[$k][2]) = array($arr[$k][2], $arr[$j][2]);
	                list($arr[$j][3], $arr[$k][3]) = array($arr[$k][3], $arr[$j][3]);
	                list($arr[$j][4], $arr[$k][4]) = array($arr[$k][4], $arr[$j][4]);
	            }
	        }
	    }
	    return $arr;
	}
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

	<section class="container-sucursales-orden">
		<div class="container-sucursales">
		<?php
			$orden = bubble_sort($arregloSucursales);
			$tam = count($arregloSucursales);
			for($i = 0; $i < $tam; $i++) {
				if($i < 6) { ?>
				<a href="<?php echo $orden[$i][3] ?>" target="iframe-sucursal">
					<div class="sucursal-box">
						<p><?php echo $orden[$i][1] ?></p>
						<p><?php echo $orden[$i][2] ?></p>
						<p><?php echo $orden[$i][4] ?></p><br>
						<p><?php echo round($orden[$i][0], 2)."Km de distancia aproximadamente" ?></p><br>
						<a href="pedidoPizza/empezarPedido.php?sucursal='<?php echo $orden[$i][1]; ?>'">Pedir Pizza</a>
					</div>
				</a>
		<?php	}
			}
		?>
		</div>
		<div class="container-iframe-map">
			<iframe src="<?php echo $orden[0][3] ?>" name="iframe-sucursal"></iframe>
		</div>
	</section>



	<footer class="container-footer">
		
	</footer>
</body>
</html>