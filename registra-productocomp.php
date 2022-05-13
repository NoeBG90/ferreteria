<?php
include "headerfancy.php";
include "conexion/conexion.php";
        $conexio=   conectar_bd();
        $query2="select * from familia_producto;";
        $resultfamilia=$conexio->query($query2);
?>
  <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Registrar Producto no Existente</h5>

                        </div>
                        <div class="ibox-content">
                            <form name="frmregistroproductoscomp" id="frmregistroproductoscomp" action="servlets/registrarproductoscomp.php" method="post" enctype="multipart/form-data" >
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Producto</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="txtproducto" id="txtproducto" class="form-control" placeholder="Producto">
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Unidad de Medida</label>
                                    <div class="col-sm-4">
                                        <select name="slsumedida" id="slsumedida"  class="form-control">
                                            <option value="">*</option>
                                            <option value="Pzs">Pzs</option>
                                            <option value="Mts">Mts</option>
                                            <option value="Lts">Lts</option>
                                            <option value="Kgs">Kgs</option>
                                            <option value="Caja">Caja</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Familia</label>
                                    <div class="col-sm-4">
                                        <select name="slsfamiliacomp" id="slsfamiliacomp"  class="form-control">
                                            <option value="">*</option>
                                            <?php
                                                while($filafamilia=$resultfamilia->fetch_assoc()){ 
                                            ?>
                                            <option value="<?php echo $filafamilia['id_familia']; ?>"><?php echo $filafamilia['familia'];?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">SKU</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="txtSKUcomp" id="txtSKUcomp" class="form-control" placeholder="424356">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Marca</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="txtmarcacomp" id="txtmarcacomp" class="form-control" placeholder="Marca">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Modelo</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="txtmodelocomp" id="txtmodelocomp" class="form-control" placeholder="Modelo">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Estatus</label>
                                    <div class="col-sm-4">
                                        <select name="slsstatuscomp" id="slsstatuscomp"  class="form-control">
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
                                        <textarea  name="textadescripcioncomp" id="textadescripcioncomp" data-provide="markdown" rows="10" placeholder="Ingrese una descripción del producto nuevo a registrar"></textarea>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Imagen Producto</label>
                                    <div class="col-sm-4"><img src="servlets/subida/noimagecompra.png" id="preview" class="img-thumbnail"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-sm-offset-2">
                                        <a href="compras.php" class="btn btn-white btn-sm">Cancelar</a>
                                        <!--<input type="reset" name="btncancelprod" name="btncancelprod" class="btn btn-white btn-sm" value="Cancelar">-->
                                        <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                        <input type="submit" class="ladda-button  btn btn-primary "  data-style="zoom-in" name="btnsubmitprod" id="btnsubmitprod" value="Guardar">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include "footerfancy.php";
?>
