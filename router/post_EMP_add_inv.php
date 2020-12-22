<?php
require "../controller/opr_EMP_controller.php";
$emp = new opr_EMP();


$nombre = $_POST["nom"];
$preico_cp = $_POST["pre_cp"];
$precio_vt = $_POST["pre_vt"];
$descripcion = $_POST["tip_pro"];
$tipo_pro = $_POST["cat"];
$stock = $_POST["stock"];

$emp->add_inventario($nombre,$descripcion,$tipo_pro,$preico_cp,$precio_vt,$stock);
header("location: ../view/dashboard.php"); 