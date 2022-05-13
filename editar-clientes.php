<?php 
ini_set("display_errors","1");
include "menunav.php";
include "conexion/conexion.php";
        $conexio=   conectar_bd();
        $query="SELECT * FROM clientes where id_cliente=".$_GET['idc'];

        $result=$conexio->query($query);
        $fila=$result->fetch_assoc();
        //while($fila=$result->fetch_assoc()){ 
        //}
        $query2="select * from empleados where puesto='Vendedor' and estatus='Activo' ;";
        $resultempleados=$conexio->query($query2);

        $query3="select * from formas_pago;";
        $resultmetpagcl=$conexio->query($query3);
 ?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>CLIENTES</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index2.php">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Clientes</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Editar Cliente</strong>
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
                            <h5>Editar Cliente</h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form id="frmeditarclientes" name="frmeditarclientes">
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Número Cliente</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="txtnumcliente" name="txtnumcliente" class="form-control" readonly value="<?php echo $fila['numero_cliente']; ?>">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Nombre Cliente</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="txtnomcliente" name="txtnomcliente" placeholder="Nombre Cliente" class="form-control" value="<?php echo $fila['nombre']; ?>">
                                        <input type="hidden" name="idc" value="<?php echo $_GET['idc']; ?>">
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Teléfono</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="txttel" name="txttel" placeholder="5512345678" class="form-control" value="<?php echo $fila['telefono']; ?>">
                                    </div>
                                    <label class="col-sm-2 col-form-label">RFC</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="txtRFC" name="txtRFC" placeholder="ej. EFGH831209FNM" class="form-control" value="<?php echo $fila['RFC']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">E-mail</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="txtemail" name="txtemail" placeholder="ejemplo@ejemplo.com" class="form-control" value="<?php echo $fila['email']; ?>">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Nombre Contacto</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="txtnomcontacto" name="txtnomcontacto" placeholder="Nombre contacto" class="form-control" value="<?php echo $fila['nom_contacto']; ?>">
                                    </div>
                                </div>

                                <div class="ibox-title">
                                    <h5>Dirección Cliente</h5>                  
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-1 col-form-label">Calle / Avenida</label>
                                    <div class="col-sm-5">
                                        <input type="text" id="txtcalleavenida" name="txtcalleavenida" placeholder="Calle / Avenida" class="form-control" value="<?php echo $fila['calle']; ?>">
                                    </div>
                                    <label class="col-sm-1 col-form-label">No. Ext</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="txtnoext" name="txtnoext" placeholder="No. Ext" class="form-control" value="<?php echo $fila['exterior']; ?>">
                                    </div>
                                    <label class="col-sm-1 col-form-label">No. Int</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="txtnoint" name="txtnoint" placeholder="No. Int" class="form-control" value="<?php echo $fila['interior']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Codigo Postal</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="txtcp" name="txtcp" placeholder="C.P" class="form-control" value="<?php echo $fila['cp']; ?>">
                                    </div>
                                    <label class="col-sm-1 col-form-label">Colonia</label>
                                    <div class="col-sm-3">
                                        <select name="slscolonia" id="slscolonia"  class="form-control">
                                            <option value="">*</option>
                                            <option value="1" <?php if($fila['colonia']=="1"){ echo 'selected="selected"';} ?> >S1 <?php echo $fila['colonia'];?></option>
                                            <option value="2" <?php if($fila['colonia']=="2"){ echo 'selected="selected"';} ?>>S2</option>
                                            <option value="3" <?php if($fila['colonia']=="3"){ echo 'selected="selected"';} ?>>S3</option>
                                            <option value="4" <?php if($fila['colonia']=="4"){ echo 'selected="selected"';} ?>>S4</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-1 col-form-label">Ciudad</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="txtciudad" name="txtciudad" readonly class="form-control" value="<?php echo $fila['ciudad']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="txtedo" name="txtedo" class="form-control" readonly value="<?php echo $fila['estado']; ?>">
                                    </div>
                                    <!--<label class="col-sm-2 col-form-label">País</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="txtpais" name="txtpais" placeholder="México" class="form-control" value="<?php echo $fila['pais']; ?>">
                                    </div>-->
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Metodo de Pago</label>
                                        <div class="col-sm-4">
                                            <select name="slsmetpagoclie" id="slsmetpagoclie" class="form-control">
                                                <option value="">*</option>
                                               <?php
                                                    while($filametpagcl=$resultmetpagcl->fetch_assoc()){ 
                                                        //rint_r($fila);
                                                ?>
                                                    <option  <?php 
                                                    if($fila['metodo_pago']==$filametpagcl['id_formapago']){
                                                        echo 'selected="selected"';
                                                }
                                                ?>
                                                value="<?php echo $filametpagcl['id_formapago']; ?>"><?php echo $filametpagcl['descripcion_pago'];?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    <label class="col-sm-2 col-form-label">Vendedor</label>
                                    <div class="col-sm-4">
                                        <select name="slsvendedor" id="slsvendedor" class="form-control">
                                            <option value="">*</option>
                                            <?php
                                                while($filaempleado=$resultempleados->fetch_assoc()){ 
                                            ?>
                                                <option <?php 
                                                if($fila['id_empleado']==$filaempleado['id_empleado']){
                                                        echo 'selected="selected"';
                                                }

                                                ?> value="<?php echo $filaempleado['id_empleado']; ?>"><?php echo $filaempleado['nombre'];?></option>
                                            <?php
                                                }
                                            ?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Descuento</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="txtdescuento" name="txtdescuento" placeholder="10%" class="form-control" value="<?php echo $fila['descuento']; ?>"></div>
                                        <label class="col-sm-2 col-form-label">Estatus</label>
                                    <div class="col-sm-4">
                                        <select name="slsstatus" id="slsstatus"  class="form-control">
                                            <option value="">*</option>
                                           <option value="Activo" <?php if($fila['estatus']=="Activo"){ echo 'selected="selected"';} ?> >Activo</option>
                                            <option value="Inactivo" <?php if($fila['estatus']=="Inactivo"){ echo 'selected="selected"';} ?>>Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-sm-offset-2">
                                        <a href="clientes.php" class="btn btn-white btn-sm">Cancelar</a>
                                        <!--<input type="reset" name="btncancelcliente" name="btncancelcliente" class="btn btn-white btn-sm" value="Cancelar">-->
                                        <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                        <input type="submit" class="ladda-button  btn btn-primary "  data-style="zoom-in" name="btnsubmitcliente" id="btnsubmitcliente" value="Actualizar">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
    localStorage.setItem("pagina","editar-clientes");
</script>
        <?php include "footer.php"; ?>