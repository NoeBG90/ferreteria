<?php
ini_set("display_errors","1");
include "menunav.php";
include "conexion/conexion.php";
        $conexio=   conectar_bd();
        $query="select * from empleados where estatus='Inactivo'";
        $result=$conexio->query($query);
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>EMPLEADOS</h2>
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a>Empleados</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Histórico Empleados</strong>
            </li>
            </ol>
    </div>
    <div class="col-lg-2">
    </div>
    <div class="clients-list">
        <ul class="nav nav-tabs">
            <li><a class="nav-link active" data-toggle="tab" href="#tab-1"><i class="fa fa-id-card-o"></i>HISTÓRICO EMPLEADOS</a></li>
            <!--<li><a class="nav-link" data-toggle="tab">
                <a class="fa fa-pencil-square-o" href="registrar-vendedores.php">
                <span>Nuevo Empelado</span>
                </a></a></li>-->
        </ul>
</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row col-lg-12">
            <?php
            while($fila=$result->fetch_assoc()){
            ?>
            <div class="col-lg-4">
                <div class="contact-box">
                    <a class="row" href="perfil-empleado.php?id=<?php echo $fila['id_empleado'];?>">
                    <div class="col-4">
                        <div class="text-center">
                            <h4><div class="m-t-xs font-bold"><?php echo $fila['puesto'];?></div></h4>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="text-right">
                            <h3><div class="m-t-xs font-bold"><?php echo $fila['numero_empleado'];?></div></h3>
                        </div>
                    </div>  
                    
                    <div class="col-12 text-center">
                        <h3><strong><?php echo $fila['nombre'];?></strong></h3>
                       
                    </div>
                    
                    <div class="col-12 alineacion">
                        <h5><?php echo $fila['email'];?></h5>
                    </div>
                    
                    <div class="col-12 alineacion">
                        <h5><strong><?php echo $fila['telefono'];?></strong></h5>
                    </div>
                        </a>
                        <a>
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
                            "><?php echo $fila['estatus'];?></span>
                            <a href="editar-empleados.php?ide=<?php echo $fila['id_empleado'];?>"" class="btn-white btn btn-xs">Editar</a>
                        </a>
                </div>
            </div>
            <?php
            }
        ?>
        </div>
</div>
<script type="text/javascript">
    localStorage.setItem("pagina","historico_vendedores");
</script>
<?php
    include "footer.php";
?>
