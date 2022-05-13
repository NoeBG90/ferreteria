<?php
include "../conexion/conexion.php";
$conexio =  conectar_bd();
if(!isset($_POST['cbxacceso'])){
$usuario="";
$passwor="";
$acceso="No";
}else{
	$acceso=$_POST['cbxacceso'];
$usuario=$_POST['txtusuario'];
$passwor=$_POST['txtpassword'];
}


if (!isset($_POST['cbxacceso'])){
	$query = "INSERT INTO empleados
(nombre, puesto, estatus, telefono, email, salario, comision, acceso, usuario, contrasena,fecha_registro)
VALUES('".$_POST['txtnombre']."', '".$_POST['slspuesto']."', '".$_POST['slsstatus']."', '".$_POST['txttelefono']."', '".$_POST['txtemail']."', ".$_POST['txtsalario'].", ".$_POST['txtcomision'].", '".$acceso."', '".$usuario."', '".$passwor."',now());
";
$result = $conexio->query($query);

$numero_empleado=$conexio->insert_id;

	$update_numero ="update empleados set numero_empleado =concat('EMP-',LPAD(".$numero_empleado." , 5 , '0')) where id_empleado =".$numero_empleado;
	$resultupdate = $conexio->query($update_numero);

print_r($result);


}else{
$queryvalidausuarii="select * from empleados where usuario='".$_POST['txtusuario']."';";
$result = $conexio->query($queryvalidausuarii);
if ($result->num_rows>0){
	echo "El usuario ya se encuentra registrado";
}else{	
$query = "INSERT INTO empleados
(nombre, puesto, estatus, telefono, email, salario, comision, acceso, usuario, contrasena,fecha_registro)
VALUES('".$_POST['txtnombre']."', '".$_POST['slspuesto']."', '".$_POST['slsstatus']."', '".$_POST['txttelefono']."', '".$_POST['txtemail']."', ".$_POST['txtsalario'].", ".$_POST['txtcomision'].", '".$acceso."', '".$usuario."', md5('".$passwor."'),now());
";
$result = $conexio->query($query);

$numero_empleado=$conexio->insert_id;

	$update_numero ="update empleados set numero_empleado =concat('EMP-',LPAD(".$numero_empleado." , 5 , '0')) where id_empleado =".$numero_empleado;
	$resultupdate = $conexio->query($update_numero);

print_r($result);


}
}


?>