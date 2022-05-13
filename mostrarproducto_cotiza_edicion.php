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
  ini_set("display_errors","1");
  include "conexion/conexion.php";
          $conexio=   conectar_bd();
          $query="SELECT p.*,fp.familia FROM productos p, familia_producto fp WHERE p.id_familia=fp.id_familia and imagen_producto !='' and (producto like '%".$_GET['producto']."%' or SKU like '%".$_GET['producto']."%')";

          $result=$conexio->query($query);
  ?>
    <div id="wrapper">
        <div  class="gray-bg">

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-6">
                    <h2>Selector de Productos</h2>

                </div>
                <div class="col-sm-6">

                </div>
            </div>

            <div class="wrapper wrapper-content col-lg-12">
                <div class="">
                  <div class="table-responsive">
                  <table id="productoscompra" class="table table-stripped table-bordered table-hover dt-responsive nowrap" data-page-size="15">
                      <thead>
                      <tr>
                          <th data-toggle="true">Producto</th>
                          <th data-hide="phone">SKU</th>
                          <th data-hide="phone,tablet" >Stock</th>
                          <th data-hide="phone,tablet" >Marca</th>
                          <th data-hide="phone">Modelo</th>
                          <th data-hide="phone">$ Venta</th>
                          <th class="text-right" data-sort-ignore="true">Action</th>

                      </tr>
                      </thead>
                      <tbody>
                        <?php
                        while($fila=$result->fetch_assoc()){
                           // print_r($fila);
                            ?>
                        <tr>
                        <td><?php echo $fila['producto'];?></td>
                        <td><?php echo $fila['SKU'];?></td>
                        <td><?php echo $fila['stok'];?></td>
                        <td><?php echo $fila['marca'];?></td>
                        <td><?php echo $fila['modelo'];?></td>
                        <td><?php echo $fila['precio_venta'];?></td>
                        <td>

                          <a class="fa fa-shopping-cart addcar" id="<?php echo $fila['id_producto'];?>"></a>
                        </td>
                        <!--<td><div class="btn-group">
                            <a href="agregar-productoscom.php?idprodu=<?php echo $fila['id_producto'];?>" class="btn-white btn btn-xs">Agregar</a>
                        </div></td>-->
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
    $(document).ready(function(){
        $(".addcar").click(function(){
          console.log(this.id);

          $.post("servlets/calculadora_edita_cotizacion.php",
              {producto:this.id},function( data ){
                  console.log(data);
                  window.parent.$('#tbcotiza_edicion tbody').html(data);
                  
              });

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
