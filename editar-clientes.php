<?php
ini_set("display_errors", "1");
include "menunav.php";
include "conexion/conexion.php";
$conexio =   conectar_bd();
$query = "SELECT * FROM clientes where id_cliente=" . $_GET['idc'];

$result = $conexio->query($query);
$fila = $result->fetch_assoc();

$query2 = "select * from empleados where puesto='Vendedor' and estatus='Activo' ;";
$resultempleados = $conexio->query($query2);

$query3 = "select * from formas_pago;";
$resultmetpagcl = $conexio->query($query3);

$query4 = "select * from usos_cfdi;";
$resultUsosCfdi = $conexio->query($query4);

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
                            <div class="col-sm-4">
                                <input type="text" id="txtnumcliente" name="txtnumcliente" class="form-control" readonly value="<?php echo $fila['numero_cliente']; ?>">
                            </div>
                            <label class="col-lg-2 col-form-label">Tipo Cliente:</label>
                            <div class="col-lg-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radioTipoCliente" <?php echo ($fila['tipo'] == 'F') ? 'checked' : "" ?> id="inlineRadio1" value="F" />
                                    <label class="form-check-label" for="inlineRadio1">Fisica</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radioTipoCliente" <?php echo ($fila['tipo'] == 'M') ? 'checked' : "" ?> id="inlineRadio2" value="M" />
                                    <label class="form-check-label" for="inlineRadio2">Moral</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Nombre Cliente</label>
                            <div class="col-sm-4">
                                <input type="text" id="txtnomcliente" name="txtnomcliente" placeholder="Nombre Cliente" class="form-control" value="<?php echo $fila['nombre']; ?>">
                                <input type="hidden" name="idc" value="<?php echo $_GET['idc']; ?>">
                            </div>
                            <label class="col-sm-2 col-form-label">RFC</label>
                            <div class="col-sm-4">
                                <input type="text" id="txtRFC" name="txtRFC" placeholder="ej. EFGH831209FNM" class="form-control" value="<?php echo $fila['RFC']; ?>">
                            </div>
                        </div>
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Teléfono</label>
                            <div class="col-sm-4">
                                <input type="text" id="txttel" name="txttel" placeholder="5512345678" class="form-control" value="<?php echo $fila['telefono']; ?>">
                            </div>
                            <label class="col-sm-2 col-form-label">Nombre Contacto</label>
                            <div class="col-sm-4">
                                <input type="text" id="txtnomcontacto" name="txtnomcontacto" placeholder="Nombre contacto" class="form-control" value="<?php echo $fila['nom_contacto']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-4">
                                <input type="text" id="txtemail" name="txtemail" placeholder="ejemplo@ejemplo.com" class="form-control" value="<?php echo $fila['email']; ?>">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Uso CFDI</label>
                            <div class="col-lg-4">
                                <select name="slscfdi" id="slscfdi" class="form-control">
                                    <option value="">*</option>
                                    <?php
                                    while ($filaUsosCfdi = $resultUsosCfdi->fetch_assoc()) {
                                    ?>
                                        <option <?php echo ($fila['id_cfdi'] == $filaUsosCfdi['id_usoscfdi']) ? 'selected="selected"' : "" ?> value="<?php echo $filaUsosCfdi['id_usoscfdi']; ?>"><?php echo $filaUsosCfdi['descripcion_cfdi']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group  row">
                            <label class="col-lg-2 col-form-label">Monto Crédito</label>
                            <div class="col-lg-4">
                                <input type="text" name="txtmontocredito" id="txtmontocredito" class="form-control" value="<?php echo $fila['monto_credito'] ?>">
                            </div>
                            <label class="col-sm-2 col-form-label">Días Crédito</label>
                            <div class="col-lg-4">
                                <input type="text" name="txtdiascredito" id="txtdiascredito" class="form-control" value="<?php echo $fila['dias_credito'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Metodo de Pago</label>
                            <div class="col-sm-4">
                                <select name="slsmetpagoclie" id="slsmetpagoclie" class="form-control">
                                    <option value="">*</option>
                                    <?php
                                    while ($filametpagcl = $resultmetpagcl->fetch_assoc()) {
                                        //rint_r($fila);
                                    ?>
                                        <option <?php echo ($fila['metodo_pago'] == $filametpagcl['id_formapago'])  ? 'selected="selected"' : "" ?> value="<?php echo $filametpagcl['id_formapago']; ?>"><?php echo $filametpagcl['descripcion_pago']; ?></option>
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
                                        <option <?php echo ($fila['id_empleado'] == $filaempleado['id_empleado']) ? 'selected="selected"' : "" ?> value="<?php echo $filaempleado['id_empleado']; ?>"><?php echo $filaempleado['nombre']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Descuento</label>
                            <div class="col-sm-4">
                                <input type="text" id="txtdescuento" name="txtdescuento" placeholder="10%" class="form-control" value="<?php echo $fila['descuento']; ?>">
                            </div>
                            <label class="col-sm-2 col-form-label">Estatus</label>
                            <div class="col-sm-4">
                                <select name="slsstatus" id="slsstatus" class="form-control">
                                    <option value="">*</option>
                                    <option value="Activo" <?php echo ($fila['estatus'] == "Activo") ? 'selected="selected"' : "" ?>>Activo</option>
                                    <option value="Inactivo" <?php echo ($fila['estatus'] == "Inactivo") ? 'selected="selected"' : "" ?>>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="ibox-title">
                            <h5>Dirección Cliente</h5>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Calle / Avenida</label>
                            <div class="col-sm-6">
                                <input type="text" id="txtcalleavenida" name="txtcalleavenida" placeholder="Calle / Avenida" class="form-control" value="<?php echo $fila['calle']; ?>">
                            </div>
                            <label class="col-sm-1 col-form-label">No. Ext</label>
                            <div class="col-sm-1">
                                <input type="text" id="txtnoext" name="txtnoext" placeholder="No. Ext" class="form-control" value="<?php echo $fila['exterior']; ?>">
                            </div>
                            <label class="col-sm-1 col-form-label">No. Int</label>
                            <div class="col-sm-1">
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
                                <select name="slscolonia" id="slscolonia" class="form-control">
                                    <option value="">*</option>
                                    <option value="<?php echo $fila['colonia'] ?>" selected><?php echo $fila['colonia']; ?></option>
                                </select>
                            </div>
                            <label class="col-sm-1 col-form-label">Municipio</label>
                            <div class="col-sm-3">
                                <input type="text" id="txtciudad" name="txtciudad" readonly class="form-control" value="<?php echo $fila['ciudad']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Estado</label>
                            <div class="col-sm-4">
                                <input type="text" id="txtedo" name="txtedo" class="form-control" readonly value="<?php echo $fila['estado']; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <div class="col-sm-6 col-sm-offset-2">
                                <a href="clientes.php" class="btn btn-white btn-sm">Cancelar</a>
                                <!--<input type="reset" name="btncancelcliente" name="btncancelcliente" class="btn btn-white btn-sm" value="Cancelar">-->
                                <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                <input type="submit" class="ladda-button  btn btn-primary " data-style="zoom-in" name="btnsubmitcliente" id="btnsubmitcliente" value="Actualizar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    localStorage.setItem("pagina", "editar-clientes");
</script>
<?php
include "footer.php";
$conexio->close();
?>