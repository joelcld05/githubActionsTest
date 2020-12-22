<?php 
	require '../../../controller/opr_EMP_controller.php';

	$emp = new opr_EMP();
	$productos = $emp->get_productos();
	$type_Products = $emp->get_Type_product();
	$descripcion = $emp->get_categoria();
?>

<div class="container">
	<div class="row">
			<div class="card text-white bg-primary mb-3" style="width: 100%;">
				<div class="card-body">
					<h5 class="card-title">Registrar Productos</h5>
					<p class="card-text">En esta sesion se registra los nuevos productos.</p>
				</div>
			</div>
	</div>
	<div class="row rounded p-4 bg-dark">
			<div class="container">
				<form action="../router/post_EMP_add_inv.php" method="post">
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label for="">Nombre del Producto</label>
							<input type="text"  class="form-control" id="" name = "nom">
						</div>
						<div class="form-group">
							<label for="">Precio Compra</label>
							<input type="text" class="form-control" id="" name="pre_cp">
						</div>
						<div class="form-group">
							<label for="">Precio Venta</label>
							<input type="text" class="form-control" id="" name="pre_vt">
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label for="">Categoria</label>
							<select class="custom-select" id="tipoProductos" name="cat" onchange="ShowSelected();">
								<?php foreach ($type_Products as $itmPrfo):?>
									<option value="<?= $itmPrfo["ID_prod"]?>"> <?= $itmPrfo["tipo_prod"]?></option>
								<?php endforeach;?>
							</select>
						</div>
						<div class="form-group">
							<label for="">Tipo Producto</label>
							<select class="custom-select" id="tipoProductos" name="tip_pro" onchange="ShowSelected();">
								<?php foreach ($descripcion as $itmPrfo):?>
									<option value="<?= $itmPrfo["ID_desc"]?>"> <?= $itmPrfo["desc"]?></option>
								<?php endforeach;?>
							</select>
						</div>
						<div class="form-group">
							<label for="">Stock Inicial</label>
							<input type="text" class="form-control" id="" name="stock">
						</div>
						<!-- <div class="form-group">
							<label for="">Entradas</label>
							<input type="email" class="form-control" id="">
						</div>
						<div class="form-group">
							<label for="">Stock</label>
							<input type="password" class="form-control" id="">
						</div>
						<div class="form-group">
							<label for="">Precio</label>
							<input type="text" class="form-control" id="">
						</div>
						<div class="form-group">
							<label for="">Precio</label>
							<input type="text" class="form-control" id="">
						</div> -->
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