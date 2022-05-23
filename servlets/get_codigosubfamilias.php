<?php

header("Content-type: application/json; charset=utf-8");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

$query = "SELECT * FROM subfamilia_producto sp where id_subfamilia  =" . $_REQUEST['slssubfamilia'] . ";";
$result = $conexio->query($query);
$response = new stdClass();

while ($fila = $result->fetch_assoc()) {
	$response->codigo = $fila['codigo_subfamiliaprod'];
}

print(json_encode($response));
