<?php
require "../controller/opr_EMP_controller.php";
$emp = new opr_EMP();

$id_vt = $_POST["id_vt"];
$cant = $_POST["cant"];

$emp->upt_venta($id_vt ,$cant);
header("location: ../view/dashboard.php"); 