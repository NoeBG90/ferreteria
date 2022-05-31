<?php

header("Content-type: application/json; charset=utf-8");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

if ($_REQUEST['tipoCliente'] === 'F') {
	$query = "select  * from usos_cfdi where p_fisica ='si';";
} else {
	$query = "select  * from usos_cfdi where p_moral ='si';";
}
$result = $conexio->query($query);
$response = new stdClass();
$usosCFDI = [];
while ($fila = $result->fetch_assoc()) {
	$responsedet = new stdClass();
	$responsedet->id = $fila['id_usoscfdi'];
	$responsedet->descripcion = $fila['descripcion_cfdi'];
	array_push($usosCFDI, $responsedet);
}

$response = $usosCFDI;
print_r(json_encode($response));
