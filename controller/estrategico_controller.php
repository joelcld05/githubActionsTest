<?php

require "Conexion.php";

class estrategicoControll{

    public function get_inventario_producto(){
        $data = array();
        $con = new Conexion();
		$query = "select * from inventario_segmentado;";
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

	public function get_inventario_producto_Nombre(){
        $data = array();
        $con = new Conexion();
		$query = "select * FROM inventario_segmentado;";
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

	public function get_inventario_producto_Descripcion(){
        $data = array();
        $con = new Conexion();
		$query = "select * FROM inventario_segmentado 
		GROUP BY Descripcion;";
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

	public function get_inventario_productosCompara($nombre,$descri){
        $data = array();
        $con = new Conexion();
		$query = 'select * FROM obtener_infoProducto
		WHERE nombre = SUBSTRING_INDEX("'.$nombre.'","-",1) and descripcions ="'.$descri.'";';

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