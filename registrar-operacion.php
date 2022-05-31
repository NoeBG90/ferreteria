<?php include "menunav.php";

include "conexion/conexion.php";
$conexio =   conectar_bd();

$query2 = "select * from clientes where estatus='Activo' ;";
$resultclientes = $conexio->query($query2);

$query3 = "SELECT c.id_operacion ,folio_operacion ,c2.nombre as cliente  FROM operaciones c, clientes c2 
        where c.id_cliente =c2.id_cliente and c.estatus='Autorizada' and tipo_operacion='Cotizacion'";
$resultcotizacion = $conexio->query($query3);

$query4 = "SELECT c.id_operacion ,folio_operacion ,c2.nombre as cliente FROM operaciones c, clientes c2 
        where c.id_cliente =c2.id_cliente and  tipo_operacion='Pedido'";
$resultpedidos = $conexio->query($query4);

?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>OPERACIONES</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a>Operaciones</a>
            </li>
            <li id="seccionOperaciones" class="breadcrumb-item active">
                <strong>Registrar Operación</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5 id="titulooperacion">Registrar Operación</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="container-fluid">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-7">
                                        <div class="form-group">
                                            <label for="barcode-input" class="bmd-label-floating"></label>
                                            <input type="text" class="form-control input-barcode" id="idproductocot" name="idproductocot" maxlength="70" placeholder="SKU">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <button type="button" class="btn btn-primary" id="btnvalidaproductocot" name="btnvalidaproductocot" disabled="disabled"><i class="fa fa-check-circle"></i> &nbsp; Buscar producto</button>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="tbcotiza" name="tbcotiza">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">#</th>
                                            <th scope="col">SKU</th>
                                            <th scope="col">PRODUCTO</th>
                                            <th scope="col">CANT</th>
                                            <th scope="col">P. UNIT</th>
                                            <th scope="col">% DTO</th>
                                            <th scope="col">PRECIO TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        if (isset($_SESSION['tabla_cotizacion'])) {

                                            echo $_SESSION['tabla_cotizacion'];
                                        } else {

                                        ?>
                                            <tr class="text-center">
                                                <th colspan="8">No hay productos agregados</th>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="form-group row align-items-center">
                                <h3 class="col-sm-12 text-center text-uppercase" id="detalleoperacion">Detalle Operación </h3>
                            </div>
                            <hr>

                            <form id="frmregistrocotizaciones" name="frmregistrocotizaciones">
                                <div class="form-group row align-items-center">
                                    <div>
                                        <label class="col-sm-12 text-left">Tipo Operación</label>
                                    </div>
                                    <div class="col-sm-12 form-group" id="rbtOperacion">

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" value="Cotizacion" id="rbtncotizacion" name="radioInline">
                                            <label class="form-check-label text-secondary col-sm-4" for="rbtncotizacion"> Cotización </label>
                                            <input class="form-check-input" type="radio" value="Pedido" id="rbtnpedido" name="radioInline">
                                            <label class="form-check-label text-secondary col-sm-4" for="rbtnpedido"> Pedido </label>
                                            <input class="form-check-input" type="radio" value="Venta" id="rbtnventa" name="radioInline">
                                            <label class="form-check-label text-secondary col-sm-4" for="rbtnventa"> Venta </label>
                                            <input type="hidden" name="recuperado" id="recuperado" value="0">
                                            <input type="hidden" name="idrecuperado" id="idrecuperado" value="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row align-items-left col-sm-12" id="dvRecCot" style="display: none">
                                    <label class="col-sm-12 text-left" style="display: ruby-text-container;">Recuperar Cotización</label>
                                    <select class="col-sm-8 select2_demo_3 form-control " name="slscotizaciones" id="slscotizaciones" style="width: 100%; margin: 1rem; text-align: left;">
                                        <option value="">Cotizaciones</option>
                                        <?php
                                        while ($filacotizacion = $resultcotizacion->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $filacotizacion['id_operacion']; ?>"><?php echo $filacotizacion['folio_operacion'] . " - " . $filacotizacion['cliente']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <button type="button" class="btn btn-outline btn-info align-items-left " id="btnrecupcot" name="btnrecupcot" style="width: 50%; margin-top: 1rem;">Recuperar</button>
                                </div>

                                <div class="form-group row align-items-left col-sm-12" id="dvRecPed" style="display: none">
                                    <label class="col-sm-12 text-left" style="display: ruby-text-container;">Recuperar Pedido</label>
                                    <select class="col-sm-8 select2_demo_3 form-control " name="slspedidos" id="slspedidos" style="width: 100%; margin: 1rem; text-align: left;">
                                        <option value="">Pedidos</option>
                                        <?php
                                        while ($filapedidos = $resultpedidos->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $filapedidos['id_operacion']; ?>"><?php echo $filapedidos['folio_operacion'] . " - " . $filapedidos['cliente']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <button type="button" class="btn btn-outline btn-info" id="btnrecupped" name="btnrecupped" style="width: 50%; margin-top: 1rem;">Recuperar</button>
                                </div>

                                <hr>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 text-left">Atención</label>
                                    <input type="hidden" name="ide" value="<?php echo $_SESSION['idempleado']; ?>">
                                    <input class="col-sm-9 text-left" type="text" name="txtcapturocot" id="txtcapturocot" value="<?php echo $_SESSION['Nombre'] . "-" . $_SESSION['Puesto']; ?>" disabled>
                                </div>

                                <hr>
                                <div class="form-group row align-items-center">
                                    <label for="cotizacion_cliente" class="col-sm-4 text-left">Cliente</label>
                                    <select name="slsclientecot" id="slsclientecot" class="col-sm-8 text-left">
                                        <option value="">*</option>
                                        <?php
                                        while ($filaclientes = $resultclientes->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $filaclientes['id_cliente']; ?>"><?php echo $filaclientes['nombre']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label class="col-sm-6 text-center">Nom Contacto</label>
                                    <label class="col-sm-6 text-center">Teléfono</label>
                                </div>

                                <div class="form-group row align-items-center">
                                    <input class="col-sm-5" type="text" name="txtnomcontclie" id="txtnomcontclie" disabled placeholder="Margarita Muñoz">
                                    <div class="col-sm-2"></div>
                                    <input class="col-sm-5" type="text" name="txttelcontclie" id="txttelcontclie" disabled placeholder="55 10123483">
                                </div>

                                <hr>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-5 text-left">Vigencia</label>
                                    <input class="col-sm-7 text-center" type="text" name="txtvigenciacot" id="txtvigenciacot" placeholder="30 días despues de la fecha de hoy(cotizacion)">
                                </div>

                                <div class="form-group row align-items-center">
                                    <label class="col-sm-5 text-left">Tiempo de entrega</label>
                                    <input class="col-sm-7 text-center" type="text" name="txtentregacot" id="txtentregacot" placeholder="3 - 5 días habiles">
                                </div>

                                <div class="form-group row align-items-center">
                                    <label class="col-sm-5 text-left">Consideraciones</label>
                                    <input class="col-sm-7 text-center" type="text" name="txtconsideracionescot" id="txtconsideracionescot">
                                </div>

                                <div class="form-group row align-items-center">
                                    <label class="col-sm-5 text-left">Método de Pago</label>
                                    <div class="col-sm-7 form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rbtnpago" value="Efectivo" id="rbtncontado">
                                            <label class="form-check-label text-secondary" for="rbtncontado"><i class="fa fa-money"></i> Efectivo</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rbtnpago" value="Crédito" id="rbtncredito">
                                            <label class="form-check-label text-secondary" for="rbtncredito"><i class="fa fa-dollar (alias)"></i> Crédito</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="rbtnpago" value="Transferencia" id="rbtntransferencia">
                                            <label class="form-check-label text-secondary" for="rbtntransferencia"><i class="fa fa-cc"></i> Transferencia</label>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-6 text-left">Subtotal $</label>
                                    <input class="col-sm-6 text-center" type="text" name="subtotal_cotiza" id="subtotal_cotiza" readonly="true" placeholder="00.00">
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-6 text-left">Descuento $</label>
                                    <input class="col-sm-6 text-center" type="text" name="txtdescuentocot" id="txtdescuentocot" readonly="true" placeholder="00.00">
                                </div>

                                <div class="form-group row align-items-center">
                                    <select class="form-control col-sm-4" id="iva_cotiza" name="iva_cotiza">
                                        <option value="">*</option>
                                        <option value="16.00" selected>IVA 16%</option>
                                        <option value="8.00">IVA 8%</option>
                                    </select>
                                    <div class="col-sm-2 text-center"></div>
                                    <input class="col-sm-6 text-center" type="text" name="iva_cotizacion" id="iva_cotizacion" readonly="true" placeholder="16.00">
                                </div>

                                <hr>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-6 text-left">Total $</label>
                                    <input class="col-sm-6 text-center" type="text" name="total_cotiza" id="total_cotiza" readonly="true" placeholder="166.00">
                                </div>

                                <div class="form-group row align-items-center">
                                    <div class="col-sm-6 col-sm-offset-2 text-center">
                                        <input type="button" id="btncancelarcotizacion" name="btncancelarcotizacion" class="btn btn-white btn-sm" value="Cancelar">
                                        <!--<a href="cotizaciones.php" class="btn btn-white btn-sm">Cancelar</a>-->
                                    </div>
                                    <div class="col-sm-6 col-sm-offset-2 text-center">
                                        <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                        <input type="submit" class="ladda-button  btn btn-primary " data-style="zoom-in" name="btnsubmitcotizacion" id="btnsubmitcotizacion" value="Guardar">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    localStorage.setItem("pagina", "registro_operacion");

    document.addEventListener('keypress', function(evt) {
        // Si el evento NO es una tecla Enter
        if (evt.key !== 'Enter') {
            return;
        }

        console.log(evt.key);
        let element = evt.target;
        // Si el evento NO fue lanzado por un elemento con class "focusNext"
        if (!element.classList.contains('focusNext') && !element.classList.contains('focusDesc')) {
            return;
        }

        if (element.classList.contains('focusNext')) {
            // AQUI logica para encontrar el siguiente
            let tabIndex = element.tabIndex + 1;
            var next = document.querySelector('[tabindex="' + tabIndex + '"]');

            // Si encontramos un elemento
            if (next) {
                next.focus();
                event.preventDefault();
            }
        } else if (element.classList.contains('focusDesc')) {
            // AQUI logica para encontrar el siguiente
            let tabIndex = element.tabIndex + 1;
            var next = document.querySelector('[tabindex="' + tabIndex + '"]');

            // Si encontramos un elemento
            if (next) {
                next.focus();
                event.preventDefault();
            }
        }
    });
</script>



<?php include "footer.php"; ?>