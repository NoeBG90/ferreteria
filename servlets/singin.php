<?php
session_start();
if(isset($_SESSION['Usuario'])){
	header("Location: ../home.php");
}else{
	header("Location: ../index.php");
}


?>
