<?php

require "Conexion.php";

class tacticoControll{

    public function get_Clientes_venta(){
        $data = array();
        $con = new Conexion();
		$query = "select * from cliente_producto;";
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

	public function get_cliente_prov(){
        $data = array();
        $con = new Conexion();
		$query = "select * from report_clienteprov;";
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
	public function get_cliente_prov_cantidad(){
        $data = array();
        $con = new Conexion();
		$query = "select provincia, COUNT(provincia) AS 'cantidad' FROM report_clienteprov
		GROUP BY provincia;";
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

	public function get_report_historico(){
        $data = array();
        $con = new Conexion();
		$query = "select * from report_historico;";
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

	public function get_report_GananciaGlobal(){
        $data = array();
        $con = new Conexion();
		$query = "select * from report_gananciaGloabl;";
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

	public function get_report_GananciaXproducto($id){
        $data = array();
        $con = new Conexion();
		$query = "select SUM(Vendida) AS Vendida,descripcion, Stock, fecha FROM report_gananciaxproducto
		WHERE InventarioId = ". $id." GROUP BY fecha;";
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

	public function get_report_GananciaXproductoG(){
        $data = array();
        $con = new Conexion();
		$query = "select * FROM report_gananciaxproducto;";
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

	public function get_ProductosTipoConcat(){
        $data = array();
        $con = new Conexion();
		$query = "select * FROM mostarProductoInventario;";
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

	public function get_ProductTOtalHistorico(){
        $data = array();
        $con = new Conexion();
		$query = "select * FROM obtener_infoproducto;";
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