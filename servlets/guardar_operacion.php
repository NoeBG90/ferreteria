<?php

session_start();
date_default_timezone_set('America/Mexico_City');

include "../conexion/conexion.php";

if ($_POST['radioInline'] == 'Cotizacion') {
  $status_operacion = "Pendiente";
  $foliocotizacion = "COT-" . date('ymd') . "-";
  $mensajeop = "Error al registrar Cotización";
} elseif ($_POST['radioInline'] == 'Pedido') {
  $status_operacion = "Pedido Pendiente";
  $foliocotizacion = "P-" . date('ymd') . "-";
  $mensajeop = "Error al registrar Pedido";
} elseif ($_POST['radioInline'] == 'Venta') {
  $status_operacion = "Pendiente Pago";
  $foliocotizacion = "V-" . date('ymd') . "-";
  $mensajeop = "Error al registrar Venta";
} else {
  $status_operacion = "NA";
  $foliocotizacion = "NA";
  $mensajeop = "Error al registrar la operación";
}

$conexio =  conectar_bd();
$conexio->autocommit(FALSE);

$query = "INSERT INTO operaciones
(folio_operacion, id_cliente, id_empleado, vigencia_operacion, tiempo_entrega, consideraciones, subtotal, iva, iva_porcentual, total, estatus, fecha_registro, fecha_actualizacion,metodo_pago,tipo_operacion)
VALUES('', " . $_POST['slsclientecot'] . ", " . $_POST['ide'] . ", '" . $_POST['txtvigenciacot'] . "', '" . $_POST['txtentregacot'] . "', '" . $_POST['txtconsideracionescot'] . "','" . $_POST['subtotal_cotiza'] . "'," . $_POST['iva_cotiza'] . "," . $_POST['iva_cotizacion'] . "," . $_POST['total_cotiza'] . ", '" . $status_operacion . "', now(), now(),'" . $_POST['rbtnpago'] . "','" . $_POST['radioInline'] . "');";
$result = $conexio->query($query);
$idcotizacion = $conexio->insert_id;


$query_folio = "UPDATE operaciones SET folio_operacion='" . $foliocotizacion . $idcotizacion . "' where id_operacion=" . $idcotizacion;
$resultfoliocot = $conexio->query($query_folio);

if ($result != 0) {
  for ($i = 0; $i < sizeof($_SESSION['productos_cotizacion']); $i++) {


    $queryinsertdetcot = "INSERT INTO detalle_operaciones (id_operacion, id_producto, cantidad, precio, descuento, subtotal)
    VALUES(" . $idcotizacion . ", " . $_SESSION['productos_cotizacion'][$i]->id . ", " . $_SESSION['productos_cotizacion'][$i]->stok . ", " . $_SESSION['productos_cotizacion'][$i]->precio_venta . "," . $_SESSION['productos_cotizacion'][$i]->descuento . "," . $_SESSION['productos_cotizacion'][$i]->subtotal . ");";


    $result = $conexio->query($queryinsertdetcot);
    if ($result == 0) {
      $conexio->rollback();
    } else {
      if ($_POST['radioInline'] == 'Pedido') {
        $queryactualizaStock = "UPDATE productos SET stock=stok-" . $_SESSION['productos_cotizacion'][$i]->stok . " WHERE id_producto=" . $_SESSION['productos_cotizacion'][$i]->id;
        $resultstok = $conexio->query($queryactualizaStock);
        if ($resultstok == 0) {
          $conexio->rollback();
        }

        $query_updatepedido = "UPDATE operaciones SET estatus='Pedido Generado',fecha_actualizacion=now() WHERE folio_operacion='" . $_POST['idrecuperado'] . "';";
        $resultupdate_pedido = $conexio->query($query_updatepedido);
      } elseif ($_POST['radioInline'] == 'Venta') {
        if ($_POST['recuperado'] == 0) {
          $queryactualizaStock = "UPDATE productos SET stock=stok-" . $_SESSION['productos_cotizacion'][$i]->stok . " WHERE id_producto=" . $_SESSION['productos_cotizacion'][$i]->id;
          $resultstok = $conexio->query($queryactualizaStock);
          if ($resultstok == 0) {
            $conexio->rollback();
          }
        }

        $query_updatepedido = "UPDATE operaciones SET estatus='Venta Generada',fecha_actualizacion=now() WHERE folio_operacion='" . $_POST['idrecuperado'] . "';";
        $resultupdate_pedido = $conexio->query($query_updatepedido);
      }
    }
  }
  echo "1";
} else {
  echo $mensajeop;
}

$conexio->commit();





unset($_SESSION['tabla_cotizacion']);
