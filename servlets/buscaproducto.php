<?php

include "../conexion/conexion.php";
$conexio =  conectar_bd();

$query="SELECT * FROM productos WHERE producto like '%".$_POST['producto']."%' or SKU like '%".$_POST['producto']."%'";
$result=$conexio->query($query);
$cantidad = 0;
$cadena="";
   while($fila=$result->fetch_assoc()){
     $cadena.=$fila['producto']."|";
     $cantidad++;
  }
  if($cantidad!=0){
      echo $_POST['producto'];
  }else{
      echo "NA";
  }


?>
