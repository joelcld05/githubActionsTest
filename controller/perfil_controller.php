<?php 
session_start();

require "Conexion.php";

class perfilControl{

    // ###################################################################### MOSTRAR DATOS USUARIO
    public function get_informacionUsuer(){
        $data = array();
		$con = new Conexion();
		$query = "select * FROM mostra_datosUsuario
			where Id_user = ". $_SESSION['id_usuario'].";";

			$login = mysqli_query($con->Conectar(),$query);
            $existLogin = mysqli_num_rows($login);
            if($existLogin > 0){
                $login = mysqli_fetch_object($login);
                $_SESSION["NombreU"] = $login->nombre;
				$_SESSION["emailU"] = $login->email;
				$_SESSION["celularU"] = $login->celular;
                $_SESSION["nombreSucursalU"] = $login->nombre_sucursal;
				$_SESSION["ubicacionU"] = $login->ubicacion;
				$_SESSION["apellidoU"] = $login->apellido;
				$_SESSION["img"] = $login->Imagen;
            }
	} 
}