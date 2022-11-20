<?php
	session_start();
	include('../../conexion.php');
	session_destroy();
	echo '<script type="text/javascript">
			location.href = "../../../index.php";
		</script>';
