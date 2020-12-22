<?php 
	require '../../controller/estrategico_controller.php';

	$emp = new estrategicoControll();
	$productoEstrategico = $emp->get_inventario_producto();
	//$clienteProv = $emp->get_cliente_prov();
	//$reportGlobal = $emp->get_report_historico();
?>

<div class="card w-100 mt-3">
  <div class="card-body">
	<h5 class="card-title">Reporte de productos</h5>
	<table id="table_id_CPC" class="display">
		<thead>
			<tr>
			<th scope="col">Nombre</th>
			<th scope="col">Precio</th>
			<th scope="col">Stock</th>
			<th scope="col">descripcion</th>
			<th scope="col">tipo</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($productoEstrategico as $itmPrfo):?>
			<tr>
				<th><?= $itmPrfo["Nombre"]?></th>
				<td><?= $itmPrfo["Precio"]?></td>
				<td><?= $itmPrfo["Stock"]?></td>
				<td><?= $itmPrfo["Descripcion"]?></td>
				<td><?= $itmPrfo["Producto"]?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
</table>
  </div>
</div>
<script type="text/javascript">
var tabla;
	$(document).ready( function () {
		tabla = $('#table_id_CPC').DataTable({
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


</script>