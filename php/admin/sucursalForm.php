<?php
	session_start();
	include('../conectar.php');

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

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,600|Open+Sans" rel="stylesheet">

	<link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../../css/footer.css">
	<link rel="stylesheet" type="text/css" href="../../css/estilos-forms-admin.css">
	<link rel="stylesheet" type="text/css" href="../../css/redes-style.css">
	<link rel="stylesheet" type="text/css" href="../../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<title>Nine Minutes pizza</title>
</head>
<body>
	<div class="general">
		<!-- Barra de navegacion -->
		<header class="header">
		    <div class="container">
		        <div class="btn-menu">
		          	<label for="btn-menu"><img src="../../img/tambor.png" height="75px">☰<h3>Nine Minutes</h3></label>
		        </div>
		    </div>
	    </header>
	    <div class="capa"></div>
	    <!--------------Opciones del menu--------------->
	    <input type="checkbox" id="btn-menu" />
	    <div class="container-menu">
		    <div class="cont-menu">
		        <nav>
			        <a href="../../index.php">Home</a>
			        <a href="#">Pedir pizza</a>
			        <a href="../menu.php">Menu</a>
			        <a href="#">Sucursales</a><br>
			        <a href="#">Sugerencias</a><br>
	    		<?php 
		    		if(!$sesion) {	 
		          		echo '<a href="html/login.html">Login</a>';
		    		} 
		    		else {
		    	  		echo '<a href="../php/logout.php">Logout</a>';
		    	  		if($type == 'admin') {
		    	  			echo '<a href="admin.php">Panel administrador</a>';
		    	  		}
		    		}
	    		?>
		          	<div class="opciones-perfil">
	      		<?php 
	      			if($sesion) { 
	          	  		if($verificar_foto != 'yes') {
	          	  			echo '<img class="img-usuario" src="img/tambor.png">
	          					  <p>Bienvenido '.$usuario.' '.$apellidos.'</p>';
	           			}
	          			else {
		          			echo '<img class="img-usuario" src="data:image/jpg;base64,'.base64_encode($foto).'">
		          				  <p>Bienvenido '.$usuario.' '.$apellidos.'</p>';
	          			}	
	      		  	}
	      		?>
		          	</div>
		        </nav>
		        <label for="btn-menu" id="boton">
	        		<img src="tambor.png" alt=""/>
	        	</label>
		    </div>
	    </div>


			
		<form class="formulario" action="sucursalRegistro.php" method="POST" enctype="multipart/form-data">
	        <h1>Registrar Ubicacion</h1>
	        <div class="contenedor">
	            <div class="input-contenedor">
	               <input type="text" name="nombre" placeholder="Nombre de la Sucursal" required>
	            </div>

	            <div class="input-contenedor">
	               <textarea name="direccion" placeholder="Direccion de la sucursal" required></textarea>
	            </div>

	            <h3>URL de la ubicacion</h3>
	            <div class="input-contenedor">
	               <textarea name="url" placeholder="url del google maps de la sucursal" required></textarea>
	            </div>

	            <h3>Foto de sucursal</h3>
	            <div class="input-contenedor">
	        		<input type="file" name="imagen" required>
	            </div>

	            <div class="input-contenedor">
	               <input type="text" name="latitud" placeholder="latitud*" required>
	            </div>

	            <div class="input-contenedor">
	               <input type="text" name="longitud" placeholder="longitud*" required>
	            </div>

	            <div class="input-contenedor">
	               <input type="text" name="telefono" placeholder="Numero(s) de telefono" required>
	            </div>
	            <input type="submit" value="Registrar" class="button">
	        </div>
	    </form>



      	<footer class="footer-box">
			<div class="footer-info-box">
				<!-- <div class="footer-display-flex">
					<h3>Más informacion</h3><br>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div> -->
				<div class="footer-display-flex">
					<h3>Legal</h3><br>
					<p>©2020-2022 Nine Minutes Pizza, Inc. Reservados todos los derechos. El nombre, los logotipos y las marcas relacionadas con Nine Minutes Pizza son marcas comerciales registradas</p>
				</div>

				<div class="footer-display-flex">
					<h3>Contacto</h3><br>
					<p>nineminutespizzamk@gmail.com</p><br>
					<p>Siguenos en redes sociales:</p><br>
					<div class="redes-container">
						<ul>
							<li><a href="https://www.facebook.com/pages/category/Pizza-place/Nine-Minutes-Pizza-113705307132674/" class="facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://www.instagram.com/nineminutespizza/?hl=es" class="instagram"><i class="fa fa-instagram"></i></a></li>
							<li><a href="https://www.youtube.com/channel/UCBn2sTeWVuvrW7RfNw6aZBw" class="youtube"><i class="fa fa-youtube"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</div>
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