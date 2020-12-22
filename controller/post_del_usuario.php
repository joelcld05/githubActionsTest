<?php
     require "../controller/Conexion.php";
     require "../controller/Datos_usuario.php";
    //Eliminar cliente
        $id = $_GET['datoId'];
		$datos = new Datos_usuario();
		$dato = $datos->Eliminar_usuario($id);
    
        if($dato)
        {   session_start(); 
            $_SESSION['CRUD'] = "Se elimino exitosamente";
            header("Location:../view/dashboard.php");
		}

		echo 'Error';
         
?>


