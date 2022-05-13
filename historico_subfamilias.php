<?php
include "menunav.php";
include "conexion/conexion.php";
        $conexio=   conectar_bd();
        $query="SELECT * FROM subfamilia_producto where estatus='Inactivo';";
        $result=$conexio->query($query);
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>FAMILIA PRODUCTOS</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a>Familia Productos</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Gestión Historico SubFamilias de Productos</strong>
            </li>
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
                            <li><a class="nav-link active" data-toggle="tab" href="#tab-1"><i class="fa fa-sitemap"></i> HISTORICO SUBFAMILIAS PRODUCTOS</a></li>
                            <!--<li><a class="nav-link" data-toggle="tab">
                                <a class="fa fa-pencil-square-o" href="registrar-familiaproducto.php">
                                <span>Nueva Familia</span>
                                 </a></a></li>-->
                        </ul>
                    <div class="table-responsive">
                        <table id="subfamilias" class="table table-striped table-hover table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <!--<th data-toggle="true">Núm_Familia Producto</th>-->
                                    <th data-toggle="true">SubFamilia Producto</th>
                                    <th data-hide="phone">Estatus</th>
                                    <th data-hide="phone">Fecha Registro</th>
                                    <th data-hide="phone">Fecha Actualización</th>
                                    <th data-hide="phone">Descripción</th>
                                    <th class="text-right" data-sort-ignore="true">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($fila=$result->fetch_assoc()){
                                ?>
                                <tr>
                                    <!--<td><?php echo $fila['numero_familiaprod'];?></td>-->
                                    <td><?php echo $fila['subfamilia'];?></td>
                                    <td>
                                        <span class="label
                                        <?php
                                            if($fila['estatus']=='Activo'){
                                                echo "label-primary";
                                            }else if ($fila['estatus']=='Inactivo'){
                                                echo "label-danger";
                                            }else{
                                                echo "label-warning";
                                            }
                                        ?>
                                            "><?php echo $fila['estatus'];?>
                                        </span>
                                    </td>
                                    <td><?php echo $fila['fecha_registro'];?></td>
                                    <td><?php echo $fila['fecha_actualizacion'];?></td>
                                    <td><?php echo $fila['descripcion'];?></td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a href="editar-subfamiliaproducto.php?idfp=<?php echo $fila['id_subfamilia'];?>" class="btn-white btn btn-xs">Editar</a>
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
<script type="text/javascript">
    localStorage.setItem("pagina","historico_subfamilias");
</script>
<?php
include "footer.php";
?>
