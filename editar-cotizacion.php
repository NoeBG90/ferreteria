<?php include "menunav.php";
 
include "conexion/conexion.php";
        $conexio=   conectar_bd();

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
                            <h5>Editar Cotización</h5>
                        </div>
                    <div class="ibox-content">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                            <div class="col-12 col-md-7">
                                <div class="form-group">
                                    <label for="barcode-input" class="bmd-label-floating"></label>
                                    <input type="text" class="form-control input-barcode" id="barcode-input" maxlength="70" placeholder="SKU" >
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <button type="button" class="btn btn-primary" onclick="buscar_producto()" ><i class="fa fa-check-circle"></i> &nbsp; Verificar producto</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead >
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Precio Unit</th>
                                    <th scope="col">Descuento</th>
                                    <th scope="col">Precio Total</th>
                                    <th scope="col">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <th colspan="8">No hay productos agregados</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                   <div class="form-group row align-items-center">
                    <h3 class="col-sm-12 text-center text-uppercase">Detalle Cotización</h3>
                   </div>
                    <hr>
                    <form id="frmeditarcotizaciones" name="frmeditarcotizaciones">
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 text-left">Atención</label>
                            <input type="hidden" name="ide" value="<?php echo $_GET['ide'];?>">
                            <input class="col-sm-9 text-left" type="text" name="txtcapturocot" id="txtcapturocot" value="<?php echo $_SESSION['Nombre']."-".$_SESSION['Puesto'];?>" disabled>
                        </div>
                        <hr>
                        <div class="form-group row align-items-center">
                            <label for="cotizacion_cliente" class="col-sm-4 text-left">Cliente</label>
                            <select name="slsclientecot" id="slsclientecot" class="col-sm-8 text-right">
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
                            <input class="col-sm-5" type="text" name="txtnomcontclie" id="txtnomcontclie" disabled placeholder="Stephany Ximena Verdiguel Hernandez">
                            <div class="col-sm-2"></div>
                            <input class="col-sm-5" type="text" name="txttelcontclie" id="txttelcontclie" disabled placeholder="5527466635">
                        </div>
                        <hr>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-5 text-left">Condición de Pago</label>
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
                            <label class="col-sm-5 text-left">Vigencia Cotización</label>
                            <input class="col-sm-7 text-center" type="text" name="txtvigenciacot" id="txtvigenciacot" placeholder="30 días despues de la fecha de hoy(cotizacion)">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-5 text-left">Tiempo de entrega</label>
                            <input class="col-sm-7 text-center" type="text" name="txtentregacot" id="txtentregacot" placeholder="3 - 5 días habiles">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4 text-left">Consideraciones</label>
                            <input class="col-sm-8 text-center" type="text" name="txtconsideracionescot" id="txtconsideracionescot">
                        </div>
                         <div class="form-group  row">
                                    <label class="col-sm-6 col-form-label">Estatus</label>
                                    <div class="col-sm-6">
                                        <select name="slsstatuscot" id="slsstatuscot"  class="form-control">
                                            <option value="">*</option>
                                            <option value="Pendiente">Pendiente</option>
                                            <option value="Aceptada">Aceptada</option>
                                            <option value="Rechazada">Rechazada</option>
                                        </select>
                                    </div>
                                </div>
                        <hr>
                         <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Subtotal $</label>
                            <input class="col-sm-6 text-center" type="text" name="txtsubtotalcot" id="txtsubtotalcot" disabled placeholder="150.00">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Descuento    $</label>
                            <input class="col-sm-6 text-center" type="text" name="txtdescuentocot" id="txtdescuentocot" disabled placeholder="00.00">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Neto    $</label>
                            <input class="col-sm-6 text-center" type="text" name="txtnetocot" id="txtnetocot" disabled placeholder="16.00">
                        </div>
                        <div class="form-group row align-items-center">
                            <select class="form-control col-sm-4" id="iva_cot" name="iva_cot">
                                <option value="">--IVA--</option>
                                <option value="16.00">IVA 16%</option>
                                <option value="8.00">IVA 8%</option>
                            </select>
                            <div class="col-sm-2 text-center"></div>
                            <input class="col-sm-6 text-center" type="text" name="txtivacot" id="txtivacot" disabled placeholder="16.00">
                        </div>
                        <hr>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Total $</label>
                            <input class="col-sm-6 text-center" type="text" name="txttotalcot" id="txttotalcot" disabled placeholder="166.00">
                        </div>
                        <div class="form-group row align-items-center">
                                    <div class="col-sm-6 col-sm-offset-2 text-center">
                                        <!--<input type="reset" name="btncancelcliente" name="btncancelcliente" class="btn btn-white btn-sm" value="Cancelar">-->
                                        <a href="cotizaciones.php" class="btn btn-white btn-sm">Cancelar</a>
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
