<?php include "menunav.php";
include "conexion/conexion.php";
$conexio =   conectar_bd();

$query2 = "select * from empleados where puesto='Vendedor' and estatus='Activo' ;";
$resultempleados = $conexio->query($query2);

$querymetod = "select * from formas_pago;";
$resultmetpagcliente = $conexio->query($querymetod);

?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>CLIENTES</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a>Clientes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Registrar Cliente</strong>
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
                    <h3>Registrar Cliente</h3>
                </div>
                <div class="ibox-content">
                    <form id="formregistroclientes" name="formregistroclientes">
                        <div class="form-group  row">
                            <label class="col-lg-2 col-form-label">Tipo Cliente:</label>
                            <div class="col-lg-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radioTipoCliente" id="inlineRadio1" value="F" />
                                    <label class="form-check-label" for="inlineRadio1">Fisica</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radioTipoCliente" id="inlineRadio2" value="M" />
                                    <label class="form-check-label" for="inlineRadio2">Moral</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Nombre Cliente</label>
                            <div class="col-sm-4">
                                <input type="text" id="txtnomcliente" name="txtnomcliente" placeholder="Nombre Cliente" class="form-control">
                            </div>
                            <label class="col-sm-2 col-form-label">RFC</label>
                            <div class="col-sm-4">
                                <input type="text" id="txtRFC" name="txtRFC" placeholder="ej. EFGH831209FNM" class="form-control">
                            </div>
                        </div>
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Teléfono</label>
                            <div class="col-sm-4">
                                <input type="text" id="txttel" name="txttel" placeholder="5512345678" class="form-control">
                            </div>
                            <label class="col-sm-2 col-form-label">Nombre Contacto</label>
                            <div class="col-sm-4">
                                <input type="text" id="txtnomcontacto" name="txtnomcontacto" placeholder="Nombre contacto" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-4">
                                <input type="text" id="txtemail" name="txtemail" placeholder="ejemplo@ejemplo.com" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Uso CFDI</label>
                            <div class="col-lg-4">
                                <select name="slscfdi" id="slscfdi" class="form-control">
                                    <option value="">*</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group  row">
                            <label class="col-lg-2 col-form-label">Monto Crédito</label>
                            <div class="col-lg-4">
                                <input type="text" name="txtmontocredito" id="txtmontocredito" placeholder="10500" class="form-control">
                            </div>
                            <label class="col-sm-2 col-form-label">Días Crédito</label>
                            <div class="col-lg-4">
                                <input type="text" name="txtdiascredito" id="txtdiascredito" placeholder="12" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Metodo de Pago</label>
                            <div class="col-sm-4">
                                <select name="slsmetpagoclie" id="slsmetpagoclie" class="form-control">
                                    <option value="">*</option>
                                    <?php
                                    while ($filametpagclien = $resultmetpagcliente->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $filametpagclien['id_formapago']; ?>"><?php echo $filametpagclien['descripcion_pago']; ?></option>
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
                                    while ($filaempleado = $resultempleados->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $filaempleado['id_empleado']; ?>"><?php echo $filaempleado['nombre']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Descuento</label>
                            <div class="col-sm-4">
                                <input type="text" id="txtdescuento" name="txtdescuento" placeholder="10%" class="form-control">
                            </div>
                            <label class="col-sm-2 col-form-label">Estatus</label>
                            <div class="col-sm-4">
                                <select name="slsstatus" id="slsstatus" class="form-control">
                                    <option value="">*</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="ibox-title">
                            <h5>Dirección Cliente</h5>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Calle / Avenida</label>
                            <div class="col-sm-6">
                                <input type="text" id="txtcalleavenida" name="txtcalleavenida" placeholder="Calle / Avenida" class="form-control">
                            </div>
                            <label class="col-sm-1 col-form-label">No. Ext</label>
                            <div class="col-sm-1">
                                <input type="text" id="txtnoext" name="txtnoext" placeholder="No. Ext" class="form-control">
                            </div>
                            <label class="col-sm-1 col-form-label">No. Int</label>
                            <div class="col-sm-1">
                                <input type="text" id="txtnoint" name="txtnoint" placeholder="No. Int" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Codigo Postal</label>
                            <div class="col-sm-2">
                                <input type="text" id="txtcp" name="txtcp" placeholder="C.P" class="form-control">
                            </div>
                            <label class="col-sm-1 col-form-label">Colonia</label>
                            <div class="col-sm-3">
                                <select name="slscolonia" id="slscolonia" class="form-control">
                                    <option value="">*</option>
                                </select>
                            </div>
                            <label class="col-sm-1 col-form-label">Municipio</label>
                            <div class="col-sm-3">
                                <input type="text" id="txtciudad" name="txtciudad" readonly class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Estado</label>
                            <div class="col-sm-6">
                                <input type="text" id="txtedo" name="txtedo" readonly class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <div class="col-sm-6 col-sm-offset-2">
                                <!--<input type="reset" name="btncancelcliente" name="btncancelcliente" class="btn btn-white btn-sm" value="Cancelar">-->
                                <a href="clientes.php" class="btn btn-white btn-sm">Cancelar</a>
                                <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                <input type="submit" class="ladda-button  btn btn-primary " data-style="zoom-in" name="btnsubmitcliente" id="btnsubmitcliente" value="Guardar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    localStorage.setItem("pagina", "registrar-cliente");
</script>
<?php
include "footer.php";
$conexio->close();
?>