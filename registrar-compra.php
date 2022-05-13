<?php include "menunav.php";

include "conexion/conexion.php";
        $conexio=   conectar_bd();

$query2="select * from proveedores where estatus='Activo' ;";
        $resultproveedor=$conexio->query($query2);
?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12">
                    <h2>COMPRA</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Compras</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Registrar Compra</strong>
                        </li>
                    </ol>
                </div>
                 <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Registrar COMPRA</h5>
                        </div>
                    <div class="ibox-content">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                            <div class="col-12 col-md-7">
                                <div class="form-group">
                                    <label for="barcode-input" class="bmd-label-floating"></label>
                                    <input type="text" class="form-control input-barcode"
                                     id="productoid" name="productoid" maxlength="70" placeholder="SKU ó Producto" >

                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <button type="button" class="btn btn-primary" id="btnvalidarproducto" name="btnvalidarproducto"><i class="fa fa-check-circle"></i> &nbsp; Verificar producto</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tbcompra" name="tbcompra">
                            <thead >
                                <tr class="text-center">
                                    <th scope="col">#</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Subtotal</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              if(isset($_SESSION['tabla'])){
                                  echo $_SESSION['tabla'];
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
                    <h3 class="text-center text-uppercase">Datos de la compra</h3>
                    <hr>
                    <form  id="frmcompra" name="frmcompra" role="form">
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 text-left">Folio Factura</label>
                            <input class="col-sm-9 text-center" type="text" name="txtfolio_factura" id="txtfolio_factura" placeholder="E4GXXXXX-XXXX-XXXX-XXXX-XXXXXXXX">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4 text-left">Fecha</label>
                            <input class="col-sm-8 text-center" type="text" name="txtfecha_compra" id="txtfecha_compra">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 text-left">Empleado</label>
                            <input type="hidden" name="hddide" id="hddide" value="<?php echo $_SESSION['idempleado'];?>">
                            <input class="col-sm-9 text-left" type="text" name="capturo_compra" id="capturo_compra" value="<?php echo $_SESSION['Nombre']."-".$_SESSION['Puesto'];?>" disabled>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="compra_proveedor" class="col-sm-4 text-left">Proveedor</label>
                            <select name="slsproveedor" id="slsproveedor" class="col-sm-8 text-right">
                                <option value="">*</option>
                                           <?php
                                                while($filaproveedor=$resultproveedor->fetch_assoc()){
                                            ?>
                                                <option value="<?php echo $filaproveedor['id_proveedor']; ?>" ><?php echo $filaproveedor['nombre'];?></option>
                                            <?php
                                                }
                                            ?>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Subtotal $</label>
                            <input class="col-sm-6 text-center" type="text" name="subtotal_compra" id="subtotal_compra" readonly placeholder="150.00">
                        </div>
                        <div class="form-group row align-items-center">
                            <select class="form-control col-sm-4" id="iva_compra" name="iva_compra">
                                <option value="">--IVA--</option>
                                <option value="16.00" selected>IVA 16%</option>
                                <option value="8.00">IVA 8%</option>
                            </select>
                            <div class="col-sm-2 text-center"></div>
                            <input class="col-sm-6 text-center" type="text" name="iva_monto" id="iva_monto" readonly placeholder="16.00">
                        </div>
                        <hr>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Total $</label>
                            <input class="col-sm-6 text-center" type="text" name="total_compra" id="total_compra" readonly placeholder="166.00">
                        </div>
                        <div class="form-group row">
                                    <div class="col-sm-6 col-sm-offset-2">
                                        <!--<input type="reset" name="btncancelcliente" name="btncancelcliente" class="btn btn-white btn-sm" value="Cancelar">-->
                                        <a href="compras.php" class="btn btn-white btn-sm">Cancelar</a>
                                    </div>
                                    <div>
                                        <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                        <input type="submit" class="ladda-button  btn btn-primary "  data-style="zoom-in" name="btnsubmitcompra" id="btnsubmitcompra" value="Guardar">
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
<script type="text/javascript">
    localStorage.setItem("pagina","registrar-compra");
</script>

<?php include "footer.php"; ?>
