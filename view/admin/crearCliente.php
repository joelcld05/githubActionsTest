<?php
    require "../../controller/Conexion.php";
    require "../../controller/Datos_usuario.php";
    $datos = new Datos_usuario ();
	$dato_rol = $datos->Vista_Rol();
	$dato_sucursal = $datos->Vista_Sucursal();
    $dato_local_scr = $datos->Vista_local_Sucursal();
?>
<div class="container">
	<div class="row">
			<div class="card text-white bg-primary mb-3" style="width: 100%;">
				<div class="card-body">
					<h5 class="card-title">Registrar clientes</h5>
					<p class="card-text">En esta sesion se registra los nuevos clientes.</p>
				</div>
			</div>
	</div>
	<div class="row rounded p-4 bg-dark">
			<div class="container">
		<form action="../controller/post_add_usuario.php" method = "post">
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label for="">Nombre</label>
							<input type="text" name = "pnombre" class="form-control" id="">
						</div>
						<div class="form-group">
							<label for="">Apellido</label>
							<input type="text" name = "papellido" class="form-control" id="">
						</div>

						<div class="form-group">
						     <label for="">Rol</label>
                             <select name= "ID_rol"  class = "custom-select mb-3" required>
                                <option disabled selected>Seleccionar el rol</option> 
                            	<?php 
                                 foreach ($dato_rol as $rol) : ?> 
                                <option  value="<?= $rol["ID_rol"]?>"> <?=$rol["ID_rol"].". ".$rol["Rol"]?> </option>
                            	<?php endforeach ?>
                    		</select><br>
                		</div>

						<div class="form-group">
						<label for="">Sucursal</label>
                    		<select name= "ID_sucursal"  class = "custom-select mb-3" required> 
                        		<option   disabled selected>Seleccionar la Sucursal</option> 
                        		<?php 
                        		foreach ($dato_sucursal as $scr) : ?> 
                         		<option  value="<?= $scr["ID_sucursal"]?>"> <?= $scr["ID_sucursal"].". ".$scr["Sucursal"]?> </option> 
                        		<?php endforeach ?>
                    		</select>
                		</div>
					</div>

					<div class="col-6">
						<div class="form-group">
							<label for="">Correo</label>
							<input type="email" name ="correo" class="form-control" id="">
						</div>
						<div class="form-group">
							<label for="">Contraseña</label>
							<input type="password" name ="contra" class="form-control" id="">
						</div>
						<div class="form-group">
							<label for="">Telefono</label>
							<input type="text" name ="telefono" class="form-control" id="">
						</div>
						<div class="form-group">
							<!--<label for="">Celular</label>-->
							<input type="text" class="form-control" id="" hidden>
						</div><br>

						<div class="form-group"> 
						<label for="">Direccion</label>
                    		<select name= "ID_lc_scr"  class ="custom-select mb-3" required> 
                        		<option   disabled selected>Seleccionar la direccion</option> 
                        		<?php 
                        		foreach ($dato_local_scr as $scr) : ?>   
                         		<option  value="<?= $scr["ID_local_src"]?>"> <?= $scr["ID_local_src"].". ".$scr["ubicacion"]?> </option> 
                        		<?php endforeach ?>
                    		</select>
                		</div>
						
					</div>
				</div>
				<div class="row mt-5">
					<div class="col"><button type="submit" class="btn btn-primary btn-lg btn-block">Agregar</button></div>
					<div class="col"><button type="reset" class="btn btn-light btn-lg btn-block">Limpiar</button></div>
				</div>
				</form>
			</div>
	</div>
</div>