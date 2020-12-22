<?php $session = 0;?>
<div class="container">
	<div class="row">
			<div class="card text-white bg-primary mb-3" style="width: 100%;">
				<div class="card-body">
					<h5 class="card-title">Historial Productos <?php 
						if($session == 0){
							echo 'Operador';
						}else{
							echo 'Tactico';
						}
					?></h5>
					<p class="card-text">En esta sesion se mostraran los Productos.</p>
				</div>
			</div>
	</div>
	<div class="row">
		<?php
			if($session == 0){
				include 'Operador/tablaProducto.php';
			}else{
				include 'Tactico/tablaTactico.php';
			}
		?>
	</div>
</div>