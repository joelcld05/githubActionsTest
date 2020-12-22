<?php 
    require '../../controller/Conexion.php';
    require '../../controller/Datos_usuario.php';
		session_start(); 
		            
        $datos = new Datos_usuario ();
        $dato_usuario = $datos->Vista_Usuario();
        $dato_rol = $datos->Vista_Rol();
		$dato_sucursal = $datos->Vista_Sucursal();
		
		if(isset($_POST['id_usuario'])){
			$id = $_POST['id_usuario'];
			$mostar_usuario = $datos->Mostrar_Usuario($id);
		}
		
?>
      

<div class="container" >
	<div class="row"  >
			<div class="card text-white bg-primary mb-3" style="width: 100%;">
				<div class="card-body">
					<h5 class="card-title">Historial clientes</h5>
					<p class="card-text">En esta sesion se mostraran los clientes.</p>
				</div>
			</div>
	</div>
<?php       
	foreach ($dato_usuario as $res) : 
	$pnombre = $res["nombre"];
	$snombre = $res["s_nombre"];
	$papellido = $res["apellido"];
	$sapellido = $res["s_apellido"];
	$celular = $res["celular"];
	$email = $res["correo"];
	$rol = $res["rol"];
	$contra = $res["contra"];
	$sucursal = $res["sucursal"];
	$perfil_scr = $res["perfil"];
	$id_usuario = $res["ID_user"];
	$id_scr = $res["id_sucursal"];
	$id_local_scr = $res["ubicacion"];
	$id_rol = $res["id_rol"];
	//$sesion_usuario = $_SESSION["ID_user"] = $id_usuario;
		
	?>
	<div class="mx-auto row "> 
	 <ul class="list-group" id="listCliente" >
		<li class="list-group-item list-group-sm" 
			style="background-color:rgb(244,246,249); border-style: none;"> 
		<p hidden><?=$pnombre?></p><p hidden><?=$celular?></p>
			<div class="card text-muted mb-1" style="width: 18rem;" >
				<div class="card-body p-3" >
					<div class="container-fluid">
						<div class="row">
							<div class="col">
								<div class="logoCliente" style="background: url('<?=$perfil_scr?>'); 
								width: 100%; height: 10vh; background-size: 
								contain; background-position: center;
								background-repeat: no-repeat;"></div>
							</div>
							<div class="col">
								<p class="card-title"><?=$pnombre?></p>
								<p class="card-text" style="font-size: 12px;"><?=$celular?></p>
								
							</div>
							<div class="col">
								<i type ="button" href="#edit_cliente<?php echo $id_usuario;?>" data-toggle="modal" class="fas fa-pen ml-4" style="cursor: pointer;"></i>
								<i type ="button" href="#delete_cliente<?php echo $id_usuario;?>" data-toggle="modal"  class="fas fa-times ml-1" style="cursor: pointer;"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-muted text-center">
					<i class="fab fa-facebook-f mr-4"></i>
					<i class="fab fa-instagram mr-4"></i>
					<i class="fab fa-twitter"></i>
				</div>
			</div>
		</div>
		</li>
	  </ul>          
	</div>


 

<!----------------------BUSCAR USUARIOS------------------------->
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#listCliente li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>



<!----------------------MODAL ELIMINAR------------------------->
<div id="delete_cliente<?php echo $id_usuario;?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal Contenedor-->
         <div class="modal-content">
          <!-----------Encabezado-------->
           <div class="modal-header bg-primary">
             <h4 class="modal-title text-white" >Eliminar   <?php echo $pnombre;?></h4>  
           </div>
           <!-----------Contenido-------->
           <div class="modal-body">
             <br>
             	<p class="text-center "><strong> ¿ Esta seguro que desea eliminar este cliente ? </strong></p>   
             <br>     
           </div>
           <!------------Footer-------->
           <div class="modal-footer">
		     <a href="../controller/post_del_usuario.php?datoId=<?= $id_usuario;?>" class="btn btn-danger mr-auto">Si</a>
		      
             <button type="button" class="btn btn-primary" style="border:#005B28;" data-dismiss="modal">No</button>
           </div>
         </div>

     </div>
 </div>

 <!----------------------MODAL EDITAR------------------------->
<div id="edit_cliente<?php echo $id_usuario;?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
	<form action="../controller/post_upd_usuario.php" method ="post" id= "form" >
	
	    <!-- Modal Contenedor-->
		<div class="modal-content">
          <!-----------ENCABEZADO-------->
           <div class="modal-header bg-primary">
		   <h4 class="modal-title text-white">Editar <?php echo $pnombre;?></h4>
		   <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
           </div>

           <!-----------FORMULARIO DEL MODAL -------->
			<div class=" modal-body bg-dark" >
			        <input type="hidden" name ="ID" value ="<?=$id_usuario?>">
						<div class="container">
						      
							<div class="form-group">
								<label for="">Nombres</label>
								<input type="text" name ="pnombre" value = "<?=$pnombre?>" class="form-control" id="" maxlength="15" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" placeholder="Primer Nombre" required>
							</div>

							<div class="form-group">
								<input type="text" name ="snombre" value = "<?=$snombre?>" class="form-control" id="" maxlength="15" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" placeholder="Segundo Nombre">
							</div>

							<div class="form-group">
								<label for="">Apellidos</label>
								<input type="text" name ="papellido" value ="<?=$papellido?>" class="form-control" id="" maxlength="15" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" placeholder="Primer Apellido" required>
							</div>

							<div class="form-group">
								<input type="text" name ="sapellido" value ="<?=$sapellido?>" class="form-control" id="" maxlength="15" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" placeholder="Segundo Apellido">
							</div>
                           
							<div class="form-group">
								<label for="">Correo</label>
								<input type="email" name ="email" value ="<?=$email?>" class="form-control" id="" maxlength="30" required>
							</div>

							
							<div class="form-group">
								<label for="">Telefono</label>
								<input type="text" name ="cell" value ="<?=$celular?>" class="form-control" id="" maxlength="8" pattern="[0-9-]+" required>
							</div>
					
						<div class="form-group">
							<label for="">Rol</label>
							    <input type="hidden" name ="static_rol" value= "<?= $id_rol?>">
								<input type="text"  value ="<?=$rol?>" class="form-control" readonly>
							</div>

							<div class="form-group">
								<select name= "rol"  class = "custom-select mb-3" required>
									<option disabled selected>Seleccionar el rol</option> 
									<?php 
									foreach ($dato_rol as $rol) : ?> 
									<option  value="<?= $rol["ID_rol"]?>"> <?=$rol["ID_rol"].". ".$rol["Rol"]?> </option>
									<?php endforeach ?>
								</select><br>
                		    </div>

							<div class="form-group">
							<label for="">Sucursal</label>
							    <input type="hidden" name ="static_scr" value= "<?= $id_scr?>">
								<input type="text"  value ="<?=$sucursal?>" class="form-control" readonly>
							</div>

							   <div class="form-group">
									<select name= "sucur"  class = "custom-select mb-3" required> 
										<option   disabled selected>Seleccionar la Sucursal</option> 
										<?php 
										foreach ($dato_sucursal as $scr) : ?> 
										<option  value="<?= $scr["ID_sucursal"]?>"> <?= $scr["ID_sucursal"].". ".$scr["Sucursal"]?> </option> 
										<?php endforeach ?>
									</select>
								</div>
								<div class="form-group">
									<label for="">Contraseña</label>
									<input type="text" name ="contra" value ="<?=$contra?>" class="form-control" id=""  readonly>
								</div>
						</div>
				 
			   </div>
           <!------------Footer-------->
           <div class="modal-footer bg-primary">
		    <button type="submit" name = "uptadep" class="btn  btn-lg btn-block" style="color:white">Editar</button> 
           </div>
         </div>
	
	</form>
    <script>
 		/*var form = document.getElementById("form");
			form.onsubmit = function (e)  {
       		e.preventDefault();
		}; 
	</script>

     </div>
</div>

 <?php endforeach ?>