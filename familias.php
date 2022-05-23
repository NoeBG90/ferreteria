<?php
include "menunav.php";
include "conexion/conexion.php";

$conexio =   conectar_bd();
$query = "SELECT * FROM familia_producto where estatus='Activo';";
$result = $conexio->query($query);
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>FAMILIA PRODUCTOS</h2>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="home.php">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="familias.php">Familia Productos</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Gestión Familias de Productos</strong>
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
                            <li>
                                <a class="nav-link active" data-toggle="tab" href="#tab-1"><i class="fa fa-sitemap"></i> FAMILIAS PRODUCTOS</a>
                            </li>
                            <!--<li><a class="nav-link" data-toggle="tab">
                                <a class="fa fa-pencil-square-o" href="registrar-familiaproducto.php">
                                <span>Nueva Familia</span>
                                </a></a></li>-->
                        </ul>

                        <div class="table-responsive">

                            <table id="familias" class="table table-striped table-hover table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th data-toggle="true">Familia Producto</th>
                                        <th data-hide="phone">Estatus</th>
                                        <th data-hide="phone">Fecha Registro</th>
                                        <th data-hide="phone">Fecha Actualización</th>
                                        <th data-hide="phone">Descripción</th>
                                        <th class="text-right" data-sort-ignore="true">Acción</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    while ($fila = $result->fetch_assoc()) {
                                    ?>

                                        <tr>
                                            <td><?php echo $fila['familia']; ?></td>

                                            <td>
                                                <span class="label
                                            <?php

                                            if ($fila['estatus'] == 'Activo') {

                                                echo "label-primary";
                                            } else if ($fila['estatus'] == 'Inactivo') {

                                                echo "label-danger";
                                            } else {

                                                echo "label-warning";
                                            }

                                            ?>">
                                                    <?php echo $fila['estatus']; ?>

                                                </span>

                                            </td>
                                            <td><?php echo $fila['created_at']; ?></td>
                                            <td><?php echo $fila['updated_at']; ?></td>
                                            <td><?php echo $fila['descripcion']; ?></td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <a href="editar-familiaproducto.php?idfp=<?php echo $fila['id_familia']; ?>" class="btn-white btn btn-xs">Editar</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
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
    localStorage.setItem("pagina", "familias");
</script>
<?php
include "footer.php";
?>