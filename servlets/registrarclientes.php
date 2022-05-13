<?php
ini_set("display_errors","1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();


$queryvalidacliente="select * from clientes where nombre='".$_POST['txtnomcliente']."';";
$result = $conexio->query($queryvalidacliente);
if ($result->num_rows>0){
	echo "El cliente ya se encuentra registrado";
}else{	

$queryvalidacliente="select * from clientes where RFC='".$_POST['txtRFC']."';";
//echo $queryvalidaproducto;
$result = $conexio->query($queryvalidacliente);
if ($result->num_rows>0){
	echo "El RFC ya se encuentra registrado";
}else{	


	$query="INSERT INTO clientes
(nombre, telefono, email, calle, exterior, interior, cp, colonia, ciudad, estado, RFC, nom_contacto, descuento, id_empleado, estatus, fecha_registro, fecha_actualizacion, metodo_pago)
VALUES('".$_POST['txtnomcliente']."', '".$_POST['txttel']."', '".$_POST['txtemail']."', '".$_POST['txtcalleavenida']."', '".$_POST['txtnoext']."', '".$_POST['txtnoint']."', '".$_POST['txtcp']."', '".$_POST['slscolonia']."', '".$_POST['txtciudad']."', '".$_POST['txtedo']."', '".$_POST['txtRFC']."', '".$_POST['txtnomcontacto']."', ".$_POST['txtdescuento'].", ".$_POST['slsvendedor'].", '".$_POST['slsstatus']."', now(), now(),".$_POST['slsmetpagoclie'].");";

//	echo $query;
	$result = $conexio->query($query);
	$numero_cliente=$conexio->insert_id;

	$update_numero ="update clientes set numero_cliente =concat('CL-',LPAD(".$numero_cliente." , 5 , '0')) where id_cliente =".$numero_cliente;
	$resultupdate = $conexio->query($update_numero);
	print_r($result);
}

}






?>