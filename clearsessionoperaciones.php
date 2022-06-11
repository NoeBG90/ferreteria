<?php

session_start();

unset($_SESSION["productos_cotizacion"]);
unset($_SESSION["productos_cotizacion_edicion"]);
unset($_SESSION["tabla_cotizacion"]);

unset($_SESSION["operacion"]['tabla']);
unset($_SESSION["operacion"]['productos']);

header("Location: registrar-operacion.php");
