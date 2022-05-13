<?php
ini_set("display_errors","1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

	$query="UPDATE operaciones
SET estatus='".base64_decode($_GET['status'])."', fecha_actualizacion=now()
WHERE id_operacion=".$_GET['id_operacion'];

	$result = $conexio->query($query);


if(base64_decode($_GET['status'])=="Entregado"){
	$query_venta="INSERT INTO operaciones
(folio_operacion, id_cliente, id_empleado, vigencia_operacion, tiempo_entrega, consideraciones, subtotal, iva, iva_porcentual, total, estatus, fecha_registro, fecha_actualizacion, metodo_pago, tipo_operacion)
SELECT  '', id_cliente, id_empleado, vigencia_operacion, tiempo_entrega, consideraciones, subtotal, iva, iva_porcentual, total, 'Pendiente pago', fecha_registro, now(), metodo_pago, 'Venta'
FROM operaciones where id_operacion =".$_GET['id_operacion'];

	$result_venta = $conexio->query($query_venta);
	$idventa=$conexio->insert_id;
	
	$folioventa="V-".date('ymd')."-";
	
	$query_folio="UPDATE operaciones SET folio_operacion='".$folioventa.$idventa."' where id_operacion=".$idventa;
	$resultfolioventa = $conexio->query($query_folio);

$query_detalle="INSERT INTO detalle_operaciones
(id_operacion, id_producto, cantidad, precio, descuento, subtotal)
select ".$idventa.", id_producto, cantidad, precio, descuento, subtotal from detalle_operaciones 
where id_operacion =".$_GET['id_operacion'];
//echo $query_detalle;
	$resultfolioventa = $conexio->query($query_detalle);




}

if($result!=0){
	$url=$_SERVER['HTTP_REFERER'];
}else{
	$url="error_page.php";
}
	header("Location: ".$url);

?>