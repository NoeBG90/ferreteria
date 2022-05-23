<?php include "menunav.php";
include "conexion/conexion.php";
ini_set("display_errors", "1");

$conexio =   conectar_bd();
$query = "SELECT * FROM productos where id_producto=" . $_GET['idprodu'];
$result = $conexio->query($query);
$fila = $result->fetch_assoc();

$query2 = "select * from familia_producto where estatus='Activo';";
$resultfamilia = $conexio->query($query2);

$querydatosfamilias = "select sp.id_subfamilia ,fp.id_familia  from subfamilia_producto sp ,familia_producto fp WHERE sp.id_familia = fp.id_familia and id_subfamilia =" . $fila['id_familia'] . ";";
$resultdatosFamilia = $conexio->query($querydatosfamilias);
$filadatosfam = $resultdatosFamilia->fetch_assoc();

$query_subfamilia = "select * from subfamilia_producto where estatus='Activo' and id_familia =" . $filadatosfam['id_familia'] . ";";
$resultsubfamilia = $conexio->query($query_subfamilia);
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
                <strong>Editar Producto</strong>
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
                    <h5>Editar Producto</h5>

                </div>
                <div class="ibox-content">
                    <form name="frmeditarproductos" id="frmeditarproductos" action="servlets/guardar_compra.php" method="post" enctype="multipart/form-data">
                        <div class="form-group  row">
                            <label class="col-sm-1 col-form-label">Familia</label>
                            <div class="col-sm-4">
                                <select name="slsfamilia" id="slsfamilia" class="form-control" disabled>
                                    <option value="">*</option>
                                    <?php
                                    while ($filafamilia = $resultfamilia->fetch_assoc()) {
                                    ?>
                                        <option <?php
                                                if ($filadatosfam['id_familia'] == $filafamilia['id_familia']) {
                                                    echo 'selected="selected"';
                                                }

                                                ?> value="<?php echo $filafamilia['id_familia']; ?>"><?php echo $filafamilia['familia']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <label class="col-sm-1 col-form-label">Sub familia</label>
                            <div class="col-sm-6">
                                <select name="slssubfamilia" id="slssubfamilia" class="form-control" disabled>
                                    <option value="">*</option>
                                    <?php
                                    while ($filasubfamilia = $resultsubfamilia->fetch_assoc()) {
                                    ?>
                                        <option <?php
                                                if ($filadatosfam['id_subfamilia'] == $filasubfamilia['id_subfamilia']) {
                                                    echo 'selected="selected"';
                                                }
                                                ?> value="<?php echo $filasubfamilia['id_subfamilia']; ?>"><?php echo $filasubfamilia['subfamilia']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group  row">
                            <!--<label class="col-sm-2 col-form-label">Núm. Producto</label> -->
                            <label class="col-lg-1 col-form-label">SKU</label>
                            <div class="col-sm-4">
                                <input type="text" name="txtSKU" id="txtSKU" class="form-control" placeholder="424356" value="<?php echo $fila['SKU']; ?>" readonly>
                                <!--<input type="text" name="txtnumproducto" id="txtnumproducto" class="form-control" value="<?php echo $fila['codigo_producto']; ?>" disabled> -->
                            </div>
                            <label class="col-sm-1 col-form-label">Producto</label>
                            <div class="col-sm-6">
                                <input type="text" name="txtproducto" id="txtproducto" class="form-control" placeholder="Producto" value="<?php echo $fila['producto']; ?>" disabled>
                                <input type="hidden" name="idprodu" value="<?php echo $_GET['idprodu']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Marca</label>
                            <div class="col-sm-4">
                                <input type="text" name="txtmarca" id="txtmarca" class="form-control" placeholder="Marca" value="<?php echo $fila['marca']; ?>">
                            </div>
                            <label class="col-lg-2 col-form-label">Modelo</label>
                            <div class="col-lg-4">
                                <input type="text" name="txtmodelo" id="txtmodelo" class="form-control" placeholder="Modelo" value="<?php echo $fila['modelo']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Precio Compra $</label>
                            <div class="col-sm-4">
                                <input type="text" name="txtprecompra" id="txtprecompra" class="form-control" placeholder="00.00" value="<?php echo $fila['precio_compra']; ?>">
                            </div>
                            <label class="col-lg-2 col-form-label">Precio Venta $</label>
                            <div class="col-lg-4">
                                <input type="text" name="txtpreventa" id="txtpreventa" class="form-control" placeholder="00.00" value="<?php echo $fila['precio_venta']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Stock</label>
                            <div class="col-sm-4">
                                <input type="text" name="txtstock" id="txtstock" class="form-control" placeholder="50" value="<?php echo $fila['stock']; ?>">
                            </div>
                            <label class="col-sm-2 col-form-label">Unidad de Medida</label>
                            <div class="col-sm-4">
                                <select name="slsumedida" id="slsumedida" class="form-control">
                                    <option value="">*</option>
                                    <option value="Pzs" <?php if ($fila['unidad_medida'] == "Pzs") {
                                                            echo 'selected="selected"';
                                                        } ?>>Pzs</option>
                                    <option value="Mts" <?php if ($fila['unidad_medida'] == "Mts") {
                                                            echo 'selected="selected"';
                                                        } ?>>Mts</option>
                                    <option value="Lts" <?php if ($fila['unidad_medida'] == "Lts") {
                                                            echo 'selected="selected"';
                                                        } ?>>Lts</option>
                                    <option value="Kgs" <?php if ($fila['unidad_medida'] == "Kgs") {
                                                            echo 'selected="selected"';
                                                        } ?>>Kgs</option>
                                    <option value="Caja" <?php if ($fila['unidad_medida'] == "Caja") {
                                                                echo 'selected="selected"';
                                                            } ?>>Caja</option>
                                </select>
                            </div>
                            <!--<label class="col-lg-2 col-form-label">SKU</label>

                            <div class="col-lg-4">
                                <input type="text" name="txtSKU" id="txtSKU" class="form-control" placeholder="424356" value="<?php echo $fila['SKU']; ?>" readonly>
                            </div> -->
                        </div>
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Estatus</label>
                            <div class="col-sm-4">
                                <select name="slsstatus" id="slsstatus" class="form-control">
                                    <option value="">*</option>
                                    <option value="Activo" <?php if ($fila['estatus'] == "Activo") {
                                                                echo 'selected="selected"';
                                                            } ?>>Activo</option>
                                    <option value="Inactivo" <?php if ($fila['estatus'] == "Inactivo") {
                                                                    echo 'selected="selected"';
                                                                } ?>>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Descripción</label>
                            <div class="col-sm-10 ibox-content">
                                <textarea name="textadescripcion" id="textadescripcion" data-provide="markdown" rows="10" placeholder="Ingrese una descripción del producto a registrar"><?php echo $fila['descripcion']; ?></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">¿Editar Imagen?</label>
                            <div class="col-lg-4">
                                <input type="checkbox" id="cbxacceso" name="cbxacceso" value="Si" class="form-control">

                                <input type="hidden" name="imagenback" value="<?php echo $fila['imagen_producto']; ?>">
                            </div>
                        </div>
                        <div class="form-group row" style="display: none;" id="divusuario">
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
                                <input type="submit" class="ladda-button  btn btn-primary " data-style="zoom-in" name="btnsubmitprod" id="btnsubmitprod" value="Actualizar">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    localStorage.setItem("pagina", "editar-productos");
</script>
<?php include "footer.php"; ?>