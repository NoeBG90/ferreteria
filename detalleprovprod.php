<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detalle Proveedores de Productos</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- DataTable -->
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">

</head>

<body class="">
  <?php
  ini_set("display_errors","0");
  include "conexion/conexion.php";
          $conexio=   conectar_bd();
          $query="SELECT folio_compra,folio_factura,e.nombre as 'empleado', p2.nombre as 'proveedor',c.fecha_compra ,c.fecha_registro , p.numero_producto, p.producto ,p.SKU ,dc.cantidad ,dc.precio_compra from compras c , detalle_compras dc, productos p , proveedores p2, empleados e WHERE dc.id_producto =p.id_producto and dc.id_compra =c.id_compra and c.id_empleado =e.id_empleado and c.id_proveedor =p2.id_proveedor and p.id_producto = ".$_GET['id_producto']." order by c.fecha_registro desc limit 3;";

          $result=$conexio->query($query);

          $queryProducto="SELECT p.numero_producto, p.producto ,p.SKU  from productos p WHERE  p.id_producto = ".$_GET['id_producto']." ;";

          $resultproducto=$conexio->query($queryProducto);
          $filaProd=$resultproducto->fetch_assoc();
          //print_r($filaProd);
  ?>
    <div id="wrapper">
        <div  class="gray-bg">

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-6">
                    <h2>Detalle Proveedores de Productos</h2>
                </div>
                <div class="col-sm-12">

                <div class="form-group  row">
                    <label class="col-sm-2 col-form-label">Núm. Producto</label>
                        <div class="col-sm-4">
                        <input type="text" name="txtnumproducto" id="txtnumproducto" class="form-control" value="<?php echo $filaProd['numero_producto']; ?>" disabled>
                        </div>
                </div>
                <div class="form-group  row">
                    <label class="col-sm-2 col-form-label">Producto</label>
                        <div class="col-sm-4">
                        <input type="text" name="txtproducto" id="txtproducto" class="form-control" placeholder="Producto" value="<?php echo $filaProd['producto']; ?>" disabled>
                        <input type="hidden" name="idprodu" value="<?php echo $_GET['id_producto']; ?>">
                        </div>
                    <label class="col-sm-2 col-form-label">SKU</label>
                        <div class="col-sm-4">
                        <input type="text" name="txtproducto" id="txtproducto" class="form-control" placeholder="Producto" value="<?php echo $filaProd['SKU']; ?>" disabled>
                </div>
                </div>
            </div>

            <div class="wrapper wrapper-content col-lg-12">
                <div class="">
                  <div class="table-responsive">
                  <table id="detalleprovprod" class="table table-stripped table-bordered table-hover dt-responsive nowrap" data-page-size="15">
                      <thead>
                      <tr>
                        <th data-hide="phone">Fecha compra</th>
                        <th data-toggle="true">Proveedor</th> 
                        <th data-hide="phone,tablet">Precio compra</th>
                        <th data-hide="phone,tablet">Registró</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php
                        while($fila=$result->fetch_assoc()){
                           // print_r($fila);
                            ?>
                        <tr>
                            <td><?php echo $fila['fecha_compra'];?></td>
                            <td><?php echo $fila['proveedor'];?></td>
                            <td><?php echo $fila['precio_compra'];?></td>
                            <td><?php echo $fila['empleado'];?></td>
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
   
    <!--DataTable -->
    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <!--Tables -->
    <script type="text/javascript" src="js/tables.js"></script>

</body>

</html>



