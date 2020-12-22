<?php 
	require '../../controller/estrategico_controller.php';

	$emp = new estrategicoControll();
	$productoEstategicoNombre = $emp->get_inventario_producto_Nombre();
	//$clienteProv = $emp->get_cliente_prov();
	//$reportGlobal = $emp->get_report_historico();
?>

<div class="container">
	<div class="row">
		<div class="card text-white bg-primary mb-3" style="width: 100%;">
			<div class="card-body">
				<h5 class="card-title">Comparar productos</h5>
				<p class="card-text">En esta sesion se compararan los productos.</p>
			</div>
		</div>
	</div>
	<div class="row bg-dark p-5">
		<div class="col">
			<form action="">
				<div class="row">
					<div class="col">
						<div class="card text-white bg-primary mb-3" style="width: 100%;">
							<div class="card-body">
							<h4>Producto 1</h4><br>
								<div class="form-group">
									<label for="">Nombre</label>
									<div class="input-group w-100 card-subtitle mt-1">
										<select class="custom-select" id="productNombre1" onchange="ShowSelected1();">
										<?php foreach ($productoEstategicoNombre as $itmPrfo):?>
												<option value="<?= $itmPrfo["Descripcion"]?>"> <?= $itmPrfo["Nombre"] ."-".$itmPrfo["Descripcion"]?></option>
											<?php endforeach;?>
										</select>
										<div class="input-group-append">
											<label class="input-group-text" for="tipoProductos">Filtro</label>
										</div>
									</div>
								</div>
							</div>
						</div>			
					</div>
					<div class="col">				
					<div class="card text-white bg-primary mb-3" style="width: 100%;">
							<div class="card-body">
							<h4>Producto 2</h4> <br>
							<div class="form-group">
									<label for="">Nombre</label>
									<div class="input-group w-100 card-subtitle mt-1">
										<select class="custom-select" id="productNombre2" onchange="ShowSelected2();">
										<?php foreach ($productoEstategicoNombre as $itmPrfo):?>
											<option value="<?= $itmPrfo["Descripcion"]?>"> <?= $itmPrfo["Nombre"] ."-".$itmPrfo["Descripcion"]?></option>
											<?php endforeach;?>
										</select>
										<div class="input-group-append">
											<label class="input-group-text" for="tipoProductos">Filtro</label>
										</div>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</form>
			
			<div class="row mt-5">
					<div class="col"><button onclick="miFuncionsst();"class="btn btn-primary btn-lg btn-block">Comparar</button></div>
				</div>
		</div>
	</div>
	<div class="row">
		<div class="card w-100 mt-3 ">
			<div class="card-body">
				<h5 class="card-title">Productos comparados</h5>
				<div class="tab-content mt-5" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
					<div class="container">
						<div class="row">
							<div class="col-6" id="con1">
								<div class="card text-white bg-primary mb-3" style="max-width: 24rem;">
									<div class="card-header">Contenido producto1</div>
									<div class="card-body">
										<h5 class="card-title">Graficos</h5>
										<p class="card-text">En esta sesion podra ver los reportes sobre Ganancias y perdidas</p>
									</div>
								</div>
							</div>
							<div class="col-6" id="con2">
								<div class="card text-white bg-primary mb-3" style="max-width: 24rem;">
									<div class="card-header">Contenido Producto2</div>
									<div class="card-body">
										<h5 class="card-title">Graficos</h5>
										<p class="card-text">En esta sesion podra ver los reportes sobre Ganancias y perdidas</p>
									</div>
								</div>
							</div>
						
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<script type="text/javascript">        
		var datoNombre1;
		var datoNombre2;
		var datoDescripcion1;
		var datoDescripcion2;
				function ShowSelected1()
				{
					
					/* Para obtener el texto */
					var combo = document.getElementById("productNombre1");
					 datoNombre1 = combo.options[combo.selectedIndex].text;

					/* Para obtener el valor */
					var cod2 = document.getElementById("productNombre1").value;
					datoDescripcion1 = cod2;
				}

				function ShowSelected2()
				{
					/* Para obtener el texto */
					var combo = document.getElementById("productNombre2");
					 datoNombre2 = combo.options[combo.selectedIndex].text;

					/* Para obtener el valor */
					var cod2 = document.getElementById("productNombre2").value;
					datoDescripcion2 = cod2;
				}

		function miFuncionsst(){
			$(document).ready(function(){
					$("#con1").load("estrategico/TablasEstrategico/producto1.php",{datoNom1:datoNombre1,datoDes1:datoDescripcion1});
			});
			$(document).ready(function(){
					$("#con2").load("estrategico/TablasEstrategico/producto2.php",{datoNom2:datoNombre2,datoDes2:datoDescripcion2});
			});

			
		}
</script>