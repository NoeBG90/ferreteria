<?php
ini_set("display_errors", "1");
session_start();
include "../conexion/conexion.php";
if (!isset($_SESSION['productos'])) {
	//Validamos si existe la cotizacion
	$_SESSION['productos'] = array();
}
$conexio =  conectar_bd();
$queryvalidaproducto = "select * from productos where producto='" . $_POST['txtproducto'] . "';";
$result = $conexio->query($queryvalidaproducto);
if ($result->num_rows > 0) {
	echo "El producto ya se encuentra registrado";
} else {

	$queryvalidaproducto = "select * from productos where sku='" . $_POST['txtSKUcomp'] . "';";
	//echo $queryvalidaproducto;
	$result = $conexio->query($queryvalidaproducto);
	if ($result->num_rows > 0) {
		echo "El SKU ya se encuentra registrado";
	} else {


		$query = "INSERT INTO productos
(producto, descripcion, id_familia, stock, SKU, marca, modelo, precio_compra, precio_venta, fecha_registro, fecha_actualizacion, estatus, imagen_producto, unidad_medida)
VALUES('" . $_POST['txtproducto'] . "', '" . $_POST['textadescripcioncomp'] . "', " . $_POST['slsfamiliacomp'] . ", 00, '" .
			$_POST['txtSKUcomp'] . "', '" . $_POST['txtmarcacomp'] . "', '" . $_POST['txtmodelocomp'] . "', '0.0', '0.0', now(), now(),'" . $_POST['slsstatuscomp'] . "','subida/noimagecompra.png','" . $_POST['slsumedida'] . "');
";
		//echo $query;
		$result = $conexio->query($query);
		if ($result != 0) {
			$posiciones = sizeof($_SESSION['productos']);
			$objdetalle = new stdClass();
			$objdetalle->id = $conexio->insert_id;
			$objdetalle->producto = $_POST['txtproducto'];
			$objdetalle->stok = 0;
			$objdetalle->sku = $_POST['txtSKUcomp'];
			$objdetalle->precio_compra = 0;
			$objdetalle->fila = "<tr><td class='id' >" . count($_SESSION['productos']) . "</td><td >" . $_POST['txtSKUcomp']
				. "</td><td >" . $_POST['txtproducto'] .
				"</td><td >
	<input type='text' class='cantidades col-sm-9 text-left' name='txtcantidad'  id='txtcantidad" . count($_SESSION['productos']) . "' value=''" . $objdetalle->stok . "'' >
	</td><td >
	<input type='text' name='txtprecioventa' id='txtprecioventa" . count($_SESSION['productos']) . "' class='precios col-sm-9 text-left'  value='0' >
	</td><td >
	<input type='text' class='subtotal col-sm-9 text-left' name='txtsubtotal' id='txtsubtotal" . count($_SESSION['productos']) . "' readonly >
	</td><td >Remover</td></tr>";
			$_SESSION['productos'][$posiciones] = $objdetalle;

			$_SESSION['tabla'] = "";
			for ($i = 0; $i < sizeof($_SESSION['productos']); $i++) {
				//print_r($_SESSION['productos'][$i]);
				$_SESSION['tabla'] .=

					"<tr><td class='id' >" . $i . "</td><td >" . $_SESSION['productos'][$i]->sku
					. "</td><td >" . $_SESSION['productos'][$i]->producto .
					"</td><td >
	        <input type='text' class='cantidades col-sm-9 text-left' name='txtcantidad'  id='txtcantidad" . $i . "' value='" . $_SESSION['productos'][$i]->stok . "' >
	        </td><td >
	        <input type='text' name='txtprecioventa' id='txtprecioventa" .
					$i . "' class='precios col-sm-9 text-left'  value='" . $_SESSION['productos'][$i]->precio_compra . "' >
	        </td><td >
	        <input type='text' class='subtotal col-sm-9 text-left' name='txtsubtotal' id='txtsubtotal" . count($_SESSION['productos']) . "' readonly >
	        </td></tr>";
			}
		}
		$response = new stdClass();
		$response->result = $result;
		$response->tabla = $_SESSION['tabla'];

		print_r(json_encode($response));
	}
}


//echo 'Más información de depuración:';
//print_r($_FILES);
