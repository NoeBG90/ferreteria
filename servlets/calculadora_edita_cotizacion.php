<?php
session_start();
$flag_cotiza=0;
if(!isset($_SESSION['productos_cotizacion_edicion'])){
//Validamos si existe la cotizacion
$_SESSION['productos_cotizacion_edicion']=array();

$flag_cotiza=0;
}else{
//echo "Entra al else";
  $flag_cotiza=validaproducto($_SESSION['productos_cotizacion_edicion'],$_POST['producto']);
//echo "Flag:".$flag_cotiza;
}



if($flag_cotiza==0){

include "../conexion/conexion.php";
$conexio =  conectar_bd();
$query="SELECT * FROM productos WHERE id_producto=".$_POST['producto'];
$result=$conexio->query($query);
  $posiciones=sizeof($_SESSION['productos_cotizacion_edicion']);
   while($fila=$result->fetch_assoc()){
     $objdetalle=new stdClass();
     $objdetalle->id=$fila['id_producto'];
     $objdetalle->producto=$fila['producto'];
     $objdetalle->stok=$fila['stok'];
     $objdetalle->sku=$fila['SKU'];
     $objdetalle->precio_venta=$fila['precio_venta'];
     $objdetalle->descuento=0;
     $objdetalle->subtotal=0;
     $_SESSION['productos_cotizacion_edicion'][$posiciones]=$objdetalle;

  }
$_SESSION['tabla_cotizacion']="";
  for($i=0;$i<sizeof($_SESSION['productos_cotizacion_edicion']);$i++){

    $_SESSION['tabla_cotizacion'].="<tr>
    <td class='id' >".$i."</td><td >".$_SESSION['productos_cotizacion_edicion'][$i]->sku."</td>
    <td >".$_SESSION['productos_cotizacion_edicion'][$i]->producto."</td>
    <td ><input type='text' class='cantidades col-sm-9 text-left' name='txtcantidad'  id='txtcantidad".$i."' value='".$_SESSION['productos_cotizacion_edicion'][$i]->stok."' ></td>
    <td ><input type='text' name='txtprecioventa' id='txtprecioventa".$i."' class='precios col-sm-9 text-left'  value='".$_SESSION['productos_cotizacion_edicion'][$i]->precio_venta."' ></td>
    <td ><input type='text' class='descuentos col-sm-9 text-left' name='txtdescuento' id='txtdescuento".$i."' value='".$_SESSION['productos_cotizacion_edicion'][$i]->descuento."'  ></td>
    <td ><input type='text' class='subtotal col-sm-9 text-left' name='txtsubtotal' id='txtsubtotal".$i."' readonly ></td>
    </tr>";
  }
  print_r($_SESSION['tabla_cotizacion']);
}else{

  print_r($_SESSION['tabla_cotizacion']);

}


function validaproducto($arreglo,$id_producto){
  foreach ($arreglo as $producto) {
    if($id_producto==$producto->id){
      return 1;
    }
  }
  return 0;
}

?>
