<?php
	include ('conectar.php');
	session_start();

	$codigo = $_POST['Codigo'];

	if(isset($_SESSION['email']))
		$email = $_SESSION['email'];

	$row = $conexion->query("SELECT * FROM usuarios WHERE mail='$email' AND code='$codigo'")or die($conexion->error);
	if(mysqli_num_rows($row) > 0){
        $conexion->query("UPDATE usuarios SET verify = 'yes' where code = '$codigo' ");
        session_destroy();
        echo "<script> 		alert('Correo electronico verificado, ahora puedes iniciar sesión');
			location.href = '../html/login.html'; 	</script>";
    }else{
        echo "<script> 		alert('Error, el codigo de verificacion no coincide');
			location.href = '../html/verificar.html'; 	</script>";
    }
?>