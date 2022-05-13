<?php
ini_set("display_errors","1");
include "../conexion/conexion.php";
//print_r($_FILES);
//print_r($_POST);
$dir_subida = 'subida/';
$fichero_subido = $dir_subida . date('ymdhis').basename($_FILES['img']['name']);

if (move_uploaded_file($_FILES['img']['tmp_name'], $fichero_subido)) {
    //echo "El fichero es válido y se subió con éxito.\n";
    $conexio =  conectar_bd();


$queryvalidaproducto="select * from productos where producto='".$_POST['txtproducto']."';";
$result = $conexio->query($queryvalidaproducto);
if ($result->num_rows>0){
	echo "El producto ya se encuentra registrado";
}else{	

$queryvalidaproducto="select * from productos where sku='".$_POST['txtSKU']."';";
//echo $queryvalidaproducto;
$result = $conexio->query($queryvalidaproducto);
if ($result->num_rows>0){
	echo "El SKU ya se encuentra registrado";
}else{	


	$query="INSERT INTO productos
(producto, descripcion, id_familia, stok, SKU, marca, modelo, precio_compra, precio_venta, fecha_registro, fecha_actualizacion, estatus, imagen_producto,unidad_medida)
VALUES('".$_POST['txtproducto']."', '".$_POST['textadescripcion']."', ".$_POST['slssubfamilia'].", ".$_POST['txtstock'].", '".$_POST['clave_producto'].$_POST['txtSKU']."', '".$_POST['txtmarca']."', '".$_POST['txtmodelo']."', ".$_POST['txtprecompra'].", ".$_POST['txtpreventa'].", now(), now(),'".$_POST['slsstatus']."','".$fichero_subido."', '".$_POST['slsumedida']."');
";
	//echo $query;
	$result = $conexio->query($query);

	$numero_producto=$conexio->insert_id;
	//echo $numero_producto;
	$update_numero ="update productos set numero_producto =concat('PRO-',LPAD(".$numero_producto." , 5 , '0')) where id_producto =".$numero_producto;
	$resultupdate = $conexio->query($update_numero);
	//echo $update_numero;
	//print_r($resultupdate);
	print_r($result);
}

}
} else {
    echo "¡Ingrese los datos necesarios!\n";
}

//echo 'Más información de depuración:';
//print_r($_FILES);









?>