<?php
session_start();
ini_set("display_errors","1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();
//print_r($_POST);

$id_pedido=$_POST['id_operacion'];
$objfull=new stdClass();  
$objheader=new stdClass();
$objdetalletabla= new stdClass();



$querypedido="select folio_operacion ,vigencia_operacion , tiempo_entrega ,consideraciones , 
                total , subtotal ,iva,iva_porcentual , e.id_empleado idempleado ,e.nombre as empleado,c2.nombre as cliente, c2.id_cliente  idcliente ,c2.nom_contacto ,c.fecha_registro ,c2.direccion,c2.telefono ,descuento,c2.telefono,c2.nom_contacto,c.metodo_pago 
                from operaciones c ,empleados e,clientes c2 WHERE 
                c.id_empleado =e.id_empleado and c.id_cliente =c2.id_cliente and id_operacion =".$id_pedido;
//print_r($querycotizacion);
        $resultpedido=$conexio->query($querypedido);
        while($filapedido=$resultpedido->fetch_assoc()){
            $objheader->foliocotizacion=$filapedido['folio_operacion'];
            $objheader->idempleado=$filapedido['idempleado'];
            $objheader->nombreempleado=$filapedido['empleado'];
            $objheader->idcliente=$filapedido['idcliente'];
            $objheader->vigencia=$filapedido['vigencia_operacion'];
            $objheader->tiempo_entrega=$filapedido['tiempo_entrega'];
            $objheader->consideraciones=$filapedido['consideraciones'];
            $objheader->telefono=$filapedido['telefono'];
            $objheader->nom_contacto=$filapedido['nom_contacto'];
            $objheader->subtotal=$filapedido['subtotal'];
            $objheader->iva_porcentual=$filapedido['iva_porcentual'];
            $objheader->iva=$filapedido['iva'];
            $objheader->total=$filapedido['total'];
            $objheader->descuento=$filapedido['descuento'];
            $objheader->metodo_pago=$filapedido['metodo_pago'];

        }
        
$queryvendedor="select e.* from clientes c,empleados e,operaciones c2 where
            c.id_empleado =e.id_empleado
            and c2.id_cliente =c.id_cliente 
            and c2.id_operacion=".$id_pedido
            $vendedor="";
            $result_vendedor=$conexio->query($queryvendedor);
        while($filavendedor=$result_vendedor->fetch_assoc()){
            $objheader->vendedor=$filavendedor['nombre'];
        }


        $querydetalle="select p.id_producto,p.SKU ,p.producto, p.descripcion,dc.cantidad ,dc.precio ,dc.descuento ,dc.subtotal, p.unidad_medida from detalle_operaciones dc,productos p ,operaciones c 
where dc.id_producto =p.id_producto and dc.id_operacion =c.id_operacion and c.id_operacion = ".$id_pedido;
        $result_detalle=$conexio->query($querydetalle);
        $_SESSION['productos_cotizacion']=array();

        $posiciones=sizeof($_SESSION['productos_cotizacion']);
        while($filadetalle=$result_detalle->fetch_assoc()){
            
           // print_r($filadetalle);

            $objdetalle=new stdClass();
            $objdetalle->id=$filadetalle['id_producto'];
            $objdetalle->producto=$filadetalle['producto'];
            $objdetalle->stok=$filadetalle['cantidad'];
            $objdetalle->sku=$filadetalle['SKU'];
            $objdetalle->precio_venta=$filadetalle['precio'];
            $objdetalle->descuento=$filadetalle['descuento'];;
            $objdetalle->subtotal=$filadetalle['subtotal'];;
            $_SESSION['productos_cotizacion'][$posiciones]=$objdetalle;
            $posiciones++;

        }
        $objdetalletabla=$_SESSION['productos_cotizacion'];

$_SESSION['tabla_cotizacion']="";
  for($i=0;$i<sizeof($_SESSION['productos_cotizacion']);$i++){

    $_SESSION['tabla_cotizacion'].="<tr>
    <td class='id' >".$i."</td><td >".$_SESSION['productos_cotizacion'][$i]->sku."</td>
    <td >".$_SESSION['productos_cotizacion'][$i]->producto."</td>
    <td ><input type='text' class='cantidades col-sm-9 text-left' name='txtcantidad'  id='txtcantidad".$i."' value='".$_SESSION['productos_cotizacion'][$i]->stok."' ></td>
    <td ><input type='text' name='txtprecioventa' id='txtprecioventa".$i."' class='precios col-sm-9 text-left'  value='".$_SESSION['productos_cotizacion'][$i]->precio_venta."' ></td>
    <td ><input type='text' class='descuentos col-sm-9 text-left' name='txtdescuento' id='txtdescuento".$i."' value='".$_SESSION['productos_cotizacion'][$i]->descuento."'  ></td>
    <td ><input type='text' class='subtotal col-sm-9 text-left' name='txtsubtotal' id='txtsubtotal".$i."' readonly ></td>
    </tr>";
  }


$objfull->header=$objheader;
$objfull->detalle=$objdetalletabla;
$objfull->tabla=$_SESSION['tabla_cotizacion'];
print_r(json_encode($objfull));
?>
