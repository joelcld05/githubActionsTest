<?php
require "../controller/opr_EMP_controller.php";
$emp = new opr_EMP();

$id_pd = $_POST["id_pd"];

$emp->dell_producto($id_pd);
header("location: ../view/dashboard.php"); 