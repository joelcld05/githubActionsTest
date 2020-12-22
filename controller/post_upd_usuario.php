<?php
     require "../controller/Conexion.php";
     require "../controller/Datos_usuario.php";
      
    $contra = $_POST["contra"];
    $email = $_POST["email"];
    $celular = $_POST["cell"];
    $pnombre = $_POST["pnombre"];
    $snombre = $_POST["snombre"];
    $papellido = $_POST["papellido"];
    $sapellido = $_POST["sapellido"];
    $id = $_POST["ID"]; 

    if (isset($_POST['rol'])){
        $rol = $_POST["rol"];
    } else 
      $rol = $_POST['static_rol'];

    if (isset($_POST['sucur'])){
        $sucur = $_POST["sucur"];
    } else 
      $sucur = $_POST['static_scr'];


        //$rol = $_POST['static_rol'];
        //$sucur = $_POST['static_scr'];
  
 

    echo $contra.'<br>'.$email.'<br>'.$celular.'<br>'.$pnombre.'<br>'.$papellido.'<br>'.$snombre.'<br>'.$sapellido.'<br>'.$rol.'<br>'.$sucur.'<br>'.$id;
    $datos = new Datos_usuario();
     

    $wasSaved = $datos->Actualizar_usuario($contra,$email,$celular,$pnombre,$snombre,$papellido,$sapellido,$rol,$sucur,$id);
    if($wasSaved){
        //echo '<div class= "alert alert-danger">Se Edito Satisfactoriamente</div>';
        session_start(); 
        $_SESSION['CRUD'] = "Se ha actualizado correctamente";
        header("Location:../view/dashboard.php");
    }
    else
    {
      echo '<div class= "alert alert-danger">Error de indice</div>';   
    }
?>