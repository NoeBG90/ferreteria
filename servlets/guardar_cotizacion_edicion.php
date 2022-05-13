<?php
session_start();


include "../conexion/conexion.php";


$conexio =  conectar_bd();
$conexio->autocommit(FALSE);

$idcotizacion=$_POST['hddidcotizacion'];

$query="UPDATE operaciones
SET  id_cliente=".$_POST['slsclientecot'].",  vigencia_operacion='".$_POST['txtvigenciacot']."', tiempo_entrega='".$_POST['txtentregacot']."', consideraciones='".$_POST['txtconsideracionescot']."', subtotal='".$_POST['subtotal_cotiza']."', iva='".$_POST['iva_cotizacion']."', iva_porcentual='".$_POST['iva_cotiza_edicion']."', total=".$_POST['total_cotiza'].",   fecha_actualizacion=now()
WHERE id_operacion=".$idcotizacion;
$result = $conexio->query($query);

//print_r($query);

if($result!=0){

  $deletecotizacion="DELETE FROM detalle_operaciones where id_operacion=".$idcotizacion;
  $resultdeletecotizacion = $conexio->query($deletecotizacion);


  for($i=0;$i<sizeof($_SESSION['productos_cotizacion_edicion']);$i++){


    $queryinsertdetcot="INSERT INTO detalle_operaciones (id_operacion, id_producto, cantidad, precio, descuento, subtotal)
    VALUES(".$idcotizacion.", ".$_SESSION['productos_cotizacion_edicion'][$i]->id.", ".$_SESSION['productos_cotizacion_edicion'][$i]->stok.", ".$_SESSION['productos_cotizacion_edicion'][$i]->precio_venta.",".$_SESSION['productos_cotizacion_edicion'][$i]->descuento.",".$_SESSION['productos_cotizacion_edicion'][$i]->subtotal.");";

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


?>
