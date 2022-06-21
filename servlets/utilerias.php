<?php

function generarTablaOperacion()
{
  $_SESSION['operacion']['tabla'] = "";

  if (count($_SESSION['operacion']['productos']) > 0) {
    for ($i = 0; $i < sizeof($_SESSION['operacion']['productos']); $i++) {

      $_SESSION['operacion']['tabla'] .=
        "<tr class='cotizacion' id='" . $i . "'>
            <td >" . ($i + 1) . "</td>
            <td >" . $_SESSION['operacion']['productos'][$i]->sku . "</td>
            <td >" . $_SESSION['operacion']['productos'][$i]->producto . "</td>
            <td >
              <input type='hidden' class='precio_compra'                name='hddpreciocompra'         id='hddpreciocompra" . $i . "' value='" . $_SESSION['operacion']['productos'][$i]->precio_compra . "' >
              <input type='text' class='cantidades col-sm-9 text-center focusNext' name='txtcantidad'  id='txtcantidad" . $i . "'     value='" . $_SESSION['operacion']['productos'][$i]->cantidad . "'         ></td>
            <td > <input type='text' class='precios col-sm-9 text-center' name='txtprecioventa'            id='txtprecioventa" . $i . "'  value='" . $_SESSION['operacion']['productos'][$i]->precio_venta . "' readonly >
            </td>
            <td > <input type='text' class='descuentos col-sm-9 text-center focusDesc' name='txtdescuento' id='txtdescuento" . $i . "'    value='" . $_SESSION['operacion']['productos'][$i]->descuento . "'  ></td>
            <td > <input type='text' class='subtotal col-sm-9 text-center'             name='txtsubtotal'  id='txtsubtotal" . $i . "'     value='" . $_SESSION['operacion']['productos'][$i]->subtotal . "' readonly ></td>
            <td > <button type='button' class='btn btn-danger btnEliminarCotiza' onclick='eliminarCotizacion(" . $i . ")'><i class='fa fa-trash'></i></button> </td>
          </tr>";
    }
  } else {
    $_SESSION['operacion']['tabla'] .= "
      <tr class='text-center'>
        <th colspan='8'>No hay productos agregados</th>
      </tr>
    ";
  }
}

function generarTablaCotizacionEditar()
{
  $_SESSION['cotizacion_edit']['tabla'] = "";

  if (count($_SESSION['operacion']['productos']) > 0) {
    for ($i = 0; $i < sizeof($_SESSION['cotizacion_edit']['productos']); $i++) {
      $_SESSION['cotizacion_edit']['tabla'] .=
        "<tr class='cotizacion' id='" . $i . "'>
            <td >" . $i . "</td>
            <td >" . $_SESSION['cotizacion_edit']['productos'][$i]->sku . "</td>
            <td >" . $_SESSION['cotizacion_edit']['productos'][$i]->producto . "</td>
            <td >
              <input type='hidden' class='precio_compra'                name='hddpreciocompra'         id='hddpreciocompra" . $i . "' value='" . $_SESSION['cotizacion_edit']['productos'][$i]->precio_compra . "' >
              <input type='text' class='inputEdit cantidades col-11 text-center focusNext' name='txtcantidad'  id='txtcantidad" . $i . "'     value='" . $_SESSION['cotizacion_edit']['productos'][$i]->cantidad . "'         ></td>
            <td > <input type='text' class='inputEdit precios col-11 text-center' name='txtprecioventa'            id='txtprecioventa" . $i . "'  value='" . $_SESSION['cotizacion_edit']['productos'][$i]->precio_venta . "' readonly >
            </td>
            <td > <input type='text' class='inputEdit descuentos col-11 text-center focusDesc' name='txtdescuento' id='txtdescuento" . $i . "'    value='" . $_SESSION['cotizacion_edit']['productos'][$i]->descuento . "'  ></td>
            <td > <input type='text' class='inputEdit subtotal col-11 text-center'             name='txtsubtotal'  id='txtsubtotal" . $i . "'     value='" . $_SESSION['cotizacion_edit']['productos'][$i]->subtotal . "' readonly ></td>
            <td > <button type='button' class='btn btn-danger btnEliminarCotiza' onclick='eliminarCotizacionEdit(" . $i . ")'><i class='fa fa-trash'></i></button> </td>
          </tr>";
    }
  } else {
    $_SESSION['cotizacion_edit']['tabla'] .= "
    <tr class='text-center'>
      <th colspan='8'>No hay productos agregados</th>
    </tr>
    ";
  }
}

/*
Actualizar
$_SESSION['operacion']['tabla'] = "";

    for ($i = 0; $i < sizeof($_SESSION['operacion']['productos']); $i++) {

        $subTotal = $_SESSION['operacion']['productos'][$i]->precio_venta * $_SESSION['operacion']['productos'][$i]->stok;
        $_SESSION['operacion']['tabla'] .=
            "<tr class='cotizacion' id='" . $i . "'>
          <td >" . $i . "</td>
          <td >" . $_SESSION['operacion']['productos'][$i]->sku . "</td>
          <td >" . $_SESSION['operacion']['productos'][$i]->producto . "</td>
          <td >
            <input type='hidden' class='precio_compra'                name='hddpreciocompra'         id='hddpreciocompra" . $i . "' value='" . $_SESSION['operacion']['productos'][$i]->precio_compra . "' >
            <input type='text' class='cantidades col-sm-9 text-center focusNext' name='txtcantidad'  id='txtcantidad" . $i . "'     value='" . $_SESSION['operacion']['productos'][$i]->stok . "'         ></td>
          <td > <input type='text' class='precios col-sm-9 text-center' name='txtprecioventa'            id='txtprecioventa" . $i . "'  value='" . $_SESSION['operacion']['productos'][$i]->precio_venta . "' readonly >
          </td>
          <td > <input type='text' class='descuentos col-sm-9 text-center focusDesc' name='txtdescuento' id='txtdescuento" . $i . "'    value='" . $_SESSION['operacion']['productos'][$i]->descuento . "'  ></td>
          <td > <input type='text' class='subtotal col-sm-9 text-center'             name='txtsubtotal'  id='txtsubtotal" . $i . "'     value='" . $subTotal . "' readonly ></td>
          <td > <button type='button' class='btn btn-danger btnEliminarCotiza' onclick='eliminarCotizacion(" . $i . ")'><i class='fa fa-trash'></i></button> </td>
        </tr>";
    }
*/

/*
Aregar
$_SESSION['operacion']['tabla'] = "";

    for ($i = 0; $i < sizeof($_SESSION['operacion']['productos']); $i++) {
      $subTotal = $_SESSION['operacion']['productos'][$i]->precio_venta * $_SESSION['operacion']['productos'][$i]->stok;
      $_SESSION['operacion']['tabla'] .=
        "<tr class='cotizacion' id='" . $i . "'>
          <td >" . $i . "</td>
          <td >" . $_SESSION['operacion']['productos'][$i]->sku . "</td>
          <td >" . $_SESSION['operacion']['productos'][$i]->producto . "</td>
          <td ><input type='text' class='cantidades col-sm-9 text-center focusNext' name='txtcantidad'    id='txtcantidad" . $i . "'      value='1'   tabindex='" . $i . "'></td>
          <td >
            <input type='text'    class='precios col-sm-9 text-center'              name='txtprecioventa' id='txtprecioventa" . $i . "'   value='" . $_SESSION['operacion']['productos'][$i]->precio_venta . "'  readonly >
            <input type='hidden'  class='precio_compra'                             name='hddpreciocompra' id='hddpreciocompra" . $i . "' value='" . $_SESSION['operacion']['productos'][$i]->precio_compra * 1.05 . "' >
          </td>
          <td ><input type='text' class='descuentos col-sm-9 text-center focusDesc' name='txtdescuento'   id='txtdescuento" . $i . "'     value='0'  tabindex='1000" . $i . "'  ></td>
          <td ><input type='text' class='subtotal col-sm-9 text-center'             name='txtsubtotal'    id='txtsubtotal" . $i . "'      value='" . $total . "' readonly ></td>
          <td ><button type='button' class='btn btn-danger btnEliminarCotiza' onclick='eliminarCotizacion(" . $i . ")'><i class='fa fa-trash'></i></button></td>
      </tr>";
    }
*/

/*
Eliminar
for ($i = 0; $i < sizeof($_SESSION['operacion']['productos']); $i++) {
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
*/