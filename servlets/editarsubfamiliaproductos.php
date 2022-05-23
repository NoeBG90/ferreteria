<?php
ini_set("display_errors", "0");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

$query = "UPDATE subfamilia_producto
SET subfamilia='" . $_POST['txtsubfamproducto'] . "', descripcion='" . $_POST['textasubfamdescripcion'] . "', estatus='" . $_POST['slssubfamstatus'] . "', updated_at=now(), numero_subfamiliaprod='" . $_POST['txtcodsubfamprod'] . "'
WHERE id_subfamilia=" . $_POST['idsfp'] . ";";

//echo $query;
$result = $conexio->query($query);

print_r($result);
