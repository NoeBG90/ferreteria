<?php
ini_set("display_errors", "1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();


$queryvalidaproveedor = "select * from proveedores where nombre='" . $_POST['txtnomproveedor'] . "';";
$result = $conexio->query($queryvalidaproveedor);
if ($result->num_rows > 0) {
	echo "El proveedor ya se encuentra registrado";
} else {

	$nombreProveedor = $_POST['txtnomproveedor'];
	$calle = $_POST['txtcalleavenida'];
	$numeroExt = $_POST['txtnoext'];
	$numeroInt = $_POST['txtnoint'];
	$cp = $_POST['txtcp'];
	$colonia = $_POST['slscolonia'];
	$ciudad = $_POST['txtciudad'];
	$estado = $_POST['txtedo'];
	$telefono = $_POST['txttel'];
	$nombreContacto = $_POST['txtnomcontacto'];
	$cuentaBancaria = $_POST['txtcuentabancaria'];
	$fecha = date("Y:m:d H:i:s");
	$estatus = $_POST['slsstatus'];
	$email = $_POST['txtemail'];
	$productosVende = $_POST['textaprodvendprov'];

	$query = "INSERT INTO proveedores
			(nombre, calle, exterior, interior, cp, colonia, ciudad, estado, telefono, nom_contacto, cuenta_bancaria,
			fecha_registro, fecha_actualizacion, estatus, email, prod_vendidos)
	VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

	$stmt = $conexio->prepare($query);
	$stmt->bind_param(
		'ssssssssssssssss',
		$nombreProveedor,
		$calle,
		$numeroExt,
		$numeroInt,
		$cp,
		$colonia,
		$ciudad,
		$estado,
		$telefono,
		$nombreContacto,
		$cuentaBancaria,
		$fecha,
		$fecha,
		$estatus,
		$email,
		$productosVende,
	);
	$result = $stmt->execute();
	$idProveedor = $stmt->insert_id;

	$update_numero = "update proveedores set numero_proveedor =concat('PV-',LPAD(" . $idProveedor . " , 5 , '0')) where id_proveedor =" . $idProveedor;
	$resultupdate = $conexio->query($update_numero);

	print_r($result);

	$stmt->close();
	$conexio->close();
}
