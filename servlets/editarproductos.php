<?php
ini_set("display_errors","1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

if(!isset($_POST['cbxacceso'])){
$fichero_subido=$_POST['imagenback'];

}else{
//print_r($_FILES);
$dir_subida = 'subida/';
$fichero_subido = $dir_subida . date('ymdhis').basename($_FILES['img']['name']);

move_uploaded_file($_FILES['img']['tmp_name'], $fichero_subido);

}

	$query="UPDATE productos
SET descripcion='".$_POST['textadescripcion']."', id_familia=".$_POST['slssubfamilia'].", stok=".$_POST['txtstock'].", SKU='".$_POST['txtSKU']."', marca='".$_POST['txtmarca']."', modelo='".$_POST['txtmodelo']."', precio_compra=".$_POST['txtprecompra'].", precio_venta=".$_POST['txtpreventa'].", fecha_actualizacion=now(), estatus='".$_POST['slsstatus']."', imagen_producto='".$fichero_subido."', unidad_medida='".$_POST['slsumedida']."'
WHERE id_producto=".$_POST['idprodu'].";";
	
	$result = $conexio->query($query);

	print_r($result);


?>