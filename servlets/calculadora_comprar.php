<?php
session_start();
$flag_cotiza = 0;
if (!isset($_SESSION['productos'])) {
  //Validamos si existe la cotizacion
  $_SESSION['productos'] = array();

  $flag_cotiza = 0;
} else {
  //echo "Entra al else";
  $flag_cotiza = validaproducto($_SESSION['productos'], $_POST['producto']);
  //echo "Flag:".$flag_cotiza;
}



if ($flag_cotiza == 0) {

  include "../conexion/conexion.php";
  $conexio =  conectar_bd();
  $query = "SELECT * FROM productos WHERE id_producto=" . $_POST['producto'];
  $result = $conexio->query($query);
  $posiciones = sizeof($_SESSION['productos']);
  while ($fila = $result->fetch_assoc()) {
    $objdetalle = new stdClass();
    $objdetalle->id = $fila['id_producto'];
    $objdetalle->producto = $fila['producto'];
    $objdetalle->stok = $fila['stock'];
    $objdetalle->sku = $fila['SKU'];
    $objdetalle->precio_compra = $fila['precio_compra'];
    $objdetalle->fila =
      "<tr>
        <td class='id' >" . count($_SESSION['productos']) . "</td><td >" . $fila['SKU'] . "</td>
        <td >" . $fila['producto'] . "</td>
        <td > <input type='text' class='cantidades col-sm-9 text-left' name='txtcantidad'  id='txtcantidad" . count($_SESSION['productos']) . "' ></td>
        <td > <input type='text' name='txtprecioventa' id='txtprecioventa" . count($_SESSION['productos']) . "' class='precios col-sm-9 text-left' value='" . $fila['precio_compra'] . "' readonly></td>
        <td > <input type='text' class='subtotal col-sm-9 text-left' name='txtsubtotal' id='txtsubtotal" . count($_SESSION['productos']) . "' readonly ></td>
      </tr>";
    $_SESSION['productos'][$posiciones] = $objdetalle;
  }
  $_SESSION['tabla'] = "";

  //print_r($_SESSION['productos']);
  for ($i = 0; $i < sizeof($_SESSION['productos']); $i++) {
    $subTotal = $_SESSION['productos'][$i]->precio_compra * $_SESSION['productos'][$i]->stok;

    $_SESSION['tabla'] .=
      "<tr>
        <td class='id' >" . $i . "</td><td >" . $_SESSION['productos'][$i]->sku . "</td>
        <td >" . $_SESSION['productos'][$i]->producto . "</td>
        <td > <input type='text' class='cantidades col-sm-9 text-left' name='txtcantidad'    id='txtcantidad" . $i . "'     value='" . $_SESSION['productos'][$i]->stok . "' ></td>
        <td > <input type='text' class='precios col-sm-9 text-left'    name='txtprecioventa' id='txtprecioventa" . $i . "'  value='" . $_SESSION['productos'][$i]->precio_compra . "' readonly></td>
        <td > <input type='text' class='subtotal col-sm-9 text-left'   name='txtsubtotal'    id='txtsubtotal" . $i . "'     value='" . $subTotal . "' readonly ></td>
      </tr>";
  }
  print_r($_SESSION['tabla']);
  $result->close();
  $conexio->close();
} else {
  //  echo "Producto ya agregado";
  print_r($_SESSION['tabla']);
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
