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

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,600|Open+Sans" rel="stylesheet">

	<link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/style-Admin.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
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
			        <a href="#">Menu</a>
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
			
		<div class="opciones-container">
        <h1>Panel administrador</h1>
        <div class="contenedor">
            <div class="input-contenedor">
               <a href="menuForm.php">Agregar al Menú</a>
            </div>

            <div class="input-contenedor">
               <a href="sucursalForm.php">Agregar Sucursal</a>
            </div>

            <div class="input-contenedor">
               <a href="pedidos.php">Ver usuarios Pedidos</a>
            </div>
         </div>
      </div>
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