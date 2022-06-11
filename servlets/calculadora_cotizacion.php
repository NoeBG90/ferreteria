<?php
session_start();
include "./utilerias.php";

if ($_POST['tipo'] === 'agregar') {

  $flag_cotiza = 0;
  if (!isset($_SESSION['operacion']['productos'])) {
    $_SESSION['operacion']['productos'] = array(); //Validamos si existe la cotizacion
    $flag_cotiza = 0;
  } else {
    $flag_cotiza = validaproducto($_SESSION['operacion']['productos'], $_POST['producto']);
  }

  if ($flag_cotiza == 0) {

    include "../conexion/conexion.php";
    $conexio =  conectar_bd();
    $query = "SELECT * FROM productos WHERE id_producto=" . $_POST['producto'];
    $result = $conexio->query($query);
    $posiciones = sizeof($_SESSION['operacion']['productos']);

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
      $_SESSION['operacion']['productos'][$posiciones] = $objdetalle;
    }

    generarTablaOperacion();

    print_r($_SESSION['operacion']['tabla']);
    $conexio->close();
  } else {
    print_r($_SESSION['operacion']['tabla']);
  }
} else if ($_POST['tipo'] === 'actualizar') {

  if (!is_nan(intval($_POST['cantidad']))) {

    $contador = 0;
    $tabla = "";
    $cantidad = 0;
    $index = $_POST['posicion'];
    $_SESSION['operacion']['productos'][$index]->stok         = $_POST['cantidad'];
    $_SESSION['operacion']['productos'][$index]->precio_venta = $_POST['precio'];
    $_SESSION['operacion']['productos'][$index]->descuento    = $_POST['descuento'];
    $_SESSION['operacion']['productos'][$index]->subtotal     = $_POST['subtotal'];

    generarTablaOperacion();

    print_r($_SESSION['operacion']['tabla']);
  } else {
    print_r($_SESSION['operacion']['tabla']);
  }
} else if ($_POST['tipo'] === 'eliminar') {
  $contador = 0;
  $tabla = "";
  $cantidad = 0;

  if (count($_SESSION['operacion']['productos']) > 1) {
    array_splice($_SESSION['operacion']['productos'], intval($_POST['id']), 1);
  } else {
    array_splice($_SESSION['operacion']['productos'], intval($_POST['id']));
  }

  $_SESSION['operacion']['tabla'] = "";

  if (count($_SESSION['operacion']['productos']) <= 0) {
    unset($_SESSION['operacion']);
    print_r(
      "
      <tr class='text-center'>
        <th colspan='8'>No hay productos agregados</th>
      </tr>
    "
    );
  } else {
    generarTablaOperacion();
    print_r($_SESSION['operacion']['tabla']);
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
