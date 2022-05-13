<?php include "menunav.php";

include "conexion/conexion.php";
        $conexio=   conectar_bd();
        $query="SELECT c.id_operacion ,folio_operacion , 
c.vigencia_operacion, c.subtotal , c.iva ,c.iva_porcentual ,
c.total,date(c.fecha_actualizacion) as fecha_actualizacion ,c.estatus ,date(c.fecha_registro) as fecha_registro,
e.nombre as empleado ,c2.nombre as cliente ,c2.telefono ,c2.nom_contacto ,c2.RFC 
FROM operaciones c, empleados e, clientes c2 
where c.id_cliente =c2.id_cliente and c.id_empleado =e.id_empleado and tipo_operacion='Cotizacion' order by c.id_operacion desc";
        $result=$conexio->query($query);

?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>OPERACIONES</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a>Operaciones</a></li>
            <li class="breadcrumb-item active"><strong>Gestión de Cotizaciones</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="clients-list">
                        <ul class="nav nav-tabs">
                            <li><a class="nav-link active" data-toggle="tab" href="#tab-1"><i class="fa fa-tags"></i> COTIZACIONES</a></li>
                        </ul>
                    <!--<div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="full-height-scroll">-->
                                <div class="table-responsive">
                                    <table id="cotizaciones" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <th data-toggle="true">Folio</th>
                                                <th data-hide="phone,tablet" >F. Cotización</th>
                                                <th data-hide="phone">Contacto</th>
                                                <th data-hide="phone">Cliente</th>
                                                <th data-hide="phone">Cotizó</th>
                                                <th data-hide="phone">Estatus</th>
                                                <th data-hide="phone">Subtotal</th>
                                                <th data-hide="phone">IVA</th>
                                                <th data-hide="phone">Total</th>
                                                <th data-hide="phone">F. Actualización</th>
                                                <th data-hide="phone">Acción</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php
                                            while($fila=$result->fetch_assoc()){
                                        ?>
                                            <tr>
                                                <td>
                                                    <a class="detalleiframe"  href="impresion_cotizacion.php?id_cotizacion=<?php echo $fila['id_operacion'];?>">
                                                     <?php echo $fila['folio_operacion'];?>
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
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <?php if($fila['estatus']=='Pendiente'  ){ ?>

                                                        <a href="editar_cotizacion.php?id_cotizacion=<?php echo $fila['id_operacion'];?>" >
                                                            <button class="btn btn-info  dim" type="button" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-paste"></i></button>
                                                        </a>

                                                        <a href="servlets/actualizar_operacion.php?id_operacion=<?php echo $fila['id_operacion'];?>&status=<?php echo base64_encode("Aceptada")?>" >
                                                        <button class="btn btn-primary dim" type="button" data-toggle="tooltip" data-placement="top" title="Aceptada"><i class="fa fa-check"></i></button>
                                                        </a>

                                                        <a href="servlets/actualizar_operacion.php?id_operacion=<?php echo $fila['id_operacion'];?>&status=<?php echo base64_encode("Rechazada")?>" >
                                                        <button class="btn btn-danger  dim " type="button" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fa fa-times"></i></button>
                                                    </a>
                                                        <?php }?>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    </table>
                                        </div>
                                    <!--</div>
                                </div>
                            </div>-->
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    localStorage.setItem("pagina","cotizaciones");
</script>
<?php
    include "footer.php";
?>
