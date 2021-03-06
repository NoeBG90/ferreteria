<?php include "menunav.php";
include "conexion/conexion.php";
$conexio =   conectar_bd();
$query = "SELECT c.*,e.nombre vendedor FROM clientes c, empleados e WHERE c.id_empleado=e.id_empleado  AND  puesto='Vendedor' AND c.estatus='Activo' order by c.fecha_registro desc";
$result = $conexio->query($query);
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>CLIENTES</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a>Clientes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Gestion de Clientes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div>
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="clients-list">
                        <ul class="nav nav-tabs">
                            <li><a class="nav-link active" data-toggle="tab" href="#tab-1"><i class="fa fa-group (alias)"></i> CLIENTES</a></li>
                        </ul>
                        <div class="table-responsive">
                            <table id="clientes" class="table table-stripped table-bordered table-hover dt-responsive nowrap" data-page-size="15">
                                <thead>
                                    <tr>
                                        <th data-toggle="true">Núm_Cliente</th>
                                        <th data-toggle="true">Cliente</th>
                                        <th data-hide="phone">RFC</th>
                                        <th data-hide="all">Teléfono</th>
                                        <th data-hide="phone">Nombre Contacto</th>
                                        <th data-hide="phone,tablet">Vendedor</th>
                                        <th data-hide="phone">Estatus</th>
                                        <th data-hide="phone">E-mail</th>
                                        <th data-hide="phone">Descuento</th>
                                        <th data-hide="phone">Dirección</th>
                                        <th data-hide="phone">Fecha Registro</th>
                                        <th data-hide="phone">Fecha Actualización</th>
                                        <th class="text-right" data-sort-ignore="true">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($fila = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><a class="client-link"></a><?php echo $fila['numero_cliente']; ?></td>
                                            <td><a class="client-link"></a><?php echo $fila['nombre']; ?></td>
                                            <td><a class="client-link"></a><?php echo $fila['RFC']; ?></td>
                                            <td><i class="fa fa-phone"></i><?php echo $fila['telefono']; ?></td>
                                            <td><?php echo $fila['nom_contacto']; ?></td>
                                            <td><?php echo $fila['vendedor']; ?></td>
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
                                            ?>
                                        "><?php echo $fila['estatus']; ?></span>
                                            </td>
                                            <td><i class="fa fa-envelope"> </i><?php echo $fila['email']; ?></td>
                                            <td><?php echo $fila['descuento']; ?></td>
                                            <td><?php echo $fila['direccion']; ?></td>
                                            <td><?php echo $fila['fecha_registro']; ?></td>
                                            <td><?php echo $fila['fecha_actualizacion']; ?></td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <a href="editar-clientes.php?idc=<?php echo $fila['id_cliente']; ?>" class="btn-white btn btn-xs">Editar</a>
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
    localStorage.setItem("pagina", "clientes");
</script>
<?php
include "footer.php";
?>