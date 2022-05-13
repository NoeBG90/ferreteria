<?php include "menunav.php"; ?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>EMPLEADOS</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Empleados</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Registrar Empleado</strong>
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
                            <h5>Registrar Empleado</h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form name="frmregistrousuario" id="frmregistrousuario">
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Nombre Completo</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="txtnombre" id="txtnombre" class="form-control">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Puesto</label>
                                    <div class="col-sm-4">
                                        <select name="slspuesto" id="slspuesto"  class="form-control">
                                            <option value="">*</option>
                                            <option value="Administrador">Administrador</option>
                                            <option value="Vendedor">Vendedor</option>
                                            <option value="Compras" >Compras</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Teléfono</label>
                                    <div class="col-sm-4">
                                        <input type="tel" name="txttelefono" id="txttelefono" class="form-control">
                                    </div>
                                    <label class="col-sm-2 col-form-label">E-mail</label>
                                    <div class="col-sm-4">
                                        <input type="email" name="txtemail" id="txtemail" placeholder="email@email.com.mx" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Estatus</label>
                                    <div class="col-sm-4">
                                        <select name="slsstatus" id="slsstatus"  class="form-control">
                                            <option value="">*</option>
                                            <option value="Activo">Activo</option>
                                            <option value="Inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Salario $</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="txtsalario" id="txtsalario" placeholder="00.00" class="form-control">
                                    </div>
                                    <label class="col-lg-2 col-form-label">Comisión (%)</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="txtcomision" id="txtcomision" placeholder="0" class="form-control">
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Acceso</label>
                                    <div class="col-lg-4">
                                        <input type="checkbox" id="cbxacceso" name="cbxacceso" value="Si" class="form-control">
                                    </div>
                                    
                                </div>

                                <div class="form-group row" style="display: none;" id="divusuario" >
                                    <label class="col-lg-2 col-form-label">Usuario</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="txtusuario" id="txtusuario" placeholder="Usuario" class="form-control">
                                    </div>
                                    <label class="col-lg-2 col-form-label">Password</label>
                                    <div class="col-lg-4">
                                        <input type="text" placeholder="Password" name="txtpassword" id="txtpassword" class="form-control">
                                    </div>
                                    
                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-sm-offset-2">
                                        <a href="vendedores.php" class="btn btn-white btn-sm">Cancelar</a>
                                        <!--<input type="reset" name="btncancel" name="btncancel" class="btn btn-white btn-sm" value="Cancelar">-->
                                        <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                        <input type="submit" class="ladda-button  btn btn-primary "  data-style="zoom-in" name="btnsubmit" id="btnsubmit" value="Guardar">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
    localStorage.setItem("pagina","registrar-vendedores");
</script>
<?php
    include "footer.php";
?>