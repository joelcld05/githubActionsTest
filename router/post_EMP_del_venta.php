<?php
require "../controller/opr_EMP_controller.php";
$emp = new opr_EMP();

$id_vt = $_POST["id_vt"];

$emp->dell_venta($id_vt);
header("location: ../view/dashboard.php"); 