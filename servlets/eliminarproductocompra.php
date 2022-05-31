<?php

session_start();

$contador = 0;
$tabla = "";
$cantidad = 0;

if (count($_SESSION['productos']) > 1) {
  array_splice($_SESSION['productos'], intval($_POST['id']), 1);
} else {
  array_splice($_SESSION['productos'], intval($_POST['id']));
}

$_SESSION['tabla'] = "";

if (count($_SESSION['productos']) <= 0) {
  unset($_SESSION['tabla']);
  print_r(
    "
    <tr class='text-center'>
      <th colspan='8'>No hay productos agregados</th>
    </tr>
  "
  );
} else {
  for ($i = 0; $i < sizeof($_SESSION['productos']); $i++) {
    $subTotal = $_SESSION['productos'][$i]->precio_compra * $_SESSION['productos'][$i]->stok;
    $_SESSION['tabla'] .=
      "<tr id='" . $i . "'>
          <td class='id' >" . $i . "</td>
          <td >" . $_SESSION['productos'][$i]->sku . "</td>
          <td >" . $_SESSION['productos'][$i]->producto . "</td>
          <td > <input type='text' class='cantidades col-sm-9 text-left' name='txtcantidad'  id='txtcantidad" . $i . "' value='" . $_SESSION['productos'][$i]->stok . "' ></td>
          <td > <input type='text' name='txtprecioventa' id='txtprecioventa" . $i . "' class='precios col-sm-9 text-left'  value='" . $_SESSION['productos'][$i]->precio_compra . "' > </td>
          <td > <input type='text' class='subtotal col-sm-9 text-left'   name='txtsubtotal'    id='txtsubtotal" . $i . "'      value='" . $subTotal . "' readonly > </td>
          <td ><button type='button' class='btn btn-danger' id='btnDelProCompra' onclick='eliminarProductoCompra(" . $i . ")'><i class='fa fa-trash'></i></button></td>
        </tr>";
  }
  print_r($_SESSION['tabla']);
}
