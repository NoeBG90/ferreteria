<?php include "menunav.php";
include "conexion/conexion.php";
$conexio =   conectar_bd();
$query = "SELECT * FROM subfamilia_producto where id_subfamilia=" . $_GET['idsfp'];
$result = $conexio->query($query);
$fila = $result->fetch_assoc();
//while($fila=$result->fetch_assoc()){ 
//}

$query2 = "select * from familia_producto;";
$resultfamilia = $conexio->query($query2);
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>SUBFAMILIA PRODUCTOS</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a>SubFamilia Productos</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Editar SubFamilia Producto</strong>
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
                    <h5>Editar SubFamilia Producto</h5>
                </div>
                <div class="ibox-content">
                    <form name="frmeditarsubfamiliaproductos" id="frmeditarsubfamiliaproductos">
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Núm SubFamilia Producto</label>
                            <div class="col-sm-4">
                                <input type="text" id="txtnumsubfamiliaprod" name="txtnumsubfamiliaprod" class="form-control" readonly value="<?php echo $fila['id_subfamilia']; ?>">
                            </div>
                        </div>
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">SubFamilia</label>
                            <div class="col-sm-4">
                                <input type="text" name="txtsubfamproducto" id="txtsubfamproducto" class="form-control" placeholder="SubFamilia Producto" value="<?php echo $fila['subfamilia']; ?>">
                                <input type="hidden" name="idsfp" value="<?php echo $_GET['idsfp']; ?>">
                            </div>
                            <label class="col-sm-2 col-form-label">Estatus</label>
                            <div class="col-sm-4">
                                <select name="slssubfamstatus" id="slssubfamstatus" class="form-control">
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
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Código Subfamilia</label>
                            <div class="col-sm-4">
                                <input type="text" name="txtcodsubfamprod" id="txtcodsubfamprod" class="form-control" placeholder="NG" value="<?php echo $fila['numero_subfamiliaprod']; ?>">
                            </div>

                            <label class="col-sm-2 col-form-label">Familia</label>
                            <div class="col-sm-4">
                                <select name="slsfamilia" id="slsfamilia" class="form-control">
                                    <option value="">*</option>
                                    <?php
                                    while ($filafamilia = $resultfamilia->fetch_assoc()) {
                                    ?>
                                        <option <?php
                                                if ($fila['id_familia'] == $filafamilia['id_familia']) {
                                                    echo 'selected="selected"';
                                                }

                                                ?> value="<?php echo $filafamilia['id_familia']; ?>"><?php echo $filafamilia['familia']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Descripción</label>
                            <div class="col-sm-10 ibox-content">
                                <textarea name="textasubfamdescripcion" id="textasubfamdescripcion" data-provide="markdown" rows="10" placeholder="Ingrese una descripción de la subfamilia de producto a registrar"><?php echo $fila['descripcion']; ?></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-6 col-sm-offset-2">
                                <a href="subfamilias.php" class="btn btn-white btn-sm">Cancelar</a>
                                <!--<input type="reset" name="btncancelfamprod" name="btncancelfamprod" class="btn btn-white btn-sm" value="Cancelar">-->
                                <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                <input type="submit" class="ladda-button  btn btn-primary " data-style="zoom-in" name="btnsubmitsubfamprod" id="btnsubmitsubfamprod" value="Actualizar">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    localStorage.setItem("pagina", "editar-subfamiliaproducto");
</script>
<?php include "footer.php"; ?>