<?php 
	require '../../controller/tactico_controller.php';

	$emp = new tacticoControll();
	$productos = $emp->get_ProductTOtalHistorico();
?>
<div class="card w-100 mt-3">
  <div class="card-body">
	<h5 class="card-title">Historial de Productos</h5>
	
	<table id="table_id" class="display">
		<thead>
			<tr>
			<th scope="col">Nombre</th>
			<th scope="col">Descripcion</th>
			<th scope="col">tipo</th>
			<th scope="col">cant_min</th>
			<th scope="col">inversion</th>
			<th scope="col">cant_cp</th>
			<th scope="col">Precio</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($productos as $itmPrfo):?>
			<tr>
				<th><?= $itmPrfo["nombre"]?></th>
				<td><?= $itmPrfo["descripcions"]?></td>
				<td><?= $itmPrfo["tipo_prod"]?></td>
				<td><?= $itmPrfo["cant_min"]?></td>
				<td><?= $itmPrfo["inversion"]?></td>
				<td><?= $itmPrfo["cantidad_cp"]?></td>
				<td><?= $itmPrfo["precio_vt"]?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
</table>
  </div>
</div>
<div class="card w-100 mt-3 ">
  <div class="card-body">
	<h5 class="card-title">Grafico de ganancia globales</h5>
	<div class="input-group w-100 card-subtitle mt-4 mb-5">
		<button class="btn btn-primary mt-4" type="button" onclick="miFuncionaa();" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			Ver grafico
		</button>
	</div>
	<div class="collapse" id="collapseExample">
			<div class="card card-body">
				<canvas id="graficTPT" width="400" height="400"></canvas>
			</div>
		</div>
  </div>
</div>
<script>
        var ctx= document.getElementById("graficTPT").getContext("2d");
        var graficTPT= new Chart(ctx,{
            type:"bar",
            data:{
                labels:["Hola1","Hola1","Hola1"],
                datasets:[{
                        label:'Num datos',
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

		function miFuncionaa(){
			const datoss = [];
			const cantidad = [];
			<?php foreach ($productos as $itmPrfo):?>
				datoss.push('<?= $itmPrfo["nombre"].'-'.$itmPrfo["descripcions"];?>');
			<?php endforeach;?>
			<?php foreach ($productos as $itmPrfo):?>
				cantidad.push('<?= $itmPrfo["inversion"];?>');
			<?php endforeach;?>
			graficTPT.data.datasets[0].data = cantidad;
			graficTPT.data.labels = datoss;
			graficTPT.update();
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

$("#tipoProductos").bind("change keyup", function(event){
	tabla.search( this.value ).draw();
});

</script>
