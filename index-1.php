<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--Inicio del los estilos css-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/style.css">
	<!--Fin del los estilos css-->

	<!--Inicio del las librerias js-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<title>Document</title>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="fondo col-5 ">
		<img src="public/img/after.png" width="100%" height="100%" alt="">
    </div>
    <div class="col-7">
		<div class="container contendor-formulario mt-5">
			<div class="row">
				<div class="col-sm ">
				<div class="card mb-3 text-center border-light ">
					<div class="card-body ">
						<h3 class="card-title">Su nombre, 1ls131</h3>
						<p class="card-text">Bienvenido porfavor inicia sesion para ingresar al sitio.</p>
					</div>
				</div>
				<form action="router/login.php" method="POST">
					<div class="form-group">
						<label for="exampleInputEmail1">Correo Eletronico</label>
						<input type="email" name="correo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Contraseña</label>
						<input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
					</div>
					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="exampleCheck1">
						<label class="form-check-label" for="exampleCheck1">Recordarme</label>
					</div>
					<div class="d-flex justify-content-center mt-5">
						<button type="submit" class="boton-continuar">Continuar</button>
					</div>	
				</form>
				</div>
			</div>
		</div>
    </div>
  </div>
</div>
</body>
</html>