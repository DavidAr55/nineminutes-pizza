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
      <form class="formulario" action="../php/registrar.php" method="POST">
         <h1>Registrate</h1>
         <div class="contenedor">
            <div class="input-contenedor">
               <i class="fas fa-user icon"></i>
               <input type="text" name="nombre" placeholder="Nombre Completo" required>
            </div>

            <div class="input-contenedor">
               <i class="fas fa-user icon"></i>
               <input type="text" name="apellidos" placeholder="Apellidos" required>
            </div>

            <h3>Fecha de nacimiento</h3>
            <div class="input-contenedor">
               <i class="fas fa-calendar icon"></i>
               <input type="date" name="birthday" required>
            </div>

            <h3>Genero</h3>
            <div class="input-contenedor">
               <i class="fas fa-venus-mars icon"></i>
               <select name="genero">
                  <option value="null"></option>
                  <option value="hombre">hombre</option>
                  <option value="mujer">mujer</option>
                  <option value="otro">otro</option>
               </select>
            </div>
            
            <div class="input-contenedor">
               <i class="fas fa-envelope icon"></i>
               <input type="text" name="mail" placeholder="Correo Electronico" required>
            </div>
            
            <div class="input-contenedor">
               <i class="fas fa-key icon"></i>
               <input type="password" name="pass" placeholder="Contraseña" required>
            </div>

            <div class="input-contenedor">
               <i class="fas fa-key icon"></i>
               <input type="password" name="pass2" placeholder="Confirmar contraseña" required>
            </div>
            <input type="submit" value="Registrate" class="button">
            <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
            <p>¿Ya tienes una cuenta?<a class="link" href="login.html">Iniciar Sesion</a></p>
         </div>
      </form>
</body>
</html>