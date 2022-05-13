<?php
session_start();
date_default_timezone_set('America/Mexico_City');
//ini_set("display_errors","1");
//print_r($_POST);
//print_r($_SESSION);

include "../conexion/conexion.php";


$conexio =  conectar_bd();
$conexio->autocommit(FALSE);

if($_POST['radioInline']=='cotizacion'){
  $query="INSERT INTO cotizaciones
(folio_cotizacion, id_cliente, id_empleado, vigencia_cotizacion, tiempo_entrega, consideraciones, subtotal, iva, iva_porcentual, total, estatus, fecha_registro, fecha_actualizacion,metodo_pago)
VALUES('', ".$_POST['slsclientecot'].", ".$_POST['ide'].", '".$_POST['txtvigenciacot']."', '".$_POST['txtentregacot']."', '".$_POST['txtconsideracionescot']."','".$_POST['subtotal_cotiza']."',".$_POST['iva_cotiza'].",".$_POST['iva_cotizacion'].",".$_POST['total_cotiza'].", 'Pendiente_Pago', now(), now(),'".$_POST['rbtnpago']."');";
$result = $conexio->query($query);
$idcotizacion=$conexio->insert_id;

$foliocotizacion="COT-".date('ymd')."-".$idcotizacion;
$query_folio="UPDATE cotizaciones SET folio_cotizacion='".$foliocotizacion."' where id_cotizacion=".$idcotizacion;
$resultfoliocot = $conexio->query($query_folio);

if($result!=0){
  for($i=0;$i<sizeof($_SESSION['productos_cotizacion']);$i++){


    $queryinsertdetcot="INSERT INTO detalle_cotizaciones (id_cotizacion, id_producto, cantidad, precio, descuento, subtotal)
    VALUES(".$idcotizacion.", ".$_SESSION['productos_cotizacion'][$i]->id.", ".$_SESSION['productos_cotizacion'][$i]->stok.", ".$_SESSION['productos_cotizacion'][$i]->precio_venta.",".$_SESSION['productos_cotizacion'][$i]->descuento.",".$_SESSION['productos_cotizacion'][$i]->subtotal.");";

   // echo $queryinsertdetcot;
    $result = $conexio->query($queryinsertdetcot);
   if($result==0 ){
      $conexio->rollback();
    }
  }
  echo "1";
}else{
echo "Error al registrar la cotización";
}

$conexio->commit();

}elseif ($_POST['radioInline']=='pedido'){
  
  
}elseif ($_POST['radioInline']=='venta'){
  
}else{

}



session_unset($_SESSION['tabla_cotizacion']);
?>
