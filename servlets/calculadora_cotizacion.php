<?php
session_start();
$flag_cotiza=0;
if(!isset($_SESSION['productos_cotizacion'])){
//Validamos si existe la cotizacion
$_SESSION['productos_cotizacion']=array();

$flag_cotiza=0;
}else{
//echo "Entra al else";
  $flag_cotiza=validaproducto($_SESSION['productos_cotizacion'],$_POST['producto']);
//echo "Flag:".$flag_cotiza;
}



if($flag_cotiza==0){

include "../conexion/conexion.php";
$conexio =  conectar_bd();
$query="SELECT * FROM productos WHERE id_producto=".$_POST['producto'];
$result=$conexio->query($query);
  $posiciones=sizeof($_SESSION['productos_cotizacion']);
   while($fila=$result->fetch_assoc()){
     $objdetalle=new stdClass();
     $objdetalle->id=$fila['id_producto'];
     $objdetalle->producto=$fila['producto'];
     $objdetalle->stok=$fila['stok'];
     $objdetalle->sku=$fila['SKU'];
     $objdetalle->precio_venta=$fila['precio_venta'];
     $objdetalle->descuento=0;
     $objdetalle->subtotal=0;
     $objdetalle->precio_compra=$fila['precio_compra'];
     $_SESSION['productos_cotizacion'][$posiciones]=$objdetalle;

  }
$_SESSION['tabla_cotizacion']="";
  for($i=0;$i<sizeof($_SESSION['productos_cotizacion']);$i++){

    $_SESSION['tabla_cotizacion'].="<tr>
    <td class='id' >".$i."</td><td >".$_SESSION['productos_cotizacion'][$i]->sku."</td><td >".$_SESSION['productos_cotizacion'][$i]->producto."</td>
    <td ><input type='text' class='cantidades tamanos focusNext' name='txtcantidad'  id='txtcantidad".$i."' value='0'   tabindex='".$i."'></td>
    <td >
    <input type='text' name='txtprecioventa' id='txtprecioventa".$i."' class='precios tamanos'  value='".$_SESSION['productos_cotizacion'][$i]->precio_venta."'  readonly >
    <input type='hidden' nam='hddpreciocompra' id='hddpreciocompra".$i."' class='precio_compra' value='".$_SESSION['productos_cotizacion'][$i]->precio_compra*1.05."' >
    </td>
    <td ><input type='text' class='descuentos tamanos focusDesc' name='txtdescuento' id='txtdescuento".$i."'  tabindex='1000".$i."'  ></td>
    <td ><input type='text' class='subtotal tamanos' name='txtsubtotal' id='txtsubtotal".$i."' readonly ></td>
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
