<?php

ini_set("display_errors", "1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

$queryvalidacliente = "select * from clientes where nombre='" . $_POST['txtnomcliente'] . "';";
$result = $conexio->query($queryvalidacliente);
if ($result->num_rows > 0) {
	echo "El cliente ya se encuentra registrado";
} else {
	$queryvalidacliente = "select * from clientes where RFC='" . $_POST['txtRFC'] . "';";
	$result = $conexio->query($queryvalidacliente);

	$tipoCliente = $_POST['radioTipoCliente'];
	$nombreCliente = $_POST['txtnomcliente'];
	$rfcCliente = $_POST['txtRFC'];
	$celularCliente = $_POST['txttel'];
	$nombreContacto = $_POST['txtnomcontacto'];
	$emailCliente = $_POST['txtemail'];
	$idUsoCfdi = $_POST['slscfdi'];
	$montoCredito = $_POST['txtmontocredito'];
	$diasCredito = $_POST['txtdiascredito'];
	$tipoCliente = $_POST['radioTipoCliente'];
	$idMetodoPagoCliente = $_POST['slsmetpagoclie'];
	$idEmpleado = $_POST['slsvendedor'];
	$estatus = $_POST['slsstatus'];
	$calle = $_POST['txtcalleavenida'];
	$numExt = $_POST['txtnoext'];
	$numInt = $_POST['txtnoint'];
	$cp = $_POST['txtcp'];
	$colonia = $_POST['slscolonia'];
	$ciudad = $_POST['txtciudad'];
	$estado = $_POST['txtedo'];
	$fecha = date("Y:m:d H:i:s");
	$descuento = $_POST['txtdescuento'];

	if ($result->num_rows > 0) {
		echo "El RFC ya se encuentra registrado";
	} else {
		$query = "INSERT INTO clientes (tipo, nombre, telefono, email, calle, exterior, interior, cp, colonia, ciudad, estado, RFC, nom_contacto, 
										descuento, id_empleado, estatus, fecha_registro, fecha_actualizacion, metodo_pago, id_cfdi, monto_credito, dias_credito)
		VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
		$stmt = $conexio->prepare($query);
		$stmt->bind_param(
			'sssssssssssssiisssiiii',
			$tipoCliente,
			$nombreCliente,
			$celularCliente,
			$emailCliente,
			$calle,
			$numExt,
			$numInt,
			$cp,
			$colonia,
			$ciudad,
			$estado,
			$rfcCliente,
			$nombreContacto,
			$descuento,
			$idEmpleado,
			$estatus,
			$fecha,
			$fecha,
			$idMetodoPagoCliente,
			$idUsoCfdi,
			$montoCredito,
			$diasCredito
		);

		$result = $stmt->execute();
		$idCliente = $stmt->insert_id;

		$update_numero = "update clientes set numero_cliente =concat('CL-',LPAD(" . $idCliente . " , 5 , '0')) where id_cliente =" . $idCliente;
		$resultupdate = $conexio->query($update_numero);
		print_r($result);
		$conexio->close();
	}
}
