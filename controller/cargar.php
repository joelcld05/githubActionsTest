<?php
require "Conexion.php";
session_start();
if(isset($_POST["submit"])){
    $revisar = getimagesize($_FILES["image"]["tmp_name"]);
    if($revisar !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContenido = addslashes(file_get_contents($image));
        
        $con = new Conexion();
        //Crear conexion con la abse de datos
		$query = "UPDATE usuario set  Imagen =".$imgContenido." where usuario.Id_user=". $_SESSION['id_usuario'].";";
        $insertar = mysqli_query($con->Conectar(), $query);
        
        //Insertar imagen en la base de datos
        // COndicional para verificar la subida del fichero
        if($insertar){
            echo "Archivo Subido Correctamente.";
        }else{
            echo "Ha fallado la subida, reintente nuevamente.";
        } 
        // Sie el usuario no selecciona ninguna imagen
    }else{
        echo "Por favor seleccione imagen a subir.";
	}
	header("location: ../view/dashboard.php"); 
}
?>