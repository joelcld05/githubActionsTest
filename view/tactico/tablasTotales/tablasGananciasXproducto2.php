<?php 
	require '../../../controller/tactico_controller.php';

	$emp = new tacticoControll();
	//$clienteVenta = $emp->get_Clientes_venta();
	//$clienteProv = $emp->get_cliente_prov();
	$reporteGxProductoG = $emp->get_report_GananciaXproductoG();
?>

<div class="card w-100 mt-3">
  <div class="card-body">
	<h5 class="card-title">Reporte de Ganancias por Producto</h5>
	<table id="table_id_GG" class="display">
		<thead>
			<tr>
			<th scope="col">Nombre</th>
			<th scope="col">Descripcion</th>
			<th scope="col">Stock</th>
			<th scope="col">Inversion</th>
			<th scope="col">Vendida</th>
			<th scope="col">Ganancia</th>
			<th scope="col">Ganancia Total</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($reporteGxProductoG as $itmPrfo):?>
			<tr>
				<th><?= $itmPrfo["nombre"]?></th>
				<td><?= $itmPrfo["descripcion"]?></td>
				<th><?= $itmPrfo["stock"]?></th>
				<td><?= $itmPrfo["inversion"]?></td>
				<th><?= $itmPrfo["vendida"]?></th>
				<td><?= $itmPrfo["ganancia"]?></td>
				<th><?= $itmPrfo["gananciatot"]?></th>
			</tr>
			<?php endforeach;?>
		</tbody>
</table>
  </div>
</div>
<div class="card w-100 mt-3 ">
  <div class="card-body">
	<h5 class="card-title">Grafico de Ganancia por Producto</h5>
	<div class="input-group w-100 card-subtitle mt-4 mb-5">
		<button class="btn btn-primary mt-4" type="button" onclick="miFuncion();" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			Ver grafico
		</button>
	</div>
	<div class="collapse" id="collapseExample">
			<div class="card card-body">
				<canvas id="GraficoPG" width="400" height="400"></canvas>
			</div>
		</div>
  </div>
</div>
<script type="text/javascript">
        var ctx= document.getElementById("GraficoPG").getContext("2d");
        var GraficoPG= new Chart(ctx,{
            type:"bar",
            data:{
                labels:["Hola1","Hola1","Hola1"],
                datasets:[{
                        label:'Num ganancias',
                        data:[10,9,15],
                        backgroundColor:[
                            'rgb(66, 134, 244,0.5)',
                            'rgb(74, 135, 72,0.5)',
                            'rgb(229, 89, 50,0.5)'
                        ]
                }]
            },
            options:{
                scales:{
                    yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                    }]
                }
            }
        });

		function miFuncion(){
			const datoss = [];
			const cantidad = [];
			<?php foreach ($reporteGxProductoG as $itmPrfo):?>
				datoss.push('<?= $itmPrfo["nombre"].'-'.$itmPrfo["descripcion"];?>');
			<?php endforeach;?>
			<?php foreach ($reporteGxProductoG as $itmPrfo):?>
				cantidad.push('<?= $itmPrfo["ganancia"];?>');
			<?php endforeach;?>
			GraficoPG.data.datasets[0].data = cantidad;
			GraficoPG.data.labels = datoss;
			GraficoPG.update();
		}
    </script>
<script type="text/javascript">
var tabla;
	$(document).ready( function () {
		tabla = $('#table_id_GG').DataTable({
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