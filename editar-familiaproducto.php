<?php include "menunav.php"; 
include "conexion/conexion.php";
        $conexio=   conectar_bd();
        $query="SELECT * FROM familia_producto where id_familia=".$_GET['idfp'];
        $result=$conexio->query($query);
        $fila=$result->fetch_assoc();
        //while($fila=$result->fetch_assoc()){ 
        //}
?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>FAMILIA PRODUCTOS</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Familia Productos</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Editar Familia Producto</strong>
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
                            <h5>Editar Familia Producto</h5>
                        </div>
                        <div class="ibox-content">
                            <form name="frmeditarfamiliaproductos" id="frmeditarfamiliaproductos">
                                <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Núm Familia Producto</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="txtnumfamiliaprod" name="txtnumfamiliaprod" class="form-control" readonly value="<?php echo $fila['id_familia']; ?>">
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Familia</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="txtfamproducto" id="txtfamproducto" class="form-control" placeholder="Familia Producto" value="<?php echo $fila['familia']; ?>">
                                        <input type="hidden" name="idfp" value="<?php echo $_GET['idfp']; ?>">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Estatus</label>
                                    <div class="col-sm-4">
                                        <select name="slsfamstatus" id="slsfamstatus"  class="form-control">
                                            <option value="">*</option>
                                            <option value="Activo" <?php if($fila['estatus']=="Activo"){ echo 'selected="selected"';} ?> >Activo</option>
                                            <option value="Inactivo" <?php if($fila['estatus']=="Inactivo"){ echo 'selected="selected"';} ?>>Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Descripción</label>
                                    <div class="col-sm-10 ibox-content">
                                        <textarea  name="textafamdescripcion" id="textafamdescripcion" data-provide="markdown" rows="10" placeholder="Ingrese una descripción de la familia de producto a registrar"><?php echo $fila['descripcion']; ?></textarea>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-sm-offset-2">
                                        <a href="familias.php" class="btn btn-white btn-sm">Cancelar</a>
                                        <!--<input type="reset" name="btncancelfamprod" name="btncancelfamprod" class="btn btn-white btn-sm" value="Cancelar">-->
                                        <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                        <input type="submit" class="ladda-button  btn btn-primary "  data-style="zoom-in" name="btnsubmitfamprod" id="btnsubmitfamprod" value="Actualizar">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
    localStorage.setItem("pagina","editar-familiaproducto");
</script>
<?php include "footer.php"; ?>