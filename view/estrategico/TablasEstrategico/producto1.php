<?php 
	require '../../../controller/estrategico_controller.php';

	$emp = new estrategicoControll();
	$nombreData = $_REQUEST['datoNom1'];
	$descData = $_REQUEST['datoDes1'];

	
	$productoEstrategico = $emp->get_inventario_productosCompara($nombreData,$descData);
	//$clienteProv = $emp->get_cliente_prov();
	//$reportGlobal = $emp->get_report_historico();
?>

<div class="card text-white bg-primary mb-3" style="max-width: 64rem;">
	<div class="card-header">Descripcion</div>
		<div class="card-body">
		<h5 class="card-title">Reporte Producto 1</h5>
		<div class="mt-5">
			<?php foreach ($productoEstrategico as $itmPrfo):?>	
				<p><strong>Nombre: </strong><em><?= $itmPrfo["nombre"]?></em></p>
				<p><strong>Descripcion: </strong><em><?= $itmPrfo["descripcions"]?></em></p>
				<p><strong>Tipo: </strong><em><?= $itmPrfo["tipo_prod"]?></em></p>
				<p><strong>Reorden: </strong><em><?= $itmPrfo["reorden"]?></em></p>
				<p><strong>Cant_min: </strong><em><?= $itmPrfo["cant_min"]?></em></p>
				<p><strong>Ganancia: </strong><em><?= $itmPrfo["ganancia"]?></em></p>
				<p><strong>Cantidad: </strong><em><?= $itmPrfo["cantidad_vd"]?></em></p>
				<p><strong>Precio venta: </strong><em><?= $itmPrfo["precio_vt"]?></em></p>
				<p><strong>Inversion: </strong><em><?= $itmPrfo["inversion"]?></em></p>
				<p><strong>Cantidad cp: </strong><em><?= $itmPrfo["cantidad_cp"]?></em></p>
				<p><strong>Precion cp: </strong><em><?= $itmPrfo["precio_cp"]?></em></p>
			<?php endforeach;?>
		</div>
				
		</div>
	</div>