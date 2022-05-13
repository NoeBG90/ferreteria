<?php
ini_set("display_errors","1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();


$queryvalidaproveedor="select * from proveedores where nombre='".$_POST['txtnomproveedor']."';";
$result = $conexio->query($queryvalidaproveedor);
if ($result->num_rows>0){
	echo "El proveedor ya se encuentra registrado";
}else{	
	$query="INSERT INTO proveedores
(nombre, calle, exterior, interior, cp, colonia, ciudad, estado, pais, telefono, nom_contacto, cuenta_bancaria, fecha_registro, fecha_actualizacion, estatus, email, prod_vendidos)
VALUES('".$_POST['txtnomproveedor']."', '".$_POST['txtcalleavenida']."', '".$_POST['txtnoext']."', '".$_POST['txtnoint']."', '".$_POST['txtcp']."', '".$_POST['slscolonia']."', '".$_POST['txtciudad']."', '".$_POST['txtedo']."', '".$_POST['txtpais']."', '".$_POST['txttel']."', '".$_POST['txtnomcontacto']."', '".$_POST['txtcuentabancaria']."', now(), now(), '".$_POST['slsstatus']."', '".$_POST['txtemail']."','".$_POST['textaprodvendprov']."');";

	//echo $query;
	$result = $conexio->query($query);

	$numero_proveedor=$conexio->insert_id;

	$update_numero ="update proveedores set numero_proveedor =concat('PV-',LPAD(".$numero_proveedor." , 5 , '0')) where id_proveedor =".$numero_proveedor;
	$resultupdate = $conexio->query($update_numero);

	print_r($result);
}


?>