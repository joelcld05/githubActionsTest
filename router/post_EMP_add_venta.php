<?php
require "../controller/opr_EMP_controller.php";
$emp = new opr_EMP();

session_start();
$id_inv = $_POST["id_inv"];
$cant = $_POST["cantidad"];
$user = $_SESSION["id_usuario"];

$rsp = $emp->add_venta($user, $id_inv,  $cant);
header("location: ../view/dashboard.php"); 