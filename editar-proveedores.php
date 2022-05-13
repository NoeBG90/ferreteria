<?php include "menunav.php"; 
include "conexion/conexion.php";
        $conexio=   conectar_bd();
        $query="SELECT * FROM proveedores where id_proveedor=".$_GET['idp'];
        $result=$conexio->query($query);
        $fila=$result->fetch_assoc();
        //while($fila=$result->fetch_assoc()){ 
        //}

?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>PROVEEDORES</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Proveedores</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Editar Proveedor</strong>
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
                            <h5>Editar Proveedor</h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form name="frmeditarproveedores" id="frmeditarproveedores">
                                <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Número Proveedor</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="txtnumproveedor" name="txtnumeroproveedor" class="form-control" readonly value="<?php echo $fila['numero_proveedor']; ?>">
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Nombre Completo</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="txtnomproveedor" id="txtnomproveedor" placeholder="Nombre Completo" class="form-control" value="<?php echo $fila['nombre']; ?>">
                                        <input type="hidden" name="idp" value="<?php echo $_GET['idp']; ?>">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Teléfono</label>
                                    <div class="col-sm-4">
                                        <input type="tel" name="txttel" id="txttel" placeholder="5512345678" class="form-control" value="<?php echo $fila['telefono']; ?>">
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Nombre Contacto</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="txtnomcontacto" id="txtnomcontacto" placeholder="Nombre Contacto" class="form-control" value="<?php echo $fila['nom_contacto']; ?>">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Cuenta Bancaria</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="txtcuentabancaria" id="txtcuentabancaria" placeholder="AE XX XXXX XXXX XX XXXXXXXXXX" value="<?php echo $fila['cuenta_bancaria']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Estatus</label>
                                    <div class="col-sm-4">
                                        <select name="slsstatus" id="slsstatus"  class="form-control">
                                            <option value="">*</option>
                                            <option value="Activo" <?php if($fila['estatus']=="Activo"){ echo 'selected="selected"';} ?> >Activo</option>
                                            <option value="Inactivo" <?php if($fila['estatus']=="Inactivo"){ echo 'selected="selected"';} ?>>Inactivo</option>
                                        </select>
                                    </div>
                                    <label class="col-lg-2 col-form-label">E-mail</label>
                                    <div class="col-lg-4">
                                        <input type="email" name="txtemail" id="txtemail" placeholder="ejemplo@ejemplo.com" class="form-control" value="<?php echo $fila['email']; ?>">
                                    </div>  
                                </div>
                                <div class="ibox-title">
                                    <h5>Dirección Proveedor</h5>                  
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
                                    <label class="col-sm-1 col-form-label">Municipio</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="txtciudad" name="txtciudad" readonly class="form-control" value="<?php echo $fila['ciudad']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Estado</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="txtedo" name="txtedo" readonly class="form-control" value="<?php echo $fila['estado']; ?>">
                                    </div>
                                    <!--<label class="col-sm-2 col-form-label">País</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="txtpais" name="txtpais" readonly class="form-control" value="<?php echo $fila['pais']; ?>">
                                    </div>-->
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Productos vendidos</label>
                                    <div class="col-sm-10 ibox-content">
                                        <textarea  name="textaprodvendprov" id="textaprodvendprov" data-provide="markdown" rows="10" placeholder="Ingrese los productos que vende el proveedor"><?php echo $fila['prod_vendidos']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-sm-offset-2">
                                        <a href="proveedores.php" class="btn btn-white btn-sm">Cancelar</a>
                                        <!--<input type="reset" name="btncancelproveedor" name="btncancelproveedor" class="btn btn-white btn-sm" value="Cancelar">-->
                                        <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                        <input type="submit" class="ladda-button  btn btn-primary "  data-style="zoom-in" name="btnsubmitproveedor" id="btnsubmitproveedor" value="Actualizar">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
    localStorage.setItem("pagina","editar-proveedores");
</script>
        <?php include "footer.php"; ?>