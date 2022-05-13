<?php
session_start();
include "../conexion/conexion.php";
$conexio =  conectar_bd();

$queryvalidaproducto="select * from empleados where usuario='".trim($_POST['txtuser'])."' and contrasena=md5('".trim($_POST['txtpass'])."') and estatus='Activo';";

$result = $conexio->query($queryvalidaproducto);

if ($result->num_rows!=0){
	while($fila=$result->fetch_assoc()){
	 	$_SESSION['Usuario']=$fila['usuario'];
	 	$_SESSION['Puesto']=$fila['puesto'];
	 	$_SESSION['Nombre']=$fila['nombre'];
	 	$_SESSION['idempleado']=$fila['id_empleado'];
	 }
	echo "true";

}else{
	echo "false";
}

?>
