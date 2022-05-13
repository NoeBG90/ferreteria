<?php
ini_set("display_errors","1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();


$queryvalidafamproducto="SELECT * FROM subfamilia_producto sp where subfamilia ='".$_POST['txtsubfamproducto']."'";
$result = $conexio->query($queryvalidafamproducto);
if ($result->num_rows>0){
	echo "La familia de producto ya se encuentra registrada";
}else{	
	$query="INSERT INTO subfamilia_producto
(subfamilia, descripcion, estatus, fecha_registro, fecha_actualizacion, numero_subfamiliaprod, id_familia)
VALUES('".$_POST['txtsubfamproducto']."', '".$_POST['textasubfamdescripcion']."', '".$_POST['slssubfamstatus']."', now(), now(), '".$_POST['txtcodsubfamprod']."', ".$_POST['slsfamilias'].")";
	//echo $query;
	$result = $conexio->query($query);

	$numero_familiaprod=$conexio->insert_id;



	print_r($result);
}

?>