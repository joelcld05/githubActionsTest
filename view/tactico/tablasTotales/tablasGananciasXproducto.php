<?php 
	require '../../../controller/tactico_controller.php';

	$emp = new tacticoControll();
	//$clienteVenta = $emp->get_Clientes_venta();
	//$clienteProv = $emp->get_cliente_prov();
	//$reportGlobal = $emp->get_report_GananciaGlobal();
	$reporteGxProductoG = $emp->get_report_GananciaXproductoG();
	$productosConcat = $emp->get_ProductosTipoConcat();
	echo "-------------------------------------->llegue aqui";
?>

<div class="card w-100 mt-3">
  <div class="card-body">
	<h5 class="card-title">Historial de Productos</h5>
	<div class="input-group w-50 card-subtitle mt-4 mb-5">
		
		<select class="custom-select" id="cantiProducto" onchange="ShowSelected();">
		<?php foreach ($productosConcat as $itmPrfo):?>
				<option value="<?= $itmPrfo["ID_inv"]?>"> <?= $itmPrfo["tipo-Producto"]?></option>
			<?php endforeach;?>
		</select>
		<div class="input-group-append">
			<label class="input-group-text" for="tipoProductos">Filtro</label>
		</div>
	</div>
	<table id="table_id" class="display">
		<thead>
			<tr>
			<th scope="col">nombre</th>
			<th scope="col">descripcion</th>
			<th scope="col">stock</th>
			<th scope="col">Vendida</th>
			<th scope="col">InventarioId</th>
			<th scope="col">fecha</th>
			<th scope="col">Accion</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($reporteGxProductoG as $itmPrfo):?>
			<tr>
				<th><?= $itmPrfo["nombre"]?></th>
				<th><?= $itmPrfo["descripcion"]?></th>
				<td><?= $itmPrfo["stock"]?></td>
				<td><?= $itmPrfo["Vendida"]?></td>
				<td><?= $itmPrfo["InventarioId"]?></td>
				<td><?= $itmPrfo["fecha"]?></td>
				
				<td>
				<a href=""><i class="far fa-edit"></i></a> 
				<a href=""><i class="far fa-trash-alt"></i></a></td>
			</tr>
			<?php endforeach;?>
		</tbody>
</table>
  </div>
</div>
<div class="card w-100 mt-3 ">
  <div class="card-body">
	<h5 class="card-title">Grafico de ganancia por producto</h5>
	<div class="input-group w-100 card-subtitle mt-4 mb-5">
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<a onclick="miFuncions();" class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Grafico</a>
			</li>
		</ul>
	</div>

	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		<div class="container">
			<div class="row" id="contenedo">
			<div class="card text-white bg-primary mb-3" style="max-width: 64rem;">
				<div class="card-header">Contenido Principa;</div>
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

<script type="text/javascript">        
		var datoID;
				function ShowSelected()
				{
					$('#my_tabs').tabs('load', 0);
				/* Para obtener el valor */
				var cod = document.getElementById("cantiProducto").value;
				datoID = cod
				alert(cod);
				
				/* Para obtener el texto */
				var combo = document.getElementById("cantiProducto");
				var selected = combo.options[combo.selectedIndex].text;
				alert(selected);
				}

		function miFuncions(){
			$(document).ready(function(){
					$("#contenedo").load("tactico/tablasTotales/tablasGananciasXproductos.php");
			});
			$(document).ready(function(){
					$("#contenedo").load("tactico/tablasTotales/graficoXproducto.php",{dato:datoID});
			});

			
		}
    </script>

<script type="text/javascript">
var tabla;
	$(document).ready( function () {
		tabla = $('#table_id').DataTable({
    "language": {
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "infoThousands": ",",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
    }
}
  });
} );
// #myInput is a <input type="text"> element<font></font>

$("#cantiProducto").bind("change keyup", function(event){
	tabla.search( this.value ).draw();
});

</script>