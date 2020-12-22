<?php

class Datos_usuario{

    //Tabla usuario
    function Vista_Usuario(){
        $con = new Conexion();
        $query = "SELECT * FROM vista_usuario";
        $res = mysqli_query($con->Conectar(),$query);
        $datos = array();
        while($row = mysqli_fetch_assoc($res)){
            $datos[] = $row;
        }
        return  $datos;
    }

    //Tabla Rol
    function Vista_Rol(){
        $con = new Conexion();
        $query = "SELECT * FROM vista_rol";
        $res = mysqli_query($con->Conectar(),$query);
        $datos = array();
        while($row = mysqli_fetch_assoc($res)){
            $datos[] = $row;
        }
        return  $datos;
    }

    //Tabla Sucursal
    function Vista_Sucursal(){
        $con = new Conexion();
        $query = "SELECT * FROM vista_sucursal";
        $res = mysqli_query($con->Conectar(),$query);
        $datos = array();
        while($row = mysqli_fetch_assoc($res)){
            $datos[] = $row;}
        return  $datos; 
    }

        //Tabla Sucursal
        function Vista_local_Sucursal(){
            $con = new Conexion();
            $query = "SELECT * FROM Local_scr";
            $res = mysqli_query($con->Conectar(),$query);
            $datos = array();
            while($row = mysqli_fetch_assoc($res)){
                $datos[] = $row;}
            return  $datos; 
        }

    //Mostrar usuario
      function Mostrar_Usuario($id){
        $con = new Conexion();
        $query = "CALL Mostrar_usuario(".$id.")";
        $res = mysqli_query($con->Conectar(),$query);
        $datos = array();
        while($row = mysqli_fetch_assoc($res)){
            $datos[] = $row;
        }
        return  $datos;
    }

    //Agregar un nuevo usuario
    function Insertar_usuario ($id_rol,$id_sucursal,$id_loc_scr,$contra,$correo,$cell,$p_nombre,$p_apellido){
        $con = new Conexion();
        $sp = false;
        $query = "CALL Agregar_usuario('".$id_rol."','".$id_sucursal."','".$id_loc_scr."','".$contra."','".$correo."','".$cell."','".$p_nombre."','".$p_apellido."')";
        mysqli_query($con->Conectar(), $query);
        $sp = true;
        return $sp;
    }

    //Eliminamos los registros creados del usuario
    function Eliminar_usuario($id){
        $con = new Conexion();
        $query = "CALL Eliminar_usuario(".$id.")";
        return mysqli_query($con->Conectar(), $query);
    }

    //Actualizar los datos del usuario
    function Actualizar_usuario($contra,$email,$cell,$pn,$sn,$pa,$sa,$rol,$scr,$id){
        $con = new Conexion();
        $query = "CALL Actualizar_usuario('".$contra."','".$email."','".$cell."','".$pn."','".$sn."','".$pa."','".$sa."','".$rol."','".$scr."','".$id."')";
        return mysqli_query($con->Conectar(), $query);
    }

}

?>