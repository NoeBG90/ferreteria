<?php ini_set("display_errors", "0"); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selector de Productos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- DataTable -->
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
</head>


<body class="">

    <?php
    ini_set("display_errors", "0");
    include "conexion/conexion.php";

    $conexio =   conectar_bd();
    $operacion = $_GET['operacion'];
    $estatus = $_GET['estatus'];

    $query = "select o.id_operacion, o.folio_operacion, c.nombre as nombre_cliente, e.nombre as nombre_empleado, o.vigencia_operacion, 
                o.tiempo_entrega, o.total, o.estatus, o.fecha_registro, o.fecha_actualizacion, o.metodo_pago from operaciones o, clientes c , 
                empleados e
        where o.id_cliente = c.id_cliente and o.id_empleado = e.id_empleado and tipo_operacion LIKE '%" . $operacion . "%' 
                and o.estatus= '" . $estatus . "' and o.id_cliente = " . $_GET['cliente'] . " order by 1 desc";
    $result = $conexio->query($query);
    $conexio->close();
    ?>

    <div id="wrapper">
        <div class="gray-bg">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-6">
                    <h2>Selector de <?php echo $operacion ?></h2>
                </div>
                <div class="col-sm-6">
                </div>
            </div>

            <div class="wrapper wrapper-content col-lg-12">
                <div class="">
                    <div class="table-responsive">
                        <table id="productoscotiza" class="table table-stripped table-bordered table-hover dt-responsive nowrap" data-page-size="15">
                            <thead>
                                <tr>
                                    <th data-toggle="true">Folio</th>
                                    <th data-hide="phone">Cliente</th>
                                    <th data-hide="phone,tablet">Empleado</th>
                                    <th data-hide="phone,tablet">Monto</th>
                                    <th data-hide="phone">Estatus</th>
                                    <th data-hide="phone">Pago</th>
                                    <th class="text-right" data-sort-ignore="true">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                while ($fila = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $fila['folio_operacion']; ?></td>
                                        <td><?php echo $fila['nombre_cliente']; ?></td>
                                        <td><?php echo $fila['nombre_empleado']; ?></td>
                                        <td><?php echo $fila['total']; ?></td>
                                        <td><?php echo $fila['estatus']; ?></td>
                                        <td><?php echo $fila['metodo_pago']; ?></td>
                                        <td class="text-center"><a class="fa fa-history fa-lg addOpe" id="<?php echo $fila['id_operacion']; ?>" data-toggle="tooltip" data-placement="top" title="Recuperar Operación"></a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <ul class="pagination float-right"></ul>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->

    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".addOpe").click(function() {
                var id = $(this).attr('id');
                window.parent.CallFunctionRecuperarOperacion(id);
            });
        });
    </script>

    <!--DataTable -->
    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    <!--Tables -->
    <script type="text/javascript" src="js/tables.js"></script>

</body>

</html>