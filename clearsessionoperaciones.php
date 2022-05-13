<?php
session_start();
unset($_SESSION["productos_cotizacion"]);
unset($_SESSION["productos_cotizacion_edicion"]);
unset($_SESSION["tabla_cotizacion"]);


header("Location: registrar-operacion.php");

?>