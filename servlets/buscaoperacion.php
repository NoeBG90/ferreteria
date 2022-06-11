<?php

include "../conexion/conexion.php";
$conexio =  conectar_bd();

$query = "SELECT * FROM operaciones WHERE tipo_operacion like '%" . $_POST['operacion'] . "%' ";
$result = $conexio->query($query);
$cantidad = 0;
$cadena = "";

while ($fila = $result->fetch_assoc()) {
  $cadena .= $fila['operacion'] . "|";
  $cantidad++;
}
if ($cantidad != 0) {
  echo $_POST['operacion'];
} else {
  echo "NA";
}
