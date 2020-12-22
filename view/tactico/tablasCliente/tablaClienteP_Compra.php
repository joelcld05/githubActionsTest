<?php 
	require '../../../controller/tactico_controller.php';

	$emp = new tacticoControll();
	$clienteVenta = $emp->get_Clientes_venta();
	//$clienteProv = $emp->get_cliente_prov();
	//$reportGlobal = $emp->get_report_historico();
?>

<div class="card w-100 mt-3">
  <div class="card-body">
	<h5 class="card-title">Reporte de productos comprado por cliente</h5>
	<table id="table_id_CPC" class="display">
		<thead>
			<tr>
			<th scope="col">Cliente</th>
			<th scope="col">Descripcion</th>
			<th scope="col">Cantidad</th>
      <th scope="col">Costo</th>
			<th scope="col">Accion</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($clienteVenta as $itmPrfo):?>
			<tr>
				<th><?= $itmPrfo["sucursal"]?></th>
				<td><?= $itmPrfo["producto"]?></td>
        <td><?= $itmPrfo["cantidad"]?></td>
				<td><?= $itmPrfo["precio total"]?></td>
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
	<h5 class="card-title">Grafico de cliente por producto</h5>
	<div class="input-group w-100 card-subtitle mt-4 mb-5">
		<button class="btn btn-primary mt-4" type="button" onclick="miFuncion();" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			Ver grafico
		</button>
	</div>
	<div class="collapse" id="collapseExample">
			<div class="card card-body">
				<canvas id="myChart" width="400" height="400"></canvas>
			</div>
		</div>
  </div>
</div>
<script type="text/javascript">
        var ctx= document.getElementById("myChart").getContext("2d");
        var myChart= new Chart(ctx,{
            type:"bar",
            data:{
                labels:["Hola1","Hola1","Hola1"],
                datasets:[{
                        label:'Num ventas',
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
			<?php foreach ($clienteVenta as $itmPrfo):?>
				datoss.push('<?= $itmPrfo["sucursal"];?>');
			<?php endforeach;?>
			<?php foreach ($clienteVenta as $itmPrfo):?>
				cantidad.push('<?= $itmPrfo["cantidad"];?>');
			<?php endforeach;?>
			myChart.data.datasets[0].data = cantidad;
			myChart.data.labels = datoss;
			myChart.update();
		}
    </script>
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