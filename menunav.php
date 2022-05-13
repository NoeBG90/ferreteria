<?php
ini_set("display_errors","1");
session_start();
if(!isset($_SESSION['Usuario'])){
    header("Location: index.php");

}


?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


        <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <title>GM INDUSTRIAL</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- DataTable -->
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

        <!-- Ladda style -->
    <link href="css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins/bootstrap-markdown/bootstrap-markdown.min.css" rel="stylesheet">
    <link href="css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <link href="css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">

    <!--estilos texto empleados y campos editables agregar producto-->
    <link href="css/textos.css" rel="stylesheet">
    
    <!--FancyBox-->

<link rel="stylesheet" href="jquery/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen"/>
<link rel="stylesheet" href="jquery/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<link rel="stylesheet" href="jquery/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

     <style>
        /* Additional style to fix warning dialog position */
        #alertmod_table_list_2 {
            top: 900px !important;
        }

        body {
            table-layout: fixed;
        }
        .file {
          visibility: hidden;
          position: absolute;
          }

    </style>

</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">

                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold"><?php echo $_SESSION['Nombre'];?></span>
                                <span class="text-muted text-xs block"><?php echo $_SESSION['Puesto'];?></span>
                            </a>
                            <!--<ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                                <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                                <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="login.html">Logout</a></li>
                            </ul>-->
                        </div>
                        <div class="logo-element">
                        </div>
                    </li>
                    <li>
                    <a href="#"><i class="fa fa-id-card-o"></i><span class="nav-label">Empleados</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="registrar-vendedores.php"><i class="fa fa-user-o"></i> Nuevo Empleado</a></li>
                            <li><a href="vendedores.php"><i class="fa fa-handshake-o"></i> Personal</a></li>
                            <li><a href="historico_vendedores.php"><i class="fa fa-history"></i>Histórico Empleados</a></li>
                            <!--<li><a href="comisionesempl.php"><i class="fa fa-star-o"></i> Comisiones Empleados</a></li>-->
                        </ul>

                    </li>
                    <li>
                    <a href="#"><i class="fa fa-group (alias)"></i><span class="nav-label">Clientes</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="registrar-cliente.php"><i class="fa fa-thumbs-o-up"></i> Nuevo Cliente</a></li>
                            <li><a href="clientes.php"><i class="fa fa-folder-open-o"></i> Clientes Registrados</a></li>
                            <li><a href="historico_clientes.php"><i class="fa fa-history"></i>Histórico Clientes</a></li>
                        </ul>
                    </li>
                    <li>
                    <a href="#"><i class="fa fa-suitcase"></i><span class="nav-label">Proveedores</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="registrar-proveedores.php"><i class="fa fa-truck"></i> Nuevo Proveedor</a></li>
                            <li><a href="proveedores.php"><i class="fa fa-list-alt"></i> Proveedores Registrados</a></li>
                            <li><a href="historico_prveedores.php"><i class="fa fa-history"></i>Histórico Proveedores</a></li>
                        </ul>
                    </li>
                    <li>
                    <a href="#"><i class="fa fa-cubes"></i><span class="nav-label">Productos</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="registrar-producto.php"><i class="fa fa-cube"></i> Nuevo Producto</a></li>
                            <li><a href="Productos.php"><i class="fa fa-linode"></i>Inventario</a></li>
                            <li><a href="historico_productos.php"><i class="fa fa-history"></i>Histórico Productos</a></li>
                            <li><a href="registrar-familiaproducto.php"><i class="fa fa-share-alt-square"></i> Nueva Familia Producto</a></li>
                            <li><a href="familias.php"><i class="fa fa-puzzle-piece"></i> Familias Productos</a></li>
                            <li><a href="historico_familias.php"><i class="fa fa-history"></i> Histórico Familias Productos</a></li>


                            <li><a href="registrar-subfamilia.php"><i class="fa fa-share-alt-square"></i> Nueva SubFamilia</a></li>
                            <li><a href="subfamilias.php"><i class="fa fa-puzzle-piece"></i> SubFamilias Productos</a></li>
                            <li><a href="historico_subfamilias.php"><i class="fa fa-history"></i> Histórico SubFamilias Productos</a></li>

                        </ul>
                        
                    </li>
                    <li>
                    <a href="#"><i class="fa fa-shopping-cart"></i><span class="nav-label">Compras</span><span class="fa arrow"></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="registrar-compra.php"><i class="fa fa-tty"></i> Nueva Compra</a></li>
                            <li><a href="compras.php"><i class="fa fa-archive"></i> Compras Registradas</a></li>
                        </ul>
                    </li>
                    <li>
                    <a href="#"><i class="fa fa-tags"></i><span class="nav-label">Operaciones</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="registrar-operacion.php"><i class="fa fa-tag"></i> Nueva Operación</a></li>
                            <li><a href="cotizaciones.php"><i class="fa fa-book"></i> Cotizaciones Registradas</a></li>
                            <li><a href="pedidos.php"><i class="fa fa-inbox"></i> Pedidos Registrados</a></li>
                            <li><a href="ventas.php"><i class="fa fa-tachometer"></i> Ventas Registradas</a></li>
                        </ul>
                    </li>
                    <!-- <li>
                    <a href="#"><i class="fa fa-edit (alias)"></i><span class="nav-label">Pedidos</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href=""><i class="fa fa-calendar"></i> Nuevo Pedido</a></li>
                            <li><a href="registrar-pedidos.php"><i class="fa fa-inbox"></i> Pedidos Registrados</a></li>
                        </ul>
                    </li>
                    <li>
                    <a href="#"><i class="fa fa-clipboard"></i><span class="nav-label">Facturas</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="registrar-facturas.php"><i class="fa fa-file-text"></i> Facturas Registradas</a></li>
                        </ul>
                    </li>
                    <li>
                    <a href="#"><i class="fa fa-bar-chart-o"></i><span class="nav-label">Ventas</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href=""><i class="fa fa-calculator"></i>Nueva Venta</a></li>
                            <li><a href="ventas.php"><i class="fa fa-tachometer"></i> Ventas Realizadas</a></li>
                            <li><a href="graph_morris.html">Ventas Pendientes</a></li>
                        </ul>
                    </li>
                    <li>
                    <a href="#"><i class="fa fa-calculator"></i><span class="nav-label">Credito y Cobranza</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="graph_flot.html">FACTURAS</a></li>
                            <li><a href="graph_morris.html">CUENTAS POR COBRAR</a></li>
                            <li><a href="graph_rickshaw.html">CUENTAS POR PAGAR</a></li>
                            <li><a href="graph_chartjs.html">NOTAS</a></li>
                            <li><a href="graph_chartist.html">ESTADOS DE CUENTA</a></li>
                        </ul>
                    </li>-->
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">

                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">



                <li>
                    <a href="servlets/cerrarsesion.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                <li>

                </li>
            </ul>

        </nav>
        </div>
