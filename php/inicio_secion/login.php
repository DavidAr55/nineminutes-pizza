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
    <form class="formulario" action="phpQuery/validarLogin.php" method="POST">
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
</body>
</html>