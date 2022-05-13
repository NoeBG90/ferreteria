<?php
ini_set("display_errors","1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

//print_r($_POST);
$query=" INSERT INTO abonos
(id_operacion, metodo_pago, cantidad_abono, saldo_final, fecha_transaccion, saldo_inicial)
VALUES(".$_POST['id_venta'].", '".$_POST['rbtnpago']."', ".$_POST['textabonoventa'].", ".$_POST['txtsaldodeuventa'].", now(),".$_POST['textabonoiventa'].");";
//echo $query;
$resultabono=$conexio->query($query);

$numero_abono=$conexio->insert_id;

	$update_numero ="update abonos set numero_abono =concat('ABO-',LPAD(".$numero_abono." , 5 , '0')) where id_abono =".$numero_abono;
	$resultupdate = $conexio->query($update_numero);

if($resultabono!=0){
	$mensaje="1";
}else{
	$mensaje="Error al registrar el  abono";
}
echo $mensaje;
?>