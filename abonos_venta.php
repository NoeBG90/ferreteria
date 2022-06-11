<?php
ini_set("display_errors", "1");
include "conexion/conexion.php";
$conexio =   conectar_bd();

$venta = $_GET['venta'];

$query = "select c.*, c2.nombre as cliente from operaciones c, clientes c2 where c.id_cliente =c2.id_cliente and id_operacion=" . $venta;
$resultabono = $conexio->query($query);
$fila = $resultabono->fetch_assoc();

$queryabonos = "select sum(cantidad_abono) as abono from abonos a where id_operacion =" . $venta;
$resultabonos = $conexio->query($queryabonos);
$monto_abono = $resultabonos->fetch_assoc();

$montodeudor = round($fila['total'] - $monto_abono['abono'], 2);

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Abonar pago a Venta</title>

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
                    <h2>Abono a Crédito</h2>
                </div>
                <div class="col-lg-12">
                    <div class="form-group row align-items-center">
                        <h3 class="col-lg-12 text-center text-uppercase" id="detalleoperacion">Detalle Abonos a Venta </h3>
                    </div>

                    <form id="frmabonosventa" name="frmabonosventa" class="col-lg-8" style="width: 100%; border-radius: 23rem;">
                        <hr>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-2 text-center">Folio Venta</label>
                            <input class="col-sm-2" type="text" name="folio" value="<?php echo $fila['folio_operacion']; ?>" readonly="true" style="border: none;">

                            <label class="col-sm-2 text-center">Cliente</label>
                            <input class="col-sm-6" type="text" name="folio" value="<?php echo $fila['cliente']; ?>" readonly="true" style="border: none;">
                        </div>
                        <div>
                            <input hidden type="text" id="id_venta" name="id_venta" value="<?php echo $venta; ?>">
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-sm-6 text-center" style="border: none; font-size: 26px">
                                Importe Total Venta: $</label>
                            <input class="col-sm-6" style="border: none; color: blue; font-size: 32px" type="text" name="txtimporte" id="txtimporte" readonly="true" value="<?php echo $fila['total']; ?>">
                        </div>
                        <hr>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-5 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-bank" width="20" height="20" viewBox="0 0 24 24" stroke-width="3" stroke="#009988" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="3" y1="21" x2="21" y2="21" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                    <polyline points="5 6 12 3 19 6" />
                                    <line x1="4" y1="10" x2="4" y2="21" />
                                    <line x1="20" y1="10" x2="20" y2="21" />
                                    <line x1="8" y1="14" x2="8" y2="17" />
                                    <line x1="12" y1="14" x2="12" y2="17" />
                                    <line x1="16" y1="14" x2="16" y2="17" />
                                </svg>
                                Método de Pago</label>
                            <div class="col-sm-5 form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rbtnpago" value="Efectivo" id="rbtncontado">
                                    <label class="form-check-label text-secondary" for="rbtncontado"><i class="fa fa-money"></i> Efectivo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rbtnpago" value="Transferencia" id="rbtntransferencia">
                                    <label class="form-check-label text-secondary" for="rbtntransferencia"><i class="fa fa-cc"></i> Transferencia</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-sm-5 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-businessplan" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffec00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <ellipse cx="16" cy="6" rx="5" ry="3" />
                                    <path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                    <path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                    <path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" />
                                    <path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                    <path d="M5 15v1m0 -8v1" />
                                </svg>
                                Saldo Inicial $</label>
                            <input class="col-sm-5" type="text" name="textabonoiventa" id="textabonoiventa" readonly="true" value="<?php echo $montodeudor; ?>" style="border: none; color: green; font-size: 24px; font-weight: bold;">
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-sm-5 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash" width="20" height="20" viewBox="0 0 24 24" stroke-width="3" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <rect x="7" y="9" width="14" height="10" rx="2" />
                                    <circle cx="14" cy="14" r="2" />
                                    <path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" />
                                </svg>
                                Abono $</label>
                            <input class="col-sm-5" type="text" name="textabonoventa" id="textabonoventa" placeholder="00.00" style="border: groove; font-size: 24px; font-weight: bold;">
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-sm-5 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-down" width="20" height="20" viewBox="0 0 24 24" stroke-width="3" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 4v8h3.586a1 1 0 0 1 .707 1.707l-6.586 6.586a1 1 0 0 1 -1.414 0l-6.586 -6.586a1 1 0 0 1 .707 -1.707h3.586v-8a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1z" />
                                </svg>
                                Saldo deudor $</label>
                            <input class="col-sm-5" type="text" name="txtsaldodeuventa" id="txtsaldodeuventa" readonly="true" value="<?php echo $montodeudor; ?>" style="border: none; color: red; font-size: 24px; font-weight: bold;">
                        </div>
                        <div class="form-group row align-items-center">
                            <div class="col-sm-5 col-sm-offset-2 text-center">
                                <a href="ventas.php"><input type="button" id="btncancelarcotizacion" name="btncancelarcotizacion" class="btn btn-white btn-sm" value="Cancelar" onclick="parent.jQuery.fancybox.close()"></a>
                                <!--<a href="cotizaciones.php" class="btn btn-white btn-sm">Cancelar</a>-->
                            </div>
                            <div class="col-sm-5 col-sm-offset-2 text-center">
                                <!-- <button class="ladda-button ladda-button-demo btn btn-primary "  data-style="zoom-in" type="submit">Guardar</button>-->
                                <input type="submit" class="ladda-button  btn btn-primary " data-style="zoom-in" name="btnsubmitcotizacion" id="btnsubmitcotizacion" value="Guardar">
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php include "footerfancy.php"; ?>