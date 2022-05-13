<?php
ini_set("display_errors","1");
include "menunav.php"; 
include "conexion/conexion.php";
        $conexio=   conectar_bd();

$query_empleado="select * from empleados where id_empleado=".$_GET['id']." ;";
$result_empleado=$conexio->query($query_empleado);
$fila_empleado=$result_empleado->fetch_assoc();

$query_clientes="select * from clientes where id_empleado=".$_GET['id']." ;";
$result_clientes=$conexio->query($query_clientes);

?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Profile</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Empleado</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Perfil</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content">
            <div class="row animated fadeInRight">
                <div class="col-md-4">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Perfil Empleado</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                            </div>
                            <div class="ibox-content profile-content">
                                <h4><strong><?php echo $fila_empleado['nombre'];?></strong></h4>
                                <p><i class="fa fa-phone"></i>&nbsp;<?php echo $fila_empleado['telefono'];?></p>
                                <p><i class="fa fa-envelope"></i>&nbsp;<?php echo $fila_empleado['email'];?></p>
                                <p><i class="fa fa-money"></i>&nbsp;<?php echo $fila_empleado['salario'];?></p>
                                 <p><i class="fa fa-trophy"></i>&nbsp;<?php echo $fila_empleado['comision'];?></p>
                                <p><i class="fa fa-laptop"></i>&nbsp;<?php echo $fila_empleado['puesto'];?></p>
                                
                            </div>
                    </div>
                </div>
                    </div>
                <div class="col-md-8">
                    <div class="table-responsive">
                                <table id="profile_empleado" class="table table-striped table-hover table-bordered dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th data-toggle="true">Nombre</th>
                                    <th data-hide="phone">Teléfono</th>
                                    <th data-hide="phone">Email</th>
                                    <th data-hide="phone">Estatus</th>
                                </tr>
                                </thead>
                                                <tbody>
                                                     <?php 
                                    while($fila_clientes=$result_clientes->fetch_assoc()){ 
                                        ?>
                                                <tr>
                                                <td><a class="client-link"></a><?php echo $fila_clientes['nombre'];?></td>
                                                <td><i class="fa fa-phone"></i><?php echo $fila_clientes['telefono'];?></td>
                                                <td><i class="fa fa-envelope"></i><?php echo $fila_clientes['email'];?></td>
                                                <td>
                                                        <span class="label 
                                                            <?php 
                                                                 if($fila_clientes['estatus']=='Activo'){
                                                                echo "label-primary";
                                                                }else if ($fila_clientes['estatus']=='Inactivo'){
                                                                echo "label-danger";
                                                                }else{
                                                                echo "label-warning";
                                                                }
                                                            ?>
                                                        "><?php echo $fila_clientes['estatus'];?></span>
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
        <?php
include "footer.php"
        ?>