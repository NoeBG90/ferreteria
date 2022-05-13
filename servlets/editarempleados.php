<?php
ini_set("display_errors","1");
include "../conexion/conexion.php";
$conexio =  conectar_bd();

if(!isset($_POST['cbxacceso'])){
$usuario=$_POST['txtusuario'];
$passwor=$_POST['txtpassword'];
$acceso=$_POST['cbxaccesoaux'];
}else{
$acceso=$_POST['cbxacceso'];
$usuario=$_POST['txtusuario'];
$passwor=$_POST['txtpassword'];
}


	$query="UPDATE empleados
SET nombre='".$_POST['txtnombre']."', puesto='".$_POST['slspuesto']."', estatus='".$_POST['slsstatus']."', telefono='".$_POST['txttelefono']."', email='".$_POST['txtemail']."', salario=".$_POST['txtsalario'].", comision=".$_POST['txtcomision'].", acceso='".$acceso."', usuario='".$usuario."', contrasena=md5('".$passwor."'),fecha_actualizacion=now()
WHERE id_empleado=".$_POST['ide'].";";

//	echo $query;
	$result = $conexio->query($query);

	print_r($result);


?>