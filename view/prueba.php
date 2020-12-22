
<?php
require '../controller/opr_EMP_controller.php';

	$emp = new opr_EMP();
    $productos = $emp->optener_productos();
    
    var_dump($productos);