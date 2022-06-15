<?php
ini_set("display_errors", "1");
include "../conexion/conexion.php";

$conexio =  conectar_bd();
/*$queryvalidafamproducto = "SELECT * FROM subfamilia_producto sp where subfamilia ='" . $_POST['txtsubfamproducto'] . "'";
$result = $conexio->query($queryvalidafamproducto);*/

if (0 > 0) {
	echo "La familia de producto ya se encuentra registrada";
} else {
	$data = null;
	$date = date("Y:m:d H:i:s");
	$consecutivo = 0;

	try {
		$query = "INSERT INTO subfamilia_producto (subfamilia, descripcion, estatus, created_at, updated_at, 
													codigo_subfamilia, id_familia, consecutivo)  VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

		$stmt = $conexio->prepare($query);
		$stmt->bind_param('sssssssi', $_POST['txtsubfamproducto'], $_POST['textasubfamdescripcion'], $_POST['slssubfamstatus'], $date, $date, $_POST['txtcodsubfamprod'], $_POST['slsfamilias'], $consecutivo);
		$result = $stmt->execute();
		$idSubFamilia = $stmt->insert_id;

		$data = array("code" => $result, "message" => "Exitoso Registro SubFamilia.");
	} catch (Exception $e) {
		$data = array("code" => false, "message" => 'Error en registro de familia producto. Favor de intentar mas tarde.');
	}
	echo json_encode($data);
}
$conexio->close();
