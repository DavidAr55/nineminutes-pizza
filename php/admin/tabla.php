<?php
	include('../conexion.php');
?>
<table>
	<tr>
		<td>Pedido</td>
		<td>Cliente</td>
		<td>Domicilio</td>
		<td>Sucursal</td>
		<td>fecha</td>
	</tr>
<?php
	$selectPedidos = $conexion->query("SELECT * FROM pedidos");
	while($pedido = $selectPedidos->fetch_array()) { ?>
	<tr>
		<td><?php echo $pedido['pedido']; ?></td>
		<td><?php echo $pedido['usuario']; ?></td>
		<td><?php echo $pedido['domicilio']; ?></td>
		<td><?php echo $pedido['sucursal']; ?></td>
		<td><?php echo $pedido['date']; ?></td>
	</tr>
<?php } ?>

</table>