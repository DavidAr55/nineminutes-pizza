<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title> 
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
 	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
	<link rel="stylesheet" href="../css/estilos-login.css">
</head>  
<body class="body">
    <form class="formulario" action="../php/validar-registro.php" method="POST">
	    <h1>Ingresa el codigo de verficiacion</h1>
	    <div class="contenedor">
	    	<div class="input-contenedor">
	        	<i class="fas fa-envelope icon"></i>
	        	<input type="text" name="Codigo" placeholder="Ingrese el codigo">
	    	</div>

	        <input type="submit" value="Enviar" class="button">
	        <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
	    </div>
    </form>
</body>
</html>