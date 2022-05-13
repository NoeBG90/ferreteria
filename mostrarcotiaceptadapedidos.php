<?php include "headerfancy.php";

include "conexion/conexion.php";
        $conexio=   conectar_bd();
        $query="SELECT c.id_cotizacion ,folio_cotizacion , 
c.vigencia_cotizacion, c.subtotal , c.iva ,c.iva_porcentual ,
c.total,c.fecha_actualizacion ,c.estatus ,c.fecha_registro,
e.nombre as empleado ,c2.nombre as cliente ,c2.telefono ,c2.nom_contacto ,c2.RFC 
FROM cotizaciones c, empleados e, clientes c2 
where c.id_cliente =c2.id_cliente and c.id_empleado =e.id_empleado and c.estatus='Autorizada'";
        $result=$conexio->query($query);
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>PEDIDOS</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a>Pedidos</a></li>
            <li class="breadcrumb-item active"><strong>Selector Cotización para Pedido</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="clients-list">
                        <ul class="nav nav-tabs">
                            <li><a class="nav-link active" data-toggle="tab" href="#tab-1"><i class="fa fa-tags"></i> COTIZACIONES AUTORIZADAS</a></li>
                        </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="full-height-scroll">
                                <div class="table-responsive">
                                    <table id="cotizaciones" class="table table-striped table-hover table-bordered dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th data-hide="phone">Folio</th>
                                                <th data-hide="phone,tablet" >Fecha cotización</th>
                                                <th data-hide="phone">Contacto</th>
                                                <th data-hide="phone">Cliente</th>
                                                <th data-hide="phone">Cotizó</th>
                                                <th data-hide="phone">Estatus</th>
                                                <th data-hide="phone">Subtotal</th>
                                                <th data-hide="phone">IVA</th>
                                                <th data-hide="phone">Total</th>
                                                <th data-hide="phone">Fecha Actualización</th>
                                                <th class="text-right" data-sort-ignore="true">Accion</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php
                                            while($fila=$result->fetch_assoc()){
                                        ?>
                                            <tr>
                                                <td>
                                                    <a class="detalleiframe"  href="impresion_cotizacion.php?id_cotizacion=<?php echo $fila['id_cotizacion'];?>">
                                                     <?php echo $fila['folio_cotizacion'];?>
                                                     </a>
                                                </td>
                                                <td><?php echo $fila['fecha_registro'];?></td>
                                                <td><?php echo $fila['nom_contacto'];?></td>
                                                <td><?php echo $fila['cliente'];?></td>
                                                <td><?php echo $fila['empleado'];?></td>
                                                <td>
                                                    <span class="label
                                                        <?php
                                                            if($fila['estatus']=='Aceptada'){
                                                               echo "label-primary";
                                                            }else if ($fila['estatus']=='Pendiente'){
                                                               echo "label-danger";
                                                            }else if($fila['estatus']=='Rechazada'){
                                                               echo "label-warning";
                                                                }
                                                        ?>
                                                    "><?php echo $fila['estatus'];?></span>
                                                </td>
                                                <td><?php echo $fila['subtotal'];?></td>
                                                <td><?php echo $fila['iva'];?></td>
                                                <td><?php echo $fila['total'];?></td>
                                                <td><?php echo $fila['fecha_actualizacion'];?></td>
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <a href="registrar_pedidoporcoti.php?id_cotizacion=<?php echo $fila['id_cotizacion'];?>" class="btn-white btn btn-xs">Seleccionar</a>
                                                    </div>
                                                </td>
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
            </div>
        </div>
    </div>
            <?php
include "footerfancy.php";
        ?>
