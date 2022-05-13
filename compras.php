<?php include "menunav.php";
include "conexion/conexion.php";
        $conexio=   conectar_bd();
        $query="SELECT id_compra,
p.nombre as id_proveedor,
fecha_compra,
folio_compra,
folio_factura,
e.nombre as id_empleado,
total,
c.estatus,
c.fecha_registro,
c.fecha_actualizacion,
subtotal,
iva_monto,
iva_porcentual FROM compras c, empleados e ,proveedores p 
where c.id_empleado =e.id_empleado 
and c.id_proveedor =p.id_proveedor order by c.id_compra desc";
        $result=$conexio->query($query);

?>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>COMPRAS</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Compras</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Gestion de Compras</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="clients-list">
                                <ul class="nav nav-tabs">
                                    <li><a class="nav-link active" data-toggle="tab" href="#tab-1"><i class="fa fa-cubes"></i> COMPRAS</a></li>
                                    <li><a class="nav-link" data-toggle="tab">
                                        </a>
                                    </li>
                                </ul>
                                <div class="table-responsive">
                                        <table id="compras" class="table table-stripped table-bordered table-hover dt-responsive nowrap" data-page-size="15">
                                            <thead>
                                            <tr>
                                                <th data-hide="phone">Folio Compra</th>
                                                <th data-hide="phone">Folio Factura</th>
                                                <th data-hide="phone,tablet" >Fecha</th>
                                                <th data-hide="phone">Empleado</th>
                                                <th data-hide="phone">Proveedor</th>
                                                <th data-hide="phone">Total</th>
                                                <th data-hide="phone">Estatus</th>
                                                <th data-hide="phone">Fecha Registro</th>
                                                
                                                
                                            </tr>
                                            </thead>
                                        <tbody>
                                                    <?php
                                                        while($fila=$result->fetch_assoc()){
                                                    ?>
                                                <tr>
                                                    <td>

                                                    <a class="detalleiframe"  href="verdetalle.php?idcompra=<?php echo $fila['id_compra'];?>"
                                                      >
                                                     <?php echo $fila['folio_compra'];?>

                                                     </a></td>
                                                    <td><?php echo $fila['folio_factura'];?></td>
                                                    <td><?php echo $fila['fecha_compra'];?></td>
                                                    <td><?php echo $fila['id_empleado'];?></td>
                                                    <td><?php echo $fila['id_proveedor'];?></td>
                                                    <td><?php echo $fila['total'];?></td>
                                                    <td>
                                                        <span class="label
                                                            <?php
                                                                 if($fila['estatus']=='Pagado'){
                                                                echo "label-primary";
                                                                }else if ($fila['estatus']=='Pago Pendiente'){
                                                                echo "label-danger";
                                                                }else{
                                                                echo "label-warning";
                                                                }
                                                            ?>
                                                        "><?php echo $fila['estatus'];?></span>
                                                    </td>
                                                    <td><?php echo $fila['fecha_registro'];?></td>
                                                   <!--<td><?php echo $fila['fecha_actualizacion'];?></td>
                                                    <td class="text-right">
                                                        <div class="btn-group">
                                                            <a href="detalle-compra.php?idp=<?php echo $fila['id_compra'];?>" class="btn-white btn btn-xs">Editar</a>
                                                        </div>
                                                    </td>-->
                                                </tr>
                                                <?php
                                    }
                                ?>
                                                </tbody>
                                            </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
              </div>
<script type="text/javascript">
    localStorage.setItem("pagina","compras");
</script>
<?php
    include "footer.php";
?>
