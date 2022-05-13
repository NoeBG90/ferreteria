<?php
$conexio;
function conectar_bd()
{
   // global $conexio;
    //Definir datos de conexion con el servidor MySQL
    $elUsr = "cnsticom_admingm";
    $elPw  = "4dm1nGM2021";
    $elServer ="198.59.144.8";
    $laBd = "cnsticom_gmindustrial";

    //Conectar
    $conexio = mysqli_connect($elServer, $elUsr , $elPw,$laBd) or die ($conexio->connect_errno);
    $conexio->set_charset("utf8");
    return $conexio;
}


?>
