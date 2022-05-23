<?php
ini_set("display_errors", "1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

//print_r($_FILES);
//print_r($_POST);
$dir_subida = 'subida/';
$fichero_subido = $dir_subida . date('ymdhis') . basename($_FILES['img']['name']);

//echo "El fichero es válido y se subió con éxito.\n";
if (move_uploaded_file($_FILES['img']['tmp_name'], $fichero_subido)) {

	$nombreProducto = $_POST['txtproducto'];
	$SKU = '';
	$descripcionProducto = $_POST['textadescripcion'];
	$idFamilia = $_POST['slsfamilia'];
	$idSubFamilia = $_POST['slssubfamilia'];
	$stock = $_POST['txtstock'];
	$marca = $_POST['txtmarca'];
	$modelo = $_POST['txtmodelo'];
	$precioCompra = $_POST['txtprecompra'];
	$precioVenta = $_POST['txtpreventa'];
	$estatus = $_POST['slsstatus'];
	$unidadMedida = $_POST['slsumedida'];
	$fechaAlta = date("Y:m:d H:i:s");

	//Validacion por Nombre Producto
	$queryvalidaproducto = "select * from productos where producto='" . $nombreProducto . "';";
	$resultProducto = $conexio->query($queryvalidaproducto);

	//Validacion por SKU
	$queryvalidaproducto = "select * from productos where sku='" . $SKU . "';";
	$resultSKU = $conexio->query($queryvalidaproducto);

	if ($resultProducto->num_rows > 0) {
		echo "El producto ya se encuentra registrado";
	} else if ($resultSKU->num_rows > 0) {
		echo "El SKU ya se encuentra registrado";
	} else {
		$data = null;
		try {

			$query = 'CALL sp_alta_producto(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
			$stmt = $conexio->prepare($query);
			$stmt->bind_param(
				'ssiissssddssss',
				$nombreProducto,
				$descripcionProducto,
				$idFamilia,
				$idSubFamilia,
				$stock,
				$marca,
				$modelo,
				$precioCompra,
				$precioVenta,
				$fechaAlta,
				$fechaAlta,
				$estatus,
				$fichero_subido,
				$unidadMedida
			);

			$stmt->execute();
			$result = $stmt->get_result();
			$response = $result->fetch_all(MYSQLI_ASSOC);
			$stmt->close();
			$conexio->close();

			echo json_encode($response[0]);
		} catch (Exception $e) {
			$data = array("code" => false, "message" => 'Error en registro del producto. Favor de intentar mas tarde.');
			echo json_encode($data);
		}
	}
} else {
	echo "¡Ingrese los datos necesarios!\n";
}
