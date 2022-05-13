<?php
include "../conexion/conexion.php";
$conexio =  conectar_bd();

$queryvalidaproducto="select * from productos where producto='".trim($_POST['txtproducto'])."';";

$result = $conexio->query($queryvalidaproducto);

if ($result->num_rows==0){
	echo "true";
}else{	
echo "false";
}


?>