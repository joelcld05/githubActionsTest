<?php
require "../controller/Validar_usuario.php";
session_start();

$correo = $_POST['correo'];
$contra = $_POST['pass'];

$object = new LoginClas($correo,$contra);

if($object->Loguear()){
	header("location: ../view/dashboard.php"); 
}else{
	header("location: ../index.php");
}
