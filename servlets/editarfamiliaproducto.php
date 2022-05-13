<?php
ini_set("display_errors","1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

	$query="UPDATE familia_producto
SET familia='".$_POST['txtfamproducto']."', descripcion='".$_POST['textafamdescripcion']."', estatus='".$_POST['slsfamstatus']."', fecha_actualizacion=now()
WHERE id_familia=".$_POST['idfp'].";";

//	echo $query;
	$result = $conexio->query($query);

	print_r($result);


?>