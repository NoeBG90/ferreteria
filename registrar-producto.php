<?php include "menunav.php";
include "conexion/conexion.php";
$conexio =   conectar_bd();
$query2 = "select * from familia_producto;";
$resultfamilia = $conexio->query($query2);

?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>PRODUCTOS</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a>Productos</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Registrar Producto</strong>
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
                    <h5>Registrar Producto</h5>
                </div>

                <div class="ibox-content">
                    <form name="frmregistroproductos" id="frmregistroproductos" action="servlets/registrarproductos.php" method="post" enctype="multipart/form-data">
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Familia</label>
                            <div class="col-sm-4">
                                <select name="slsfamilia" id="slsfamilia" class="form-control">
                                    <option value="">*</option>
                                    <?php
                                    while ($filafamilia = $resultfamilia->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $filafamilia['id_familia']; ?>"><?php echo $filafamilia['familia']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-sm-2 col-form-label">Sub familia</label>
                            <div class="col-sm-4">
                                <select name="slssubfamilia" id="slssubfamilia" class="form-control">
                                    <option value="">*</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Producto</label>
                            <div class="col-sm-4">
                                <input type="text" name="txtproducto" id="txtproducto" class="form-control" placeholder="Producto">
                            </div>
                            <label class="col-sm-2 col-form-label">Unidad de Medida</label>
                            <div class="col-sm-4">
                                <select name="slsumedida" id="slsumedida" class="form-control">
                                    <option value="">*</option>
                                    <option value="Pzs">Pzs</option>
                                    <option value="Mts">Mts</option>
                                    <option value="Lts">Lts</option>
                                    <option value="Kgs">Kgs</option>
                                    <option value="Caja">Caja</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Marca</label>
                            <div class="col-sm-4">
                                <input type="text" name="txtmarca" id="txtmarca" class="form-control" placeholder="Marca">
                            </div>
                            <label class="col-lg-2 col-form-label">Modelo</label>
                            <div class="col-lg-4">
                                <input type="text" name="txtmodelo" id="txtmodelo" class="form-control" placeholder="Modelo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Precio Compra $</label>
                            <div class="col-sm-4">
                                <input type="text" name="txtprecompra" id="txtprecompra" class="form-control" placeholder="00.00">
                            </div>
                            <label class="col-lg-2 col-form-label">Precio Venta $</label>
                            <div class="col-lg-4">
                                <input type="text" name="txtpreventa" id="txtpreventa" class="form-control" placeholder="00.00">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Stock</label>
                            <div class="col-sm-4">
                                <input type="text" name="txtstock" id="txtstock" class="form-control" placeholder="50">
                            </div>
                            <!--<label class="col-lg-1 col-form-label">SKU</label>
                            <div class="col-lg-1">
                                <input type="text" name="clave_producto" id="clave_producto" class="form-control" placeholder="CVE" readonly>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" name="txtSKU" id="txtSKU" class="form-control" placeholder="424356">
                            </div > -->
                            <label class="col-sm-2 col-form-label">Estatus</label>
                            <div class="col-sm-4">
                                <select name="slsstatus" id="slsstatus" class="form-control">
                                    <option value="">*</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Descripción</label>
                            <div class="col-sm-10 ibox-content">
                                <textarea name="textadescripcion" id="textadescripcion" data-provide="markdown" rows="10" placeholder="Ingrese una descripción del producto a registrar"></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Imagen Producto</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly="true" placeholder="Buscar imagen" id="file" name="file">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary">Buscar...</button>
                                    </div>
                                </div>
                                <input type="file" name="img" class="file" accept="image/*">

                            </div>
                            <div class="col-sm-4"><img src="" id="preview" class="img-thumbnail"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-6 col-sm-offset-2">
                                <a href="Productos.php" class="btn btn-white btn-sm">Cancelar</a>
                                <!--<input type="reset" name="btncancelprod" name="btncancelprod" class="btn btn-white btn-sm" value="Cancelar">-->
                                <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                <input type="submit" class="ladda-button  btn btn-primary " data-style="zoom-in" name="btnsubmitprod" id="btnsubmitprod" value="Guardar">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    localStorage.setItem("pagina", "registrar-producto");
</script>
<?php
include "footer.php";
?>