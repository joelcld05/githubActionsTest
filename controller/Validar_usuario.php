<?php
require "Conexion.php";
class LoginClas{
    private $user,$pass;

    //Recibimos los datos user y password
    function __construct($u,$p){
        $this->user = $u;
        $this->pass = $p;
    }


    //Realizamos el acceso de Usuario
    public function Loguear(){
        $sesion = 0;
        $con = new Conexion();
        $userExist = mysqli_query($con->Conectar(),"SELECT * FROM usuario WHERE pass = '".$this->pass."'");
        $user = mysqli_num_rows($userExist);
        if($user > 0){
            $query = "CALL Sesion_usuario('".$this->pass."','".$this->user."')";
            $login = mysqli_query($con->Conectar(),$query);
            $existLogin = mysqli_num_rows($login);
            if($existLogin > 0){
                $login = mysqli_fetch_object($login);
                $_SESSION["usuario"] = $login->pri_nombre;
                $_SESSION["id_usuario"] = $login->ID_user;
                $_SESSION["rol"] = $login->tip_rol;
                $_SESSION["id_rol"] = $login->ID_rol;
                $sesion = $_SESSION["id_rol"]; 
            }
        }
        return $sesion;
    }

    //Guardamos el token de contraseña en la BD
    function Guardar_token($token){
        $con = new Conexion();
        if (!$token == null){
            $query = "CALL Agregar_token('".$token."','".$this->pass."')";
            return mysqli_query($con->Conectar(),$query);
        }
         
    }
}

?>