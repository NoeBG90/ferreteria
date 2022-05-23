<?php
include "menunav.php";
include "conexion/conexion.php";
$conexio =   conectar_bd();
$queryfamilia = "select * from familia_producto fp where estatus ='Activo';";
$resultfamilias = $conexio->query($queryfamilia);
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>SUBFAMILIA PRODUCTOS</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="home.php">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="subfamilias.php">Subfamilia Productos</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Registrar Subfamilia Producto</strong>
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
                    <h5>Registrar Subfamilia Producto</h5>
                </div>
                <div class="ibox-content">
                    <form name="frmregistrosubfamilia" id="frmregistrosubfamilia">
                        <div class="form-group  row">

                            <label class="col-sm-3 col-form-label">Subfamilia</label>
                            <div class="col-sm-3">
                                <input type="text" name="txtsubfamproducto" id="txtsubfamproducto" class="form-control" placeholder="Subfamilia Producto">
                            </div>

                            <label class="col-sm-3 col-form-label">Estatus</label>
                            <div class="col-sm-3">
                                <select name="slssubfamstatus" id="slssubfamstatus" class="form-control">
                                    <option value="">*</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group  row">
                            <label class="col-sm-3 col-form-label">Código Subfamilia</label>
                            <div class="col-sm-3">
                                <input type="text" name="txtcodsubfamprod" id="txtcodsubfamprod" class="form-control" placeholder="NG">
                            </div>

                            <label class="col-sm-3 col-form-label">Familia</label>
                            <div class="col-sm-3">
                                <select name="slsfamilias" id="slsfamilias" class="form-control">
                                    <option value="">*</option>
                                    <?php
                                    while ($filafamilia = $resultfamilias->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $filafamilia['id_familia']; ?>"><?php echo $filafamilia['id_familia'] . " - " . $filafamilia['familia']; ?></option>
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
                                <textarea name="textasubfamdescripcion" id="textasubfamdescripcion" data-provide="markdown" rows="10" placeholder="Ingrese una descripción de la familia de producto a registrar"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 col-sm-offset-2">
                                <a href="familias.php" class="btn btn-white btn-sm">Cancelar</a>

                                <input type="submit" class="ladda-button  btn btn-primary " data-style="zoom-in" name="btnsubmitfamprod" id="btnsubmitfamprod" value="Guardar">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    localStorage.setItem("pagina", "registrar-subfamilia");
</script>
<?php include "footer.php"; ?>