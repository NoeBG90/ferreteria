<?php include "headerfancy.php";

include "conexion/conexion.php";
        $conexio=   conectar_bd();
$query2="select * from clientes where estatus='Activo' ;";
        $resultclientes=$conexio->query($query2);
?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12">
                    <h2>PEDIDOS</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Pedidos</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Registrar Pedido</strong>
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
                            <h5>Registrar Pedido</h5>
                        </div>
                    <div class="ibox-content">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                            <div class="col-12 col-md-7">
                                <div class="form-group">
                                    <label for="barcode-input" class="bmd-label-floating"></label>
                                    <input type="text" class="form-control input-barcode" id="idproductopedido" name="idproductopedido" maxlength="70" placeholder="SKU" >
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <button type="button" class="btn btn-primary" id="btnvalidaproductopedido" name="btnvalidaproductopedido"><i class="fa fa-check-circle"></i> &nbsp; Buscar producto</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tbpedido" name="tbpedido">
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
                    <h3 class="col-sm-12 text-center text-uppercase">Detalle Pedido</h3>
                   </div>
                    <hr>
                    <form id="frmregistropedido" name="frmregistropedido">
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 text-left">Folio Pedido</label>
                            <input class="col-sm-9 text-center" type="text" name="txtfolio_pedido" id="txtfolio_pedido" disabled placeholder="PE001-SARS">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4 text-left">Fecha Solicitud</label>
                            <input class="col-sm-8 text-center" type="text" name="txtfecha_pedido" id="txtfecha_pedido">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 text-left">Atención</label>
                            <input type="hidden" name="ide" value="<?php echo $_SESSION['idempleado'];?>">
                            <input class="col-sm-9 text-left" type="text" name="txtcapturocot" id="txtcapturocot" value="<?php echo $_SESSION['Nombre']."-".$_SESSION['Puesto'];?>" disabled>
                        </div>
                        <hr>
                        <div class="form-group row align-items-center">
                            <label for="pedido_cliente" class="col-sm-4 text-left">Cliente</label>
                            <select name="slsclientepedido" id="slsclientepedido" class="col-sm-8 text-right">
                                <option value="">*</option>
                                           <?php
                                                while($filaclientes=$resultclientes->fetch_assoc()){
                                            ?>
                                                <option value="<?php echo $filaclientes['id_cliente']; ?>"><?php echo $filaclientes['nombre'];?></option>
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
                            <input class="col-sm-5" type="text" name="txtnomcontclie" id="txtnomcontclie" disabled placeholder="Margarita Muñoz">
                            <div class="col-sm-2"></div>
                            <input class="col-sm-5" type="text" name="txttelcontclie" id="txttelcontclie" disabled placeholder="55 10123483">
                        </div>
                        <hr>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-5 text-left">Fecha de entrega</label>
                            <input class="col-sm-7 text-center" type="text" name="txtentregaped" id="txtentregaped" placeholder="3 - 5 días habiles">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-5 text-left">Metodo de Pago</label>
                                <div class="form-group text-center">
                                <div class="form-check form-check-inline" onclick="resetear_total('Contado')" >
                                    <input class="form-check-input" type="radio" name="rbtnpago" value="Contado" id="rbtncontado">
                                    <label class="form-check-label text-secondary" for="venta_radio_contado" ><i class="fa fa-money"></i> &nbsp; Contado</label>
                                </div>
                                <div class="form-check form-check-inline" onclick="resetear_total('Credito')" >
                                    <input class="form-check-input" type="radio" name="rbtnpago" value="Credito" id="rbtncredito">
                                    <label class="form-check-label text-secondary" for="rbtncredito" ><i class="fa fa-dollar (alias)"></i> &nbsp; Credito</label>
                                </div>
                                </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4 text-left">Consideraciones</label>
                            <input class="col-sm-8 text-center" type="text" name="txtconsideracionesped" id="txtconsideracionesped">
                        </div>
                        <hr>
                         <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Subtotal $</label>
                            <input class="col-sm-6 text-center" type="text" name="subtotal_pedido" id="subtotal_pedido" readonly="true" placeholder="00.00">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Descuento    $</label>
                            <input class="col-sm-6 text-center" type="text" name="txtdescuentoped" id="txtdescuentoped" readonly="true" placeholder="00.00">
                        </div>

                        <div class="form-group row align-items-center">
                            <select class="form-control col-sm-4" id="iva_ped" name="iva_ped">
                                <option value="">*</option>
                                <option value="16.00" selected>IVA 16%</option>
                                <option value="8.00">IVA 8%</option>
                            </select>
                            <div class="col-sm-2 text-center"></div>
                            <input class="col-sm-6 text-center" type="text" name="iva_pedido" id="iva_pedido" readonly="true" placeholder="16.00">
                        </div>
                        <hr>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Total $</label>
                            <input class="col-sm-6 text-center" type="text" name="total_pedido" id="total_pedido" readonly="true" placeholder="166.00">
                        </div>
                        <div class="form-group row align-items-center">
                                    <div class="col-sm-6 col-sm-offset-2 text-center">
                                        <!--<input type="reset" name="btncancelcliente" name="btncancelcliente" class="btn btn-white btn-sm" value="Cancelar">-->
                                        <a href="pedidos.php" class="btn btn-white btn-sm">Cancelar</a>
                                    </div>
                                    <div class="col-sm-6 col-sm-offset-2 text-center">
                                        <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                        <input type="submit" class="ladda-button  btn btn-primary "  data-style="zoom-in" name="btnsubmitpedido" id="btnsubmitpedido" value="Guardar">
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
<?php include "footerfancy.php"; ?>
