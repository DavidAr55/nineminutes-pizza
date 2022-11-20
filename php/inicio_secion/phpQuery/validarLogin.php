<?php
	include('../../conexion.php');

	$email = $_POST['mail'];
	$password = $_POST['pass'];
	$consulta = "SELECT * FROM usuarios WHERE mail='$email' AND password='$password'";

	$query = mysqli_query($conexion, $consulta);
	$filas = mysqli_num_rows($query);

	if($filas) {
		session_start();
		$_SESSION['email'] = $email;
		echo "<script>
			location.href = '../../../index.php';
		</script>";
	}
	else {
		echo "<script>
			alert('Correo o contraseña incorrectos, intenta de nuevo');
			location.href = '../login.php';
		</script>";
	}
?>