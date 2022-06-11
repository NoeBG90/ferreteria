<?php

session_start();

if (!is_nan(intval($_POST['cantidad']))) {

  $contador = 0;
  $tabla = "";
  $cantidad = 0;

  $_SESSION['operacion']['productos'][$_POST['posicion']]->stok = $_POST['cantidad'];
  $_SESSION['operacion']['productos'][$_POST['posicion']]->precio_venta = $_POST['precio'];
  $_SESSION['operacion']['productos'][$_POST['posicion']]->descuento = $_POST['descuento'];
  $_SESSION['operacion']['productos'][$_POST['posicion']]->subtotal = $_POST['subtotal'];

  $_SESSION['tabla_cotizacion'] = "";

  for ($i = 0; $i < sizeof($_SESSION['operacion']['productos']); $i++) {
    //print_r($_SESSION['productos_cotizacion'][$i]);
    $subTotal = $_SESSION['operacion']['productos'][$i]->stok * $_SESSION['operacion']['productos'][$i]->precio_venta;
    $_SESSION['operacion']['tabla'] .=
      "<tr class='cotizacion' id='" . $i . "'>
        <td >" . $i . "</td>
        <td >" . $_SESSION['operacion']['productos'][$i]->sku . "</td>
        <td >" . $_SESSION['operacion']['productos'][$i]->producto . "</td>
        <td >
          <input type='hidden' class='precio_compra'                name='hddpreciocompra'         id='hddpreciocompra" . $i . "' value='" . $_SESSION['operacion']['productos'][$i]->precio_compra * 1.05 . "' >
          <input type='text' class='cantidades col-sm-9 text-center focusNext' name='txtcantidad'  id='txtcantidad" . $i . "'     value='" . $_SESSION['operacion']['productos'][$i]->stok . "'         ></td>
        <td > <input type='text' class='precios col-sm-9 text-center' name='txtprecioventa'            id='txtprecioventa" . $i . "'  value='" . $_SESSION['operacion']['productos'][$i]->precio_venta . "' readonly >
        </td>
        <td > <input type='text' class='descuentos col-sm-9 text-center focusDesc' name='txtdescuento' id='txtdescuento" . $i . "'    value='" . $_SESSION['operacion']['productos'][$i]->descuento . "'  ></td>
        <td > <input type='text' class='subtotal col-sm-9 text-center'             name='txtsubtotal'  id='txtsubtotal" . $i . "'     value='" . $subTotal . "' readonly ></td>
        <td > <button type='button' class='btn btn-danger btnEliminarCotiza' onclick='eliminarCotizacion(" . $i . ")'><i class='fa fa-trash'></i></button> </td>
      </tr>";
  }
  print_r($_SESSION['operacion']['tabla']);
} else {
  print_r($_SESSION['operacion']['tabla']);
}
