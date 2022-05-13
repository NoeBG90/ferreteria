<?php
ini_set("display_errors","1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();


$queryvalidafamproducto="select * from familia_producto where familia='".$_POST['txtfamproducto']."';";
$result = $conexio->query($queryvalidafamproducto);
if ($result->num_rows>0){
	echo "La familia de producto ya se encuentra registrada";
}else{	
	$query="INSERT INTO familia_producto
(familia, descripcion, estatus, fecha_registro, fecha_actualizacion)
VALUES('".$_POST['txtfamproducto']."', '".$_POST['textafamdescripcion']."', '".$_POST['slsfamstatus']."', now(), now());";
	//echo $query;
	$result = $conexio->query($query);

	$numero_familiaprod=$conexio->insert_id;

	$update_numero ="update familia_producto set numero_familiaprod =concat('FP-',LPAD(".$numero_familiaprod." , 5 , '0')) where id_familia =".$numero_familiaprod;
	$resultupdate = $conexio->query($update_numero);


	print_r($result);
}

?>