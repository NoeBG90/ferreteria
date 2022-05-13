<?php include "menunav.php";
$id_cotizacion=$_GET['id_cotizacion'];
include "conexion/conexion.php";
        $conexio=   conectar_bd();

//ini_set("display_errors", "1");
$querycotizacion="select folio_operacion ,vigencia_operacion , tiempo_entrega ,consideraciones , 
                total , subtotal ,iva,iva_porcentual , e.id_empleado as idempleado ,e.nombre as empleado,c2.nombre as cliente, c2.id_cliente as idcliente ,c2.nom_contacto ,c.fecha_registro ,c2.telefono ,descuento,c2.telefono,c2.nom_contacto
                from operaciones c ,empleados e,clientes c2 WHERE 
                c.id_empleado =e.id_empleado and c.id_cliente =c2.id_cliente and id_operacion =".$id_cotizacion;
                echo $querycotizacion;
        $resultcotizacion=$conexio->query($querycotizacion);
        print_r($resultcotizacion);
        while($filacotizacion=$resultcotizacion->fetch_assoc()){
            $foliocotizacion=$filacotizacion['folio_operacion'];
            $idempleado=$filacotizacion['idempleado'];
            $nombreempleado=$filacotizacion['empleado'];
            $idcliente=$filacotizacion['idcliente'];
            $vigencia=$filacotizacion['vigencia_operacion'];
            $tiempo_entrega=$filacotizacion['tiempo_entrega'];
            $consideraciones=$filacotizacion['consideraciones'];
            $telefono=$filacotizacion['telefono'];
            $nom_contacto=$filacotizacion['nom_contacto'];

            $subtotal=$filacotizacion['subtotal'];
            $iva_porcentual=$filacotizacion['iva_porcentual'];
            $iva=$filacotizacion['iva'];
            $total=$filacotizacion['total'];
            $descuento=$filacotizacion['descuento'];

        }
        
$queryvendedor="select e.* from clientes c,empleados e,operaciones c2 where
            c.id_empleado =e.id_empleado
            and c2.id_cliente =c.id_cliente 
            and c2.id_operacion=".$id_cotizacion;
            $vendedor="";
            $result_vendedor=$conexio->query($queryvendedor);
        while($filavendedor=$result_vendedor->fetch_assoc()){
            $vendedor=$filavendedor['nombre'];
        }


        $querydetalle="select p.id_producto,p.SKU ,p.producto, p.descripcion,dc.cantidad ,dc.precio ,dc.descuento ,dc.subtotal, p.unidad_medida from detalle_operaciones dc,productos p ,operaciones c 
where dc.id_producto =p.id_producto and dc.id_operacion =c.id_operacion and c.id_operacion = ".$id_cotizacion;
///echo $querydetalle;
        $result_detalle=$conexio->query($querydetalle);
        $_SESSION['productos_cotizacion_edicion']=array();

        $posiciones=sizeof($_SESSION['productos_cotizacion_edicion']);
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
            $_SESSION['productos_cotizacion_edicion'][$posiciones]=$objdetalle;
            $posiciones++;

        }
//print_r($_SESSION['productos_cotizacion_edicion']);
$_SESSION['tabla_cotizacion']="";
  for($i=0;$i<sizeof($_SESSION['productos_cotizacion_edicion']);$i++){

    $_SESSION['tabla_cotizacion'].="<tr>
    <td class='id' >".$i."</td><td >".$_SESSION['productos_cotizacion_edicion'][$i]->sku."</td>
    <td >".$_SESSION['productos_cotizacion_edicion'][$i]->producto."</td>
    <td ><input type='text' class='cantidades col-sm-9 text-left' name='txtcantidad'  id='txtcantidad".$i."' value='".$_SESSION['productos_cotizacion_edicion'][$i]->stok."' ></td>
    <td ><input type='text' name='txtprecioventa' id='txtprecioventa".$i."' class='precios col-sm-9 text-left'  value='".$_SESSION['productos_cotizacion_edicion'][$i]->precio_venta."' ></td>
    <td ><input type='text' class='descuentos col-sm-9 text-left' name='txtdescuento' id='txtdescuento".$i."' value='".$_SESSION['productos_cotizacion_edicion'][$i]->descuento."'  ></td>
    <td ><input type='text' class='subtotal col-sm-9 text-left' name='txtsubtotal' id='txtsubtotal".$i."' readonly ></td>
    </tr>";
  }

$query2="select * from clientes where estatus='Activo' ;";
        $resultclientes=$conexio->query($query2);
?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12">
                    <h2>COTIZACIONES</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Cotizaciones</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Editar Cotización</strong>
                        </li>
                    </ol>
                </div>
                 <div class="col-lg-2"></div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 id="titulooperacion">Editar Cotización</h5>
                        </div>
                    <div class="ibox-content">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                            <div class="col-12 col-md-7">
                                <div class="form-group">
                                    <label for="barcode-input" class="bmd-label-floating"></label>
                                    <input type="text" class="form-control input-barcode" id="idproductocot" name="idproductocot" maxlength="70" placeholder="SKU" >
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <button type="button" class="btn btn-primary" id="btnvalidaproductocot_edit" name="btnvalidaproductocot_edit"><i class="fa fa-check-circle"></i> &nbsp; Buscar producto</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tbcotiza_edicion" name="tbcotiza_edicion">
                            <thead >
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio Unit</th>
                                    <th scope="col">Descuento</th>
                                    <th scope="col">Precio Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                              if(isset($_SESSION['tabla_cotizacion'])){
                                  echo $_SESSION['tabla_cotizacion'];
                              }else{
                              ?>
                                <tr class="text-center">
                                    <th colspan="8">No hay productos agregados</th>
                                </tr>
                                <?php
                              }
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                   <div class="form-group row align-items-center">
                    <h3 class="col-sm-12 text-center text-uppercase">Detalle Cotización</h3>
                   </div>
                    <hr>
                    <form id="frmregistrocotizaciones_edicion" name="frmregistrocotizaciones_edicion">

                        <div class="form-group row align-items-center" style="display: none;">
                            <div>
                            <label class="col-sm-12 text-left">Operación</label>
                            </div>
                                <div class="col-sm-12 form-group" id="rbtOperacion">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="Cotizacion" id="rbtncotizacion" name="radioInline" checked="checked">
                                            <label class="form-check-label text-secondary col-sm-4" for="
                                            rbtncotizacion"> Cotización </label>

                                        <input class="form-check-input" type="radio" value="Pedido" id="rbtnpedido" name="radioInline">
                                            <label class="form-check-label text-secondary col-sm-4" for="rbtnpedido" > Pedido </label>
                                        <input class="form-check-input" type="radio" value="Venta" id="rbtnventa" name="radioInline">
                                            <label class="form-check-label text-secondary col-sm-4" for="rbtnventa"> Venta </label>
                                            <input type="hidden" name="recuperado" id="recuperado" value="0">
                                            <input type="hidden" name="idrecuperado" id="idrecuperado" value="0">
                                    </div>
                                </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 text-left">Folio Cotización</label>
                            <input type="hidden" name="ide" value="<?php echo $foliocotizacion;?>">
                            <input class="col-sm-9 text-left" type="text" name="txtcapturocot" id="txtcapturocot" value="<?php echo $foliocotizacion;?>" disabled>
                            <input type="hidden" name="hddidcotizacion" value="<?php echo $id_cotizacion;?>">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 text-left">Atención</label>
                            <input type="hidden" name="ide" value="<?php echo $idempleado;?>">
                            <input class="col-sm-9 text-left" type="text" name="txtcapturocot" id="txtcapturocot" value="<?php echo $nombreempleado;?>" disabled>
                        </div>
                        <hr>
                        <div class="form-group row align-items-center">
                            <label for="cotizacion_cliente" class="col-sm-4 text-left">Cliente</label>
                            <select name="slsclientecot" id="slsclientecot" class="col-sm-8 text-right">
                                <option value=""  >*</option>
                                           <?php
                                                while($filaclientes=$resultclientes->fetch_assoc()){
                                                    
                                                    
                                            ?>
                                                <option value="<?php echo $filaclientes['id_cliente']; ?>" <?php if($filaclientes['id_cliente']==$idcliente){
                                                        echo "selected='selected'";
                                                    } ?>>
                                                    <?php echo $filaclientes['nombre'];?>
                                                </option>
                                            <?php
                                                }
                                            ?>
                            </select>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-center">Nom Contacto</label>
                            <label class="col-sm-6 text-center">Telefono</label>
                        </div>
                        <div class="form-group row align-items-center">
                            <input class="col-sm-5" type="text" name="txtnomcontclie" id="txtnomcontclie" disabled placeholder="Margarita Muñoz" value="<?php echo $nom_contacto;?>">
                            <div class="col-sm-2"></div>
                            <input class="col-sm-5" type="text" name="txttelcontclie" id="txttelcontclie" disabled placeholder="55 10123483" value="<?php echo $telefono;?>">
                        </div>
                        <hr>
                        
                        <div class="form-group row align-items-center">
                            <label class="col-sm-5 text-left">Vigencia Cotización</label>
                            <input class="col-sm-7 text-center" type="text" name="txtvigenciacot" id="txtvigenciacot" placeholder="30 días despues de la fecha de hoy(cotizacion)" 
                            value="<?php echo $vigencia; ?>">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-5 text-left">Tiempo de entrega</label>
                            <input class="col-sm-7 text-center" type="text" name="txtentregacot" id="txtentregacot" placeholder="3 - 5 días habiles" value="<?php echo $tiempo_entrega; ?>">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4 text-left">Consideraciones</label>
                            <input class="col-sm-8 text-center" type="text" name="txtconsideracionescot" id="txtconsideracionescot" value="<?php echo $consideraciones; ?>">
                        </div>
                        <hr>
                         <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Subtotal $</label>
                            <input class="col-sm-6 text-center" type="text" name="subtotal_cotiza" id="subtotal_cotiza" readonly="true" placeholder="00.00" value="<?php echo $subtotal; ?>">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Descuento    $</label>
                            <input class="col-sm-6 text-center" type="text" name="txtdescuentocot" id="txtdescuentocot" readonly="true" placeholder="00.00" value="<?php echo $descuento; ?>">
                        </div>

                        <div class="form-group row align-items-center">
                            <select class="form-control col-sm-4" id="iva_cotiza_edicion" name="iva_cotiza_edicion">
                                <option value="">*</option>
                                <option value="16.00" selected>IVA 16%</option>
                                <option value="8.00">IVA 8%</option>
                            </select>
                            <div class="col-sm-2 text-center"></div>
                            <input class="col-sm-6 text-center" type="text" name="iva_cotizacion" id="iva_cotizacion" readonly="true" placeholder="16.00" value="<?php echo $iva_porcentual; ?>">
                        </div>
                        <hr>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Total $</label>
                            <input class="col-sm-6 text-center" type="text" name="total_cotiza" id="total_cotiza" readonly="true" placeholder="166.00" value="<?php echo $total; ?>">
                        </div>
                        <div class="form-group row align-items-center">
                                    <div class="col-sm-6 col-sm-offset-2 text-center">
                                        <input type="button" id="btncancelarcotizacion" name="btncancelarcotizacion" class="btn btn-white btn-sm" value="Cancelar">
                                        <!--<a href="cotizaciones.php" class="btn btn-white btn-sm">Cancelar</a>-->
                                    </div>
                                    <div class="col-sm-6 col-sm-offset-2 text-center">
                                        <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                        <input type="submit" class="ladda-button  btn btn-primary "  data-style="zoom-in" name="btnsubmitcotizacion" id="btnsubmitcotizacion" value="Guardar">
                                    </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
  </div>
  </div>


        <?php include "footer.php"; ?>
