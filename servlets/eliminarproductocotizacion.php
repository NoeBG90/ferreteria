<?php

session_start();

$contador = 0;
$tabla = "";
$cantidad = 0;

if (count($_SESSION['productos_cotizacion']) > 1) {
  array_splice($_SESSION['productos_cotizacion'], intval($_POST['id']), 1);
} else {
  array_splice($_SESSION['productos_cotizacion'], intval($_POST['id']));
}

$_SESSION['tabla_cotizacion'] = "";

if (count($_SESSION['productos_cotizacion']) <= 0) {
  unset($_SESSION['tabla_cotizacion']);
  print_r(
    "
    <tr class='text-center'>
      <th colspan='8'>No hay productos agregados</th>
    </tr>
  "
  );
} else {
  for ($i = 0; $i < sizeof($_SESSION['productos_cotizacion']); $i++) {
    //print_r($_SESSION['productos_cotizacion'][$i]);
    $subTotal = $_SESSION['productos_cotizacion'][$i]->stok * $_SESSION['productos_cotizacion'][$i]->precio_venta;
    $_SESSION['tabla_cotizacion'] .=
      "<tr class='cotizacion' id='" . $i . "'>
        <td >" . $i . "</td>
        <td >" . $_SESSION['productos_cotizacion'][$i]->sku . "</td>
        <td >" . $_SESSION['productos_cotizacion'][$i]->producto . "</td>
        <td >
          <input type='hidden' class='precio_compra'                name='hddpreciocompra'         id='hddpreciocompra" . $i . "' value='" . $_SESSION['productos_cotizacion'][$i]->precio_compra * 1.05 . "' >
          <input type='text' class='cantidades col-sm-9 text-center focusNext' name='txtcantidad'  id='txtcantidad" . $i . "'     value='" . $_SESSION['productos_cotizacion'][$i]->stok . "'         ></td>
        <td > <input type='text' class='precios col-sm-9 text-center' name='txtprecioventa'            id='txtprecioventa" . $i . "'  value='" . $_SESSION['productos_cotizacion'][$i]->precio_venta . "' readonly >
        </td>
        <td > <input type='text' class='descuentos col-sm-9 text-center focusDesc' name='txtdescuento' id='txtdescuento" . $i . "'    value='" . $_SESSION['productos_cotizacion'][$i]->descuento . "'  ></td>
        <td > <input type='text' class='subtotal col-sm-9 text-center'             name='txtsubtotal'  id='txtsubtotal" . $i . "'     value='" . $subTotal . "' readonly ></td>
        <td > <button type='button' class='btn btn-danger btnEliminarCotiza' onclick='eliminarCotizacion(" . $i . ")'><i class='fa fa-trash'></i></button> </td>
      </tr>";
  }
  print_r($_SESSION['tabla_cotizacion']);
}
