<?php
print_r($_POST['id_cliente']);
include "../conexion/conexion.php";
$conexio=conectar_bd();
$query="select nom_contacto, telefono from clientes where id_cliente='".$_POST['id_cliente']."';";
$resultclientescot=$conexio->query($query);
obj=new stdClass();
  while($filaclientes=$resultclientescot->fetch_assoc()){
  	obj->nomcontacto=filaclientes['nom_contacto'];
  	obj->telefono=filaclientes['telefono'];
}
print_r(json_encode(obj));
?>