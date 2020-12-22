<?php
require "../controller/opr_EMP_controller.php";
$emp = new opr_EMP();

$id_gp = $_POST["id_gp"];
$cant = $_POST["cant"];

$emp->upt_reorden($id_gp ,$cant);
header("location: ../view/dashboard.php"); 