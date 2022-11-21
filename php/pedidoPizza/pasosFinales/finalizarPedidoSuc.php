<?php
	include '../../conexion.php';

	if(isset($_POST['pedidoSuc'])) {

		session_start();
		unset($_SESSION['carrito']);

		$pedido_id = $_POST['pedido_id'];

		$pedido = $_POST['pedido'];
		$cliente = $_POST['cliente'];
		$cliente_id = $_POST['cliente_id'];

		$sucursalPedido = $_POST['sucursal'];
		$hoy = date("F j, Y, g:i a");  

		$id_encriptada = $pedido_id."+".$hoy;
		$token = md5($id_encriptada);

		$envioPedido = $conexion->query("INSERT INTO pedidos VALUES (0, '$hoy', '$pedido_id', '$sucursalPedido', '$token', '$pedido', 'Recoger en sucursal', '$cliente', '$cliente_id')")or die($envioPedido->error);

		if($envioPedido) {
			echo "<script>
					alert('Gracias por hacer un pedido con nosotros ".$cliente."');
					location.href = 'esperar/esperarPedidoDom.php?token=".$token."&suc=".$sucursalPedido."';
				  </script>";
		}
	}