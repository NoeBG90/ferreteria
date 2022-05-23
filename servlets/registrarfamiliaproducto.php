<?php
ini_set("display_errors", "1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();


//$queryValidaFamilia = "select * from familia_producto where familia='" . $_POST['txtfamproducto'] . "';";
//$result = $conexio->query($queryValidaFamilia);

if (0 > 0) {
	echo "La familia de producto ya se encuentra registrada";
} else {
	$data = null;
	$date = date("Y:m:d H:i:s");

	try {
		$query = "INSERT INTO familia_producto (familia, descripcion, estatus, created_at, updated_at) VALUES (?, ?, ?, ?, ?);";
		$stmt = $conexio->prepare($query);
		$stmt->bind_param('sssss', $_POST['txtfamproducto'], $_POST['textafamdescripcion'], $_POST['slsfamstatus'], $date, $date);
		$result = $stmt->execute();
		$idFamilia = $stmt->insert_id;

		$update_numero = "update familia_producto set codigo =concat('FP-',LPAD(" . $idFamilia . " , 5 , '0')) where id_familia =" . $idFamilia;
		$resultupdate = $conexio->query($update_numero);

		if (!$result or !$resultupdate)
			throw new Exception('Error al insertar registro.');

		$data = array("code" => $result, "message" => "Exitoso");
	} catch (Exception $e) {
		$data = array("code" => false, "message" => 'Error en registro de familia producto. Favor de intentar mas tarde.');
	}
	echo json_encode($data);
}
