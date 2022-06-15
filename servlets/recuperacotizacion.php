<?php
session_start();
ini_set("display_errors", "1");
include "../conexion/conexion.php";
include "./utilerias.php";

$conexio =  conectar_bd();
$id_cotizacion = $_POST['id_operacion'];
$objfull = new stdClass();
$objheader = new stdClass();
$objdetalletabla = new stdClass();

$querycotizacion = "select folio_operacion ,vigencia_operacion , tiempo_entrega ,consideraciones , 
                total , subtotal ,iva,iva_porcentual , e.id_empleado idempleado ,e.nombre as empleado,c2.nombre as cliente, c2.id_cliente  idcliente,
                c2.nom_contacto ,c.fecha_registro ,c2.telefono ,c.descuento,c2.telefono,c2.nom_contacto,c.metodo_pago 
                from operaciones c ,empleados e,clientes c2 WHERE 
                c.id_empleado =e.id_empleado and c.id_cliente =c2.id_cliente and id_operacion =" . $id_cotizacion;
//print_r($querycotizacion);
$resultcotizacion = $conexio->query($querycotizacion);
while ($filacotizacion = $resultcotizacion->fetch_assoc()) {
  $objheader->foliocotizacion = $filacotizacion['folio_operacion'];
  $objheader->idempleado = $filacotizacion['idempleado'];
  $objheader->nombreempleado = $filacotizacion['empleado'];
  $objheader->idcliente = $filacotizacion['idcliente'];
  $objheader->cliente = $filacotizacion['cliente'];
  $objheader->vigencia = $filacotizacion['vigencia_operacion'];
  $objheader->tiempo_entrega = $filacotizacion['tiempo_entrega'];
  $objheader->consideraciones = $filacotizacion['consideraciones'];
  $objheader->telefono = $filacotizacion['telefono'];
  $objheader->nom_contacto = $filacotizacion['nom_contacto'];
  $objheader->subtotal = $filacotizacion['subtotal'];
  $objheader->iva_porcentual = $filacotizacion['iva_porcentual'];
  $objheader->iva = $filacotizacion['iva'];
  $objheader->total = $filacotizacion['total'];
  $objheader->descuento = $filacotizacion['descuento'];
  $objheader->metodo_pago = $filacotizacion['metodo_pago'];
}

$queryvendedor = "select e.* from clientes c,empleados e,operaciones c2 where
            c.id_empleado =e.id_empleado
            and c2.id_cliente =c.id_cliente 
            and c2.id_operacion=" . $id_cotizacion;
$vendedor = "";
$result_vendedor = $conexio->query($queryvendedor);
while ($filavendedor = $result_vendedor->fetch_assoc()) {
  $objheader->vendedor = $filavendedor['nombre'];
}

$querydetalle = "select p.id_producto,p.SKU ,p.producto, p.descripcion,dc.cantidad ,dc.precio ,dc.descuento ,dc.subtotal, p.unidad_medida, p.precio_compra
from detalle_operaciones dc,productos p ,operaciones c 
where dc.id_producto =p.id_producto and dc.id_operacion =c.id_operacion and c.id_operacion = " . $id_cotizacion;
$result_detalle = $conexio->query($querydetalle);
$_SESSION['operacion']['productos'] = array();

$posiciones = sizeof($_SESSION['operacion']['productos']);
while ($filadetalle = $result_detalle->fetch_assoc()) {
  $objdetalle = new stdClass();
  $objdetalle->id = $filadetalle['id_producto'];
  $objdetalle->producto = $filadetalle['producto'];
  $objdetalle->stok = $filadetalle['cantidad'];
  $objdetalle->sku = $filadetalle['SKU'];
  $objdetalle->precio_venta = $filadetalle['precio'];
  $objdetalle->precio_compra = $filadetalle['precio_compra'];
  $objdetalle->descuento = $filadetalle['descuento'];;
  $objdetalle->subtotal = $filadetalle['subtotal'];;
  $_SESSION['operacion']['productos'][$posiciones] = $objdetalle;
  $posiciones++;
}
$objdetalletabla = $_SESSION['operacion']['productos'];

/*$_SESSION['operacion']['tabla'] = "";
for ($i = 0; $i < sizeof($_SESSION['operacion']['productos']); $i++) {

  //print_r($_SESSION['productos_cotizacion'][$i]);
  $subTotal = $_SESSION['operacion']['productos'][$i]->stok * $_SESSION['operacion']['productos'][$i]->precio_venta;
  $_SESSION['operacion']['tabla'] .=
    "<tr class='cotizacion' id='" . $i . "'>
        <td >" . $i . "</td>
        <td >" . $_SESSION['operacion']['productos'][$i]->sku . "</td>
        <td >" . $_SESSION['operacion']['productos'][$i]->producto . "</td>
        <td >
          <input type='hidden' class='precio_compra'                name='hddpreciocompra'         id='hddpreciocompra" . $i . "' value='" . $_SESSION['operacion']['productos'][$i]->precio_compra * 1.05 . "' >
          <input type='text' class='cantidades col-sm-9 text-center focusNext' name='txtcantidad'  id='txtcantidad" . $i . "'     value='" . $_SESSION['operacion']['productos'][$i]->stok . "'         ></td>
        <td > <input type='text' class='precios col-sm-9 text-center' name='txtprecioventa'            id='txtprecioventa" . $i . "'  value='" . $_SESSION['operacion']['productos'][$i]->precio_venta . "' readonly >
        </td>
        <td > <input type='text' class='descuentos col-sm-9 text-center focusDesc' name='txtdescuento' id='txtdescuento" . $i . "'    value='" . $_SESSION['operacion']['productos'][$i]->descuento . "'  ></td>
        <td > <input type='text' class='subtotal col-sm-9 text-center'             name='txtsubtotal'  id='txtsubtotal" . $i . "'     value='" . $subTotal . "' readonly ></td>
        <td > <button type='button' class='btn btn-danger btnEliminarCotiza' onclick='eliminarCotizacion(" . $i . ")'><i class='fa fa-trash'></i></button> </td>
      </tr>";
}*/
generarTablaOperacion();
$objfull->header = $objheader;
$objfull->detalle = $objdetalletabla;
$objfull->tabla = $_SESSION['operacion']['tabla'];
print_r(json_encode($objfull));
$conexio->close();
