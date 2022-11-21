<?php
	session_start();
	include('../conexion.php');

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

    if(isset($sesion)) {
    	if($sesion && isset($type)) {
    		if($type == 'admin') { ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="../../../img/favicon.ico" type="image/x-icon">
	<title>Nine Minutes pizza</title>
</head>
<body>
	
	<script type="text/javascript">
		function ajax() {
			var req = new XMLHttpRequest();

			req.onreadystatechange = function() {
				if(req.readyState == 4 && req.status == 200) {
					document.getElementById('tabla').innerHTML = req.responseText;
					//document.getElementById('beep').innerHTML = "<embed loop='false' src='../../media/Notification.mp3' hidden='true' autoplay='true'>";
				}
			}

			req.open('GET', 'tabla.php', true);
			req.send();
		}

		setInterval(function(){ajax();}, 1000);
	</script>

	<div id="tabla"></div>

	<div id="beep"></div>

</body>
</html>
    <?php 	}

    		else {
    			echo "<script>
    					alert('Hola? quien eres? 👀 No deberias estar aquí, adios');
    					location.href = '../../index.php';
    				  </script>";
    		}
    	}

    	else {
			echo "<script>
					alert('Hola? quien eres? 👀 No deberias estar aquí, adios');
					location.href = '../../index.php';
				  </script>";
		}
    }

    else {
		echo "<script>
				alert('Hola? quien eres? 👀 No deberias estar aquí, adios');
				location.href = '../../index.php';
			  </script>";
	}
?>