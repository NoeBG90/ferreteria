<?php
ini_set("display_errors", "1");
include "conexion/conexion.php";

$conexio =   conectar_bd();
$movimiento = $_GET['movimiento'];
$query = "select c.*, c2.nombre as cliente from operaciones c, clientes c2 where c.id_cliente =c2.id_cliente and id_operacion=" . $movimiento;

$resultabonos = $conexio->query($query);
$filaabonos = $resultabonos->fetch_assoc();

$query_movimientos = "select * from abonos where id_operacion=" . $movimiento;
$resultmovimiento = $conexio->query($query_movimientos);
$conexio->close();
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimientos Venta</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- DataTable -->
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

</head>

<body class="">

    <div id="wrapper">
        <div class="gray-bg">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-6">
                    <h2>Movimientos</h2>
                </div>
                <div class="col-lg-12">
                    <div class="form-group row align-items-center">
                        <h3 class="col-lg-12 text-center text-uppercase" id="detalleoperacion">Detalle de Movimientos Venta </h3>
                    </div>

                    <form id="frmabonosventa" name="frmabonosventa" class="col-lg-8" style="width: 100%; border-radius: 23rem;">
                        <hr>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-2 text-center">Folio Venta</label>
                            <input class="col-sm-2" type="text" name="folio" value="<?php echo $filaabonos['folio_operacion']; ?>" readonly="true" style="border: none;">

                            <label class="col-sm-2 text-center">Cliente</label>
                            <input class="col-sm-6" type="text" name="folio" value="<?php echo $filaabonos['cliente']; ?>" readonly="true" style="border: none;">
                        </div>
                        <div>
                            <input hidden type="text" id="id_venta" name="id_venta" value="<?php echo $movimiento; ?>">
                        </div>

                        <hr>

                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-center" style="border: none; font-size: 22px">Importe Total Venta: $</label>
                            <input class="col-sm-6" style="border: none; color: blue; font-size: 26px" type="text" name="txtimporte" id="txtimporte" readonly="true" value="<?php echo $filaabonos['total']; ?>">
                        </div>

                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="historial_movimientos" class="table table-striped table-hover table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true">Fecha</th>
                                            <th data-hide="phone">Saldo Inicial</th>
                                            <th data-hide="phone">Cantidad Abono</th>
                                            <th data-hide="phone">Saldo Deudor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($fila = $resultmovimiento->fetch_assoc()) {
                                            //print_r($fila);
                                        ?>
                                            <tr>
                                                <td><?php echo $fila['fecha_transaccion']; ?></td>
                                                <td><?php echo $fila['saldo_inicial']; ?></td>
                                                <td><?php echo $fila['cantidad_abono']; ?></td>
                                                <td><?php echo $fila['saldo_final']; ?></td>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--<div class="form-group row align-items-center">
                            <div class="col-sm-5 col-sm-offset-2 text-center">
                                <a href="ventas.php"><input type="button" id="btncancelarcotizacion" name="btncancelarcotizacion" class="btn btn-white btn-sm" value="Cancelar" onclick="parent.jQuery.fancybox.close()"></a>
                                <a href="cotizaciones.php" class="btn btn-white btn-sm">Cancelar</a>
                            </div>
                            <div class="col-sm-5 col-sm-offset-2 text-center">
                                <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-
                                <input type="submit" class="ladda-button  btn btn-primary "  data-style="zoom-in" name="btnsubmitcotizacion" id="btnsubmitcotizacion" value="Guardar">
                            </div>
                        </div> -->

                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php include "footerfancy.php"; ?>