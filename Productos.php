<?php 
//ini_set("display_errors","1");
include "menunav.php";  
include "conexion/conexion.php";
        $conexio=   conectar_bd();
        $query="SELECT p.*,sp.subfamilia  FROM productos p, subfamilia_producto sp
WHERE p.id_familia=sp.id_subfamilia  and imagen_producto !='' and p.estatus='Activo';";
        $result=$conexio->query($query);
?>          
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>PRODUCTOS</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a>Productos</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Gestion de Productos</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div>
        <!--<div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-sm-2">
                        <div class=" infont">
                            <a class="fa fa-pencil-square-o" href="registrar-producto.php">
                            <span>Nuevo Producto</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>-->
<div class="wrapper wrapper-content animated fadeInRight ecommerce">    
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="clients-list">
                            <ul class="nav nav-tabs">
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-1"><i class="fa fa-cubes"></i> PRODUCTOS</a></li>
                            </ul>
                            <div class="table-responsive">
                            <table id="productos" class="table table-stripped table-bordered table-hover dt-responsive nowrap" data-page-size="15">
                                <thead>
                                <tr>
                                    <th data-toggle="true">Cod. Producto</th>
                                    <th data-toggle="true">Nombre Producto</th>
                                    <th data-hide="phone">SubFamilia</th>
                                    <th data-hide="all">Descripción</th>
                                    <th>Estatus</th>
                                    <th data-hide="phone,tablet" >Stock</th>
                                    <th data-hide="phone">SKU</th>
                                    <th data-hide="phone,tablet" >Marca</th>
                                    <th data-hide="phone">Modelo</th>
                                    <th data-hide="phone,tablet" >$ Compra</th>
                                    <th data-hide="phone">$ Venta</th>
                                    <th>Img</th>
                                    <th data-hide="phone,tablet" >Fecha Registro</th>
                                    <th data-hide="phone">Fecha Actualización</th>
                                    <th class="text-right" data-sort-ignore="true">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    while($fila=$result->fetch_assoc()){ 
                                       // print_r($fila);
                                        ?>
                                <tr>
                                    <td><a class="detalleiframe"  href="detalleprovprod.php?id_producto=<?php echo $fila['id_producto'];?>"><?php echo $fila['numero_producto'];?></a></td>
                                    <td><?php echo $fila['producto'];?></td>
                                    <td><?php echo $fila['subfamilia'];?></td>
                                    <td><?php echo $fila['descripcion'];?></td>
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
                                        "><?php echo $fila['estatus'];?></span>
                                    </td>
                                    <td><?php echo $fila['stok'];?></td>
                                    <td><?php echo $fila['SKU'];?></td>
                                    <td><?php echo $fila['marca'];?></td>
                                    <td><?php echo $fila['modelo'];?></td>
                                    <td><?php echo $fila['precio_compra'];?></td>
                                    <td><?php echo $fila['precio_venta'];?></td>
                                    <td>
                                        <a class="fancybox fa fa-picture-o" href="<?php echo "servlets/".$fila['imagen_producto'];?>" title="<?php echo $fila['producto'];?>"></a>
                                    </td>
                                    <td><?php echo $fila['fecha_registro'];?></td>
                                    <td><?php echo $fila['fecha_actualizacion'];?></td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a href="editar-productos.php?idprodu=<?php echo $fila['id_producto'];?>" class="btn-white btn btn-xs">Editar</a>
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
    localStorage.setItem("pagina","Productos");
</script>
<?php
    include "footer.php";
?>