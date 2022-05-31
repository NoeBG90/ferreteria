<?php
session_start();
if ($_POST['cantidad'] != 'NaN') {
  $contador = 0;
  $tabla = "";
  $cantidad = 0;
  //print_r($_SESSION['productos']);
  $_SESSION['productos'][$_POST['posicion']]->stok = $_POST['cantidad'];
  $_SESSION['productos'][$_POST['posicion']]->precio_compra = $_POST['precio'];

  //print_r($_SESSION['productos']);
  $_SESSION['tabla'] = "";
  for ($i = 0; $i < sizeof($_SESSION['productos']); $i++) {
    $subTotal = $_SESSION['productos'][$i]->precio_compra * $_SESSION['productos'][$i]->stok;

    $_SESSION['tabla'] .=
      "<tr id='" . $i . "'>
        <td class='id' >" . $i . "</td><td >" . $_SESSION['productos'][$i]->sku . "</td>
        <td >" . $_SESSION['productos'][$i]->producto . "</td>
        <td > <input type='text' class='cantidades col-sm-9 text-left' name='txtcantidad'    id='txtcantidad" . $i . "'      value='" . $_SESSION['productos'][$i]->stok . "' ></td>
        <td > <input type='text' class='precios col-sm-9 text-left'    name='txtprecioventa' id='txtprecioventa" . $i . "'   value='" . $_SESSION['productos'][$i]->precio_compra . "' ></td>
        <td > <input type='text' class='subtotal col-sm-9 text-left'   name='txtsubtotal'    id='txtsubtotal" . $i . "'      value='" . $subTotal . "' readonly > </td>
        <td ><button type='button' class='btn btn-danger' id='btnDelProCompra' onclick='eliminarProductoCompra(" . $i . ")'><i class='fa fa-trash'></i></button></td>
      </tr>";
  }
  print_r($_SESSION['tabla']);
} else {
  print_r($_SESSION['tabla']);
}
