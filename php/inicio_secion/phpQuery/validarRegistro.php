<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Smtp;
	use PHPMailer\PHPMailer\Exception;

	require '../../vendor/autoload.php';

	session_start();
	include('../../conexion.php');

	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$birthday = $_POST['birthday'];
	$genero = $_POST['genero'];
	$email = $_POST['mail'];
	$password = $_POST['pass'];
	$password2 = $_POST['pass2'];

	$tipo = "usuario";
	$verificado = "no";
	$foto_perfil = "no";		
	$enviado = false;
	
	if ($password == $password2) {
		$findEmail = $conexion->query("SELECT * FROM usuarios WHERE mail='$email'");
		$row = $findEmail->fetch_array();

		if(empty($row['mail'])) {
			//Enviar Email
			$codigo = rand(100000, 999999);
			$cuerpo = ' 
				<html>
				<body> 
				<h1>Verifica tu dirección de correo electrónico</h1> 
				<p> 
				<b>'.$nombre.' Gracias por ingresar a Nine minutes pizza</b>.<br>
					para completar tu registro ingresa el siguiente codigo para verificar tu correo electronico.
				</p><br>
				<b style="font-size: 25px; font-family: Arial;">'.$codigo.'</b>
				</body> 
				</html> 
			';

			$MAIL = new PHPMailer(true);

			try {
				$MAIL->SMTPDebug = SMTP::DEBUG_SERVER;
				$MAIL->isSMTP();
				$MAIL->Host = 'giowm1223.siteground.biz';
				$MAIL->SMTPAuth = true;
				$MAIL->Username = 'no-reply@nineminutes.com.mx';
				$MAIL->Password = ')|325_@Kug15';
				$MAIL->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
				$MAIL->Port = 465;

				$MAIL->setFrom("no-reply@nineminutes.com.mx", "Admin Nine minutes pizza");
				$MAIL->addAddress($email, "9 minutes");

				$MAIL->isHTML(true);
				$MAIL->Subject = 'Verificacion de correo electronico 9 minutes pizza';
				$MAIL->Body = $cuerpo;
				$MAIL->send();

				//echo "Enviado correctamente";

				$sendRegistro = "INSERT INTO usuarios VALUES(0, '$nombre', '$apellidos', '$genero', '$birthday', '$email', '$password', '$foto_perfil', '', '$codigo', '$verificado', '$tipo')";
				$query = mysqli_query($conexion, $sendRegistro);
				if(!$query) {
					echo "<script> 		alert('Error al conectar con la base de datos, intenta más tarde');
						location.href = '../../../index.php'; 	</script>";
				}
				else {
					$_SESSION['email'] = $email;
					echo "<script>location.href = 'validarCodigo.php';</script>";
				}

			} catch (Exception $e) {
				echo "Error al enviar correo: ".$MAIL->ErrorInfo;
			}
		}

		else {
			echo "<script>
				alert('El correo ectronico que intentas registrar ya está registrado, intenta con otro');
				location.href = '../register.php';
			</script>";
		}
	}
	//Si las contraseñas no coinciden
	else {
		echo "<script>
			alert('Las contraseñas no coinsiden');
			location.href = '../register.php';
		</script>";
	}