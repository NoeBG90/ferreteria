<?php

session_start();

$contador=0;
$tabla="";
$cantidad=0;

unset($$_SESSION['productos'][$_POST['id']]);

$_SESSION['tabla']="";
  for($i=0;$i<sizeof($_SESSION['productos']);$i++){
    //print_r($_SESSION['productos'][$i]);
    $_SESSION['tabla'].=

        "<tr><td class='id' >".$i."</td><td >".$_SESSION['productos'][$i]->sku
        ."</td><td >".$_SESSION['productos'][$i]->producto.
        "</td><td >
        <input type='text' class='cantidades col-sm-9 text-left' name='txtcantidad'  id='txtcantidad".$i."' value='".$_SESSION['productos'][$i]->stok."' >
        </td><td >
        <input type='text' name='txtprecioventa' id='txtprecioventa".
        $i."' class='precios col-sm-9 text-left'  value='".$_SESSION['productos'][$i]->precio_compra."' >
        </td><td >
        <input type='text' class='subtotal col-sm-9 text-left' name='txtsubtotal' id='txtsubtotal".count($_SESSION['productos'])."' readonly >
        </td></tr>";
  }
  print_r($_SESSION['tabla']);

?>
