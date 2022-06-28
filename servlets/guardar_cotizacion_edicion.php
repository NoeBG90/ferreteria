<?php
session_start();


include "../conexion/conexion.php";


$conexio =  conectar_bd();
$conexio->autocommit(FALSE);

$idcotizacion = $_POST['hddidcotizacion'];

$query = "UPDATE operaciones
          SET  id_cliente=" . $_POST['slsclientecot'] . ",  vigencia_operacion='" . $_POST['txtvigenciacot'] . "', 
              tiempo_entrega='" . $_POST['txtentregacot'] . "', consideraciones='" . $_POST['txtconsideracionescot'] . "', 
              metodo_pago='" . $_POST['rbtnpago'] . "', descuento=" . $_POST['descuentocot_edit'] . ",
              subtotal=" . $_POST['subtotal_cotiza_edit'] . ", iva=" . $_POST['iva_cotizacion_edit'] . ", iva_porcentual=" . $_POST['iva_cotiza_edit'] . ", 
              total=" . $_POST['total_cotiza_edit'] . ",   fecha_actualizacion=now()
WHERE id_operacion=" . $idcotizacion;
$result = $conexio->query($query);
if ($result) {

  $deletecotizacion = "DELETE FROM detalle_operaciones where id_operacion=" . $idcotizacion;
  $resultdeletecotizacion = $conexio->query($deletecotizacion);

  for ($i = 0; $i < sizeof($_SESSION['cotizacion_edit']['productos']); $i++) {
    $queryinsertdetcot = "INSERT INTO detalle_operaciones (id_operacion, id_producto, cantidad, precio, descuento, subtotal)
        VALUES(" . $idcotizacion . ", " . $_SESSION['cotizacion_edit']['productos'][$i]->id . ", " . $_SESSION['cotizacion_edit']['productos'][$i]->cantidad .
      ", " . $_SESSION['cotizacion_edit']['productos'][$i]->precio_venta . "," . $_SESSION['cotizacion_edit']['productos'][$i]->descuento .
      "," . $_SESSION['cotizacion_edit']['productos'][$i]->subtotal . ");";

    $result = $conexio->query($queryinsertdetcot);
    if (!$result) {
      $conexio->rollback();
    }
  }
  unset($_SESSION['cotizacion_edit']['productos']);
  unset($_SESSION['cotizacion_edit']['tabla']);
  echo "1";
} else {
  echo "Error al registrar la cotización";
}

$conexio->commit();
$conexio->close();
