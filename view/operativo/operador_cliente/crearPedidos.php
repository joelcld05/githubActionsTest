<?php 
	require '../../../controller/opr_EMP_controller.php';

	$emp = new opr_EMP();
	$productos = $emp->get_productos();
?>

<div class="container">
	<div class="row">
			<div class="card text-white bg-primary mb-3" style="width: 100%;">
				<div class="card-body">
					<h5 class="card-title">Registrar Pedido</h5>
					<p class="card-text">En esta sesion se registra los nuevos pedidos.</p>
				</div>
			</div>
	</div>
	<div class="row rounded p-4 bg-dark">
			<div class="container">
				<form action="../router/post_EMP_add_venta.php" method="post">
				<div class="row">
					<div class="col-6">
					<div class="form-group">
							<label for="">Producto</label>
							<select class="custom-select" id="tipoProductos" name="id_inv" onchange="ShowSelected();">
								<?php foreach ($productos as $itmPrfo):?>
									<option value="<?= $itmPrfo["ID"]?>"> <?= $itmPrfo["nombre"]?></option>
								<?php endforeach;?>
							</select>
						</div>
						<!-- <div class="form-group">
							<label for="">Cantidad Solicitada</label>
							<input type="text" class="form-control" id="">
						</div>
						<div class="form-group">
							<label for="">precio</label>
							<input type="text" class="form-control" id="">
						</div> -->
					</div>
					<div class="col-6">
						<div class="form-group">
							<label for="">Cantidad Solicitada</label>
							<input type="text" class="form-control" name = "cantidad" id="">
						</div>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col"><button type="submit" class="btn btn-primary btn-lg btn-block">Agregar</button></div>
					<div class="col"><button type="button" class="btn btn-light btn-lg btn-block">Limpiar</button></div>
				</div>
				</form>
			</div>
	</div>
</div>