<?php
ini_set("display_errors", "1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

if (!isset($_POST['cbxacceso'])) {
	$fichero_subido = $_POST['imagenback'];
} else {
	//print_r($_FILES);
	$dir_subida = 'subida/';
	$fichero_subido = $dir_subida . date('ymdhis') . basename($_FILES['img']['name']);
	move_uploaded_file($_FILES['img']['tmp_name'], $fichero_subido);
}
$marca = $_POST['txtmarca'];
$modelo = $_POST['txtmodelo'];
$precio_compra = $_POST['txtprecompra'];
$precio_venta = $_POST['txtpreventa'];
$stock = $_POST['txtstock'];
$unidad_medida = $_POST['slsumedida'];
$estatus = $_POST['slsstatus'];
$imagen_producto = $fichero_subido;
$descripcion = $_POST['textadescripcion'];
$fecha_actualizacion = date("Y:m:d H:i:s");
$id_producto = $_POST['idprodu'];


$query = "UPDATE productos set marca = ?, modelo = ?, precio_compra = ?, precio_venta = ?, stock = ?, unidad_medida = ?, estatus = ?, imagen_producto = ?, descripcion = ?, fecha_actualizacion = ? where id_producto = ?;";
$stmt = $conexio->prepare($query);
$stmt->bind_param('ssdddsssssi', $marca, $modelo, $precio_compra, $precio_venta, $stock, $unidad_medida, $estatus, $imagen_producto, $descripcion, $fecha_actualizacion, $id_producto);
$result = $stmt->execute();

print_r($result);
