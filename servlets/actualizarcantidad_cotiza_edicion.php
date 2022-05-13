<?php
session_start();
if($_POST['cantidad']!='NaN'){
$contador=0;
$tabla="";
$cantidad=0;
//print_r($_SESSION['productos_cotizacion_edicion']);
$_SESSION['productos_cotizacion_edicion'][$_POST['posicion']]->stok=$_POST['cantidad'];

$_SESSION['productos_cotizacion_edicion'][$_POST['posicion']]->precio_venta=$_POST['precio'];

$_SESSION['productos_cotizacion_edicion'][$_POST['posicion']]->descuento=$_POST['descuento'];

$_SESSION['productos_cotizacion_edicion'][$_POST['posicion']]->subtotal=$_POST['subtotal'];
//print_r($_SESSION['productos_cotizacion_edicion']);
$_SESSION['tabla_cotizacion']="";
  for($i=0;$i<sizeof($_SESSION['productos_cotizacion_edicion']);$i++){
    //print_r($_SESSION['productos_cotizacion_edicion'][$i]);
    $_SESSION['tabla_cotizacion'].=

        "<tr>
        <td class='id' >".$i."</td><td >".$_SESSION['productos_cotizacion_edicion'][$i]->sku."</td>
        <td >".$_SESSION['productos_cotizacion_edicion'][$i]->producto."</td>
        <td ><input type='text' class='cantidades col-sm-9 text-left' name='txtcantidad'  id='txtcantidad".$i."' value='".$_SESSION['productos_cotizacion_edicion'][$i]->stok."' >
        </td>
        <td ><input type='text' name='txtprecioventa' id='txtprecioventa".$i."' class='precios col-sm-9 text-left'  value='".$_SESSION['productos_cotizacion_edicion'][$i]->precio_venta."' ></td>
        <td ><input type='text' class='descuentos col-sm-9 text-left' name='txtdescuento' id='txtdescuento".$i."'  value='".$_SESSION['productos_cotizacion_edicion'][$i]->descuento."'  ></td>
        <td ><input type='text' class='subtotal col-sm-9 text-left' name='txtsubtotal' id='txtsubtotal".$i."' readonly >
        </td>
        ";
  }
  print_r($_SESSION['tabla_cotizacion']);
}else{
  print_r($_SESSION['tabla_cotizacion']);
  }

?>
