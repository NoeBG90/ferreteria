<?php
ini_set("display_errors", "1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

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
$idCliente = $_POST['idc'];


$query = "UPDATE clientes SET tipo=?, nombre=?, telefono=?, email=?, calle=?, exterior=?, interior=?, cp=?, colonia=?, ciudad=?, estado=?, RFC=?, 
		nom_contacto=?, descuento=?, id_empleado=?, estatus=?, fecha_actualizacion=?, metodo_pago=?, id_cfdi=?, monto_credito=?, dias_credito=? 
		WHERE id_cliente=?;";
$stmt = $conexio->prepare($query);
$stmt->bind_param(
	'ssssssssssssssisssiiii',
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
	$idMetodoPagoCliente,
	$idUsoCfdi,
	$montoCredito,
	$diasCredito,
	$idCliente
);

//	echo $query;
$result = $stmt->execute();

print_r($result);
$conexio->close();
