<?php include "menunav.php"; 

include "conexion/conexion.php";
        $conexio=   conectar_bd();

$query2="select * from clientes where estatus='Activo' ;";
        $resultclientes=$conexio->query($query2);
?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12">
                    <h2>VENTA</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Ventas</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Registrar Venta</strong>
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
                            <h5>Registrar Venta</h5>            
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
                                <button type="button" class="btn btn-primary" onclick="buscar_producto()" ><i class="far fa-check-circle"></i> &nbsp; Verificar producto</button>
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
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Remover</th>
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
                    <h3 class="text-center text-uppercase">Datos de la venta</h3>
                    <hr>
                    <form>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4 text-left">Folio venta</label>
                            <input class="col-sm-8 text-center" type="text" name="folio_venta" id="folio_venta" placeholder="VENT-01-010621001" disabled>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 text-left">Folio Factura</label>
                            <input class="col-sm-9 text-center" type="text" name="folio_factura" id="folio_factura" placeholder="E4GXXXXX-XXXX-XXXX-XXXX-XXXXXXXX">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4 text-left">Fecha</label>
                            <input class="col-sm-8 text-center" type="date" name="fecha_venta" id="fecha_venta">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 text-left">Empleado</label>
                            <input type="hidden" name="ide" value="<?php echo $_GET['ide'];?>">
                            <input class="col-sm-9 text-left" type="text" name="capturo_venta" id="capturo_venta" value="<?php echo $_SESSION['Nombre']."-".$_SESSION['Puesto'];?>" disabled>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="venta_cliente" class="col-sm-4 text-left">Cliente</label>
                            <select name="slscliente" id="slscliente" class="col-sm-8 text-right">
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
                        <hr>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Subtotal $</label>
                            <input class="col-sm-6 text-center" type="text" name="subtotal_venta" id="subtotal_venta" disabled placeholder="150.00">
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">IVA 16%    $</label>
                            <input class="col-sm-6 text-center" type="text" name="iva_venta" id="iva_venta" disabled placeholder="16.00">
                        </div>
                        <hr>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-left">Total $</label>
                            <input class="col-sm-6 text-center" type="text" name="total_venta" id="total_venta" disabled placeholder="166.00">
                        </div>
                        <div class="form-group row">
                                    <div class="col-sm-6 col-sm-offset-2">
                                        <!--<input type="reset" name="btncancelcliente" name="btncancelcliente" class="btn btn-white btn-sm" value="Cancelar">-->
                                        <a href="ventas.php" class="btn btn-white btn-sm">Cancelar</a>
                                    </div>
                                    <div>
                                        <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                        <input type="submit" class="ladda-button  btn btn-primary "  data-style="zoom-in" name="btnsubmitventa" id="btnsubmitventa" value="Guardar">
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



