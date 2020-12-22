<?php 
	require '../../controller/perfil_controller.php';
	$obj = new perfilControl();

	$obj->get_informacionUsuer();
	$var = $_SESSION['id_usuario'];

?>
<!------ Include the above in your HEAD tag ---------->
			<div class="card text-white bg-primary mb-3 w-100">
				<div class="card-body">
					<h5 class="card-title" style= "font-weight: bold;">Perfil de usuario</h5>
					<p class="card-text">Hola que tal, ahora mismo te encuentras en tu perfil de usuario.</p>
				</div>
			</div>
<div class="mt-2 card mb-3 w-100" >
  <div class="row no-gutters" id="particles-js">
    <div class="col-sm coll">
		
		<div class="contenImg">
			<div class="imgenPerfil w-100"></div>
		</div>
    </div>
    <div class="col-sm ">
      <div class="card-body vintage">
		<h5 class="card-title">Perfil de usuario</h5>
			<div class="form-group row mt-5">
				<label for="staticEmail" class="col-sm-2 col-form-label">Nombre:</label>
				<div class="col">
				<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $_SESSION['NombreU']." ".$_SESSION['apellidoU']?>">
				</div>
			</div>

			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">Email:</label>
				<div class="col-sm-10">
				<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $_SESSION['emailU']?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">Rol:</label>
				<div class="col-sm-10">
				<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $_SESSION['rol']?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">Sucursal:</label>
				<div class="col-sm-10">
				<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $_SESSION['nombreSucursalU']?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">Celular:</label>
				<div class="col-sm-10">
				<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $_SESSION['celularU']?>">
				</div>
			</div>
			
      </div>
    </div>
  </div>
</div>

<style type="text/css">
 .contenImg .imgenPerfil{
	background: url(<?= $_SESSION['img']?>);
	height: 100%;
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
}
.vintage{
	text-align: center;
}
.coll .contenImg{
	width: 70%;
	height: 40vh;
	-webkit-box-shadow: 7px 7px 9px 0px rgba(50, 50, 50, 0.75);
-moz-box-shadow:    7px 7px 9px 0px rgba(50, 50, 50, 0.75);
box-shadow:         7px 7px 9px 0px rgba(50, 50, 50, 0.75);
}
.coll{
	display: flex;
	justify-content: center;
	align-items: center;
}
</style>