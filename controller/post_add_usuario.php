 
<?php
     require "../controller/Conexion.php";
     require "../controller/Datos_usuario.php";
     
    $id_rol = $_POST["ID_rol"];
    $id_scr = $_POST["ID_sucursal"];
    $id_lc_scr = $_POST["ID_lc_scr"];
    $pass = $_POST["contra"];
    $email = $_POST["correo"];
    $cell = $_POST["telefono"];
    $pnombre = $_POST["pnombre"];
	$papellido = $_POST["papellido"];
 

    $datos = new Datos_usuario();
     

    $wasSaved = $datos-> Insertar_usuario($id_rol,$id_scr,$id_lc_scr,$pass,$email,$cell,$pnombre,$papellido);
    if($wasSaved){
        session_start(); 
        $_SESSION['CRUD'] = "Se ha agrego correctamente";
        header("Location:../view/dashboard.php");
    }else{
        echo '<div class= "alert alert-danger">Error de indice</div>';
         
    }
?>


 