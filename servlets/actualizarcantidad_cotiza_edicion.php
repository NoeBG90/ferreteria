<?php
session_start();
include "./utilerias.php";

if ($_POST['tipo'] === 'agregar') {

  $flag_cotiza = 0;
  if (!isset($_SESSION['cotizacion_edit']['productos'])) {
    $_SESSION['cotizacion_edit']['productos'] = array(); //Validamos si existe la cotizacion
    $flag_cotiza = 0;
  } else {
    $flag_cotiza = validaproducto($_SESSION['cotizacion_edit']['productos'], $_POST['producto']);
  }

  if ($flag_cotiza == 0) {

    include "../conexion/conexion.php";
    $conexio =  conectar_bd();
    $query = "SELECT * FROM productos WHERE id_producto=" . $_POST['producto'];
    $result = $conexio->query($query);
    $posiciones = sizeof($_SESSION['cotizacion_edit']['productos']);

    while ($fila = $result->fetch_assoc()) {
      $objdetalle = new stdClass();
      $objdetalle->id       = $fila['id_producto'];
      $objdetalle->producto = $fila['producto'];
      $objdetalle->stok     = 1; //Cuando se agrega el producto se inicia en 1
      $objdetalle->sku      = $fila['SKU'];
      $objdetalle->precio_venta = $fila['precio_venta'];
      $objdetalle->descuento = 0;
      $objdetalle->subtotal   = 0;
      $objdetalle->precio_compra = $fila['precio_compra'];
      $_SESSION['cotizacion_edit']['productos'][$posiciones] = $objdetalle;
    }

    generarTablaCotizacionEditar();

    print_r($_SESSION['cotizacion_edit']['tabla']);
    $conexio->close();
  } else {
    print_r($_SESSION['cotizacion_edit']['tabla']);
  }
} else if ($_POST['tipo'] === 'modificar') {
  if (!is_nan(intval($_POST['cantidad']))) {
    $contador = 0;
    $tabla = "";
    $cantidad = 0;

    $i = $_POST['posicion'];
    $_SESSION['cotizacion_edit']['productos'][$i]->stok         = $_POST['cantidad'];
    $_SESSION['cotizacion_edit']['productos'][$i]->precio_venta = $_POST['precio'];
    $_SESSION['cotizacion_edit']['productos'][$i]->descuento    = $_POST['descuento'];
    $_SESSION['cotizacion_edit']['productos'][$i]->subtotal     = $_POST['subtotal'];

    generarTablaCotizacionEditar();
    print_r($_SESSION['cotizacion_edit']['tabla']);
  } else {
    print_r($_SESSION['cotizacion_edit']['tabla']);
  }
} else if ($_POST['tipo'] === 'eliminar') {
  $contador = 0;
  $tabla = "";
  $cantidad = 0;

  if (count($_SESSION['cotizacion_edit']['productos']) > 1) {
    array_splice($_SESSION['cotizacion_edit']['productos'], intval($_POST['id']), 1);
  } else {
    array_splice($_SESSION['cotizacion_edit']['productos'], intval($_POST['id']));
  }

  $_SESSION['cotizacion_edit']['tabla'] = "";

  if (count($_SESSION['cotizacion_edit']['productos']) <= 0) {
    unset($_SESSION['cotizacion_edit']);
    print_r(
      "
      <tr class='text-center'>
        <th colspan='8'>No hay productos agregados</th>
      </tr>
    "
    );
  } else {
    generarTablaCotizacionEditar();
    print_r($_SESSION['cotizacion_edit']['tabla']);
  }
}


function validaproducto($arreglo, $id_producto)
{
  foreach ($arreglo as $producto) {
    if ($id_producto == $producto->id) {
      return 1;
    }
  }
  return 0;
}
