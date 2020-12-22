<?php

require "Conexion.php";

class opr_EMP{

    // ###################################################################### GLOBAL
    public function get_Type_product(){
        $data = array();
        $con = new Conexion();
		$query = "select * from tipo_producto;";
        $result = mysqli_query($con->Conectar(), $query);
        $exits = mysqli_num_rows($result);
        if($exits > 0){
            while($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            }
        }else {
            header("location: ../view/error/obtencion_datos.php"); 
        }
        return $data;
    } 

    // ###################################################################### TABLA PRODUCTOS
    public function get_productos(){
        $data = array();
        $con = new Conexion();
		$query = "select * from productos_EMP;";
        $result = mysqli_query($con->Conectar(), $query);
        $exits = mysqli_num_rows($result);
        if($exits > 0){
            while($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            }
        }else {
            header("location: ../view/error/obtencion_datos.php"); 
        }
        return $data;
    } 
     
    public function upt_reorden($id_gp,$cat){
        $con = new Conexion();
		$query = "call update_reorden(".$id_gp.",".$cat.") ;";
        mysqli_query($con->Conectar(), $query);
        header("location: ../view/error/obtencion_datos.php");
        $sp = true;
        return $sp;
    }

    public function dell_producto($id_pd){
        $con = new Conexion();
		$query = "call dell_inventario(".$id_pd.") ;";
        mysqli_query($con->Conectar(), $query);
        header("location: ../view/error/obtencion_datos.php");
        $sp = true;
        return $sp;
    }

    // ###################################################################### TABLA PEDIDOS EMP
    public function get_ventas(){
        $data = array();
        $con = new Conexion();
		$query = "select * from view_venta;";
        $result = mysqli_query($con->Conectar(), $query);
        $exits = mysqli_num_rows($result);
        if($exits > 0){
            while($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            }
        }else {
            header("location: ../view/error/obtencion_datos.php"); 
        }
        return $data;
    }

    public function get_ventas_id($id){
        $data = array();
        $con = new Conexion();
		$query = "select * from view_venta where USER = '".$id."';";
        $result = mysqli_query($con->Conectar(), $query);
        $exits = mysqli_num_rows($result);
        if($exits > 0){
            while($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            }
        }else {
            header("location: ../view/error/obtencion_datos.php"); 
        }
        return $data;
    }

    public function upt_venta($id_vt,$cat){
        $con = new Conexion();
		$query = "call update_venta(".$id_vt.",".$cat.") ;";
        mysqli_query($con->Conectar(), $query);
        header("location: ../view/error/obtencion_datos.php");
        $sp = true;
        return $sp;
    }

    public function dell_venta($id_vt){
        $con = new Conexion();
		$query = "call dell_venta(".$id_vt.") ;";
        mysqli_query($con->Conectar(), $query);
        header("location: ../view/error/obtencion_datos.php");
        $sp = true;
        return $sp;
    }


    // ###################################################################### CREAR PEDIDO
    public function add_venta($usr,$inv,$cat){
        $con = new Conexion();
		$query = "call add_venta(".$usr.",".$inv.",".$cat.") ;";
        mysqli_query($con->Conectar(), $query);
        header("location: ../view/error/obtencion_datos.php");
        $sp = true;
        return $sp;
    }




    // ###################################################################### AGREGAR PRODUCTO
    public function add_inventario($nom,$des,$tip,$pr_cp,$pr_vt,$stk){
        $con = new Conexion();
		$query = "call add_inventario('".$nom."',".$des.",".$tip.",".$pr_cp.",".$pr_vt.",".$stk.") ;";
        mysqli_query($con->Conectar(), $query);
        header("location: ../view/error/obtencion_datos.php");
        $sp = true;
        return $sp;
    }


    public function get_categoria(){
        $data = array();
        $con = new Conexion();
		$query = "select * from descripcion;";
        $result = mysqli_query($con->Conectar(), $query);
        $exits = mysqli_num_rows($result);
        if($exits > 0){
            while($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            }
        }else {
            header("location: ../view/error/obtencion_datos.php"); 
        }
        return $data;
    } 


}