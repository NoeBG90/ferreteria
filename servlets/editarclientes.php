<?php
ini_set("display_errors","1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

	$query="UPDATE clientes
SET nombre='".$_POST['txtnomcliente']."', telefono='".$_POST['txttel']."', email='".$_POST['txtemail']."', calle='".$_POST['txtcalleavenida']."', exterior='".$_POST['txtnoext']."', interior='".$_POST['txtnoint']."', cp='".$_POST['txtcp']."', colonia='".$_POST['slscolonia']."', ciudad='".$_POST['txtciudad']."', estado='".$_POST['txtedo']."', RFC='".$_POST['txtRFC']."', nom_contacto='".$_POST['txtnomcontacto']."', descuento=".$_POST['txtdescuento'].", id_empleado='".$_POST['slsvendedor']."', estatus='".$_POST['slsstatus']."',fecha_actualizacion=now(),metodo_pago='".$_POST['slsmetpagoclie']"'
WHERE id_cliente=".$_POST['idc'].";";

//	echo $query;
	$result = $conexio->query($query);

	print_r($result);


?>