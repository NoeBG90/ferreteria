<?php
header("Content-type: application/json; charset=utf-8");

include "../conexion/conexion.php";
$conexio =  conectar_bd();

$query="select   D_mnpio,d_estado,d_asenta from sepomex_dir sd where d_codigo ='".$_REQUEST['txtcp']."';";
$result=$conexio->query($query);
$response=new stdClass();
$colonias=[];
while($fila=$result->fetch_assoc()){
	$response->municipio=$fila['D_mnpio'];
	$response->estado=utf8_encode($fila['d_estado']);
	array_push($colonias, utf8_encode($fila['d_asenta']));

}
$response->colonias=$colonias;
print(json_encode($response));
?>