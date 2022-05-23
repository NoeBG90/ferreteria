<?php
session_start();
ini_set("display_errors", "1");
//print_r($_POST);
//print_r($_SESSION['productos']);

include "../conexion/conexion.php";
$conexio =  conectar_bd();
$conexio->autocommit(FALSE);

$query = "INSERT INTO compras
(id_proveedor, fecha_compra, folio_compra, folio_factura, id_empleado,
total, estatus, fecha_registro, fecha_actualizacion, subtotal, iva_monto, iva_porcentual)
VALUES(" . $_POST['slsproveedor'] . ", '" . $_POST['txtfecha_compra'] . "', '', '" . $_POST['txtfolio_factura'] . "', " . $_POST['hddide'] . ", " . $_POST['total_compra'] . ", 'Pendiente_Pago', now(), now(),'" . $_POST['subtotal_compra'] . "','" . $_POST['iva_monto'] . "','" . $_POST['iva_compra'] . "');";
$result = $conexio->query($query);
$idcompra = $conexio->insert_id;

$foliocompra = "COM-" . date('ymd') . "-" . $idcompra;
$query_folio = "UPDATE compras SET folio_compra='" . $foliocompra . "' where id_compra=" . $idcompra;
$resultfolio = $conexio->query($query_folio);

if ($result != 0) {
  for ($i = 0; $i < sizeof($_SESSION['productos']); $i++) {

    $queryinsertdet = "INSERT INTO detalle_compras(id_compra, id_producto, cantidad, precio_compra)VALUES(" . $idcompra . ", " . $_SESSION['productos'][$i]->id . ", " . $_SESSION['productos'][$i]->stok . ", " . $_SESSION['productos'][$i]->precio_compra . ");";
    $result = $conexio->query($queryinsertdet);
    $queryupdateprod = "UPDATE productos SET stock=stok+" . $_SESSION['productos'][$i]->stok . ",
    precio_compra=" . $_SESSION['productos'][$i]->precio_compra . ",fecha_actualizacion=now() WHERE id_producto=" . $_SESSION['productos'][$i]->id . ";";

    $resultupdate = $conexio->query($queryupdateprod);
    if ($result == 0) {
      $conexio->rollback();
    }
  }
  unset($_SESSION['productos']);
  echo "1";
} else {
  echo "Error al registrar la compra";
}

$conexio->commit();
