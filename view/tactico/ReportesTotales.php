<div class="card w-100 mt-3">
  <div class="card-body">
	<h5 class="card-title">Sesion para reporte totales</h5>
	<div class="input-group w-100 card-subtitle mt-4 mb-5">

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a style="cursor: pointer;" class="nav-link active" id="home-tab" data-toggle="tab" onclick="cargar_contenidG('contenido_principalG','tactico/tablasTotales/tablaGananciaGlobales.php')" role="tab" aria-controls="home" aria-selected="true">Ganancias/Perdida Global</a>
		</li>
		<li class="nav-item" role="presentation">
			<a style="cursor: pointer;" class="nav-link " id="profile-tab" data-toggle="tab" onclick="cargar_contenidG('contenido_principalG','tactico/tablasTotales/tablasGananciasXproducto2.php')" role="tab" aria-controls="profile" aria-selected="false">Ganancias/Perdida Producto</a>
		</li>
	</ul>
		
	</div>

	<div class="">
	<!-- Main content -->
		<div class="container">
			<div class="row" id="contenido_principalG">
			<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
				<div class="card-header">Contenido Principa;</div>
					<div class="card-body">
						<h5 class="card-title">Reportes</h5>
						<p class="card-text">En esta sesion podra ver los reportes sobre Ganancias y perdidas</p>
					</div>
				</div>
			</div>
		</div>
    <!-- /.content -->
  </div>
  </div>
</div>

<script>
	function cargar_contenidG(Contenedor,contenido){
		$("#"+Contenedor).load(contenido);
	}

  $.widget.bridge('uibutton', $.ui.button)
</script>