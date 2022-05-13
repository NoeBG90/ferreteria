<?php
session_start();
if($_POST['cantidad']!='NaN'){
$contador=0;
$tabla="";
$cantidad=0;
//print_r($_SESSION['productos_cotizacion']);
$_SESSION['productos_cotizacion'][$_POST['posicion']]->stok=$_POST['cantidad'];

$_SESSION['productos_cotizacion'][$_POST['posicion']]->precio_venta=$_POST['precio'];

$_SESSION['productos_cotizacion'][$_POST['posicion']]->descuento=$_POST['descuento'];

$_SESSION['productos_cotizacion'][$_POST['posicion']]->subtotal=$_POST['subtotal'];
//print_r($_SESSION['productos_cotizacion']);
$_SESSION['tabla_cotizacion']="";
  for($i=0;$i<sizeof($_SESSION['productos_cotizacion']);$i++){
    //print_r($_SESSION['productos_cotizacion'][$i]);
    $_SESSION['tabla_cotizacion'].=

        "<tr>
        <td class='id' >".$i."</td><td >".$_SESSION['productos_cotizacion'][$i]->sku."</td>
        <td >".$_SESSION['productos_cotizacion'][$i]->producto."</td>
        <td ><input type='text' class='cantidades col-sm-9 text-left focusNext' name='txtcantidad'  id='txtcantidad".$i."' value='".$_SESSION['productos_cotizacion'][$i]->stok."'  tabindex='".$i."'>
        </td>
        <td >
        <input type='text' name='txtprecioventa' id='txtprecioventa".$i."' class='precios col-sm-9 text-left'  value='".$_SESSION['productos_cotizacion'][$i]->precio_venta."' readonly >
        <input type='hidden' nam='hddpreciocompra' id='hddpreciocompra".$i."' class='precio_compra' value='".$_SESSION['productos_cotizacion'][$i]->precio_compra*1.05."' >
        </td>
        <td ><input type='text' class='descuentos col-sm-9 text-left focusDesc' name='txtdescuento' id='txtdescuento".$i."'  value='".$_SESSION['productos_cotizacion'][$i]->descuento."'  tabindex='1000".$i."'  ></td>
        <td ><input type='text' class='subtotal col-sm-9 text-left' name='txtsubtotal' id='txtsubtotal".$i."' readonly >
        </td>
        ";
  }
  print_r($_SESSION['tabla_cotizacion']);
}else{
  print_r($_SESSION['tabla_cotizacion']);
  }

?>
