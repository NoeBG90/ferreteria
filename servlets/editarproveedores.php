<?php
ini_set("display_errors", "1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

$query = "UPDATE proveedores
	SET nombre='" . $_POST['txtnomproveedor'] . "',  telefono='" . $_POST['txttel'] . "', nom_contacto='" . $_POST['txtnomcontacto'] . "', 
		cuenta_bancaria='" . $_POST['txtcuentabancaria'] . "', fecha_actualizacion=now(), estatus='" . $_POST['slsstatus'] . "', 
		email='" . $_POST['txtemail'] . "', prod_vendidos='" . $_POST['textaprodvendprov'] . "'
WHERE id_proveedor=" . $_POST['idp'] . ";";

//	echo $query;
$result = $conexio->query($query);
print_r($result);
$conexio->close();
