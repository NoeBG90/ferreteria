<?php
header("Content-type: application/json; charset=utf-8");

include "../conexion/conexion.php";
$conexio =  conectar_bd();

$query="SELECT * FROM subfamilia_producto sp where id_familia  =".$_REQUEST['slsfamilia'].";";
$result=$conexio->query($query);

$response=new stdClass();
$subfamilias=[];
while($fila=$result->fetch_assoc()){
	$responsedet= new stdClass();
	$responsedet->id=$fila['id_subfamilia'];
	$responsedet->subfamilia=$fila['subfamilia'];
	array_push($subfamilias, $responsedet);

}
$response=$subfamilias;
print(json_encode($response));
?>