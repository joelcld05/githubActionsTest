<?php 
	require '../../../controller/opr_EMP_controller.php';

	$emp = new opr_EMP();
	$productos = $emp->get_ventas();
?>
<style>
.modal-dialog {
 width: 360px;
}

.modal-header {
  background-color: #2c3a4b;
  /* padding:16px 16px; */
  color:#FFF;
  border-bottom:15px groove #1c78e4;
}

.hh2  {
  background-color: #FF1616;
  /* padding:16px 16px; */
  color:#FFF;
  border-bottom:15px groove #FF6666;
}
</style>
<div class="card w-100 mt-3">
  <div class="card-body">
	<h5 class="card-title">Historial de Productos</h5>
	<table id="table_id" class="display">
		<thead>
			<tr>
			<th scope="col">Codigo</th>
			<th scope="col">Nombre Pro.</th>
			<th scope="col">Nombre Emp.</th>
			<th scope="col">Ubicacion</th>
			<th scope="col">Pedido</th>
			<th scope="col">Total</th>
      <th scope="col">Accion</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($productos as $itmPrfo):?>
			<tr>
				<th><?= $itmPrfo["codigo"]?></th>
				<td><?= $itmPrfo["nombre"]?></td>
				<td><?= $itmPrfo["empresa"]?></td>
				<td><?= $itmPrfo["ubicacion"]?></td>
				<td><?= $itmPrfo["pedido"]?></td>
				<td><?= $itmPrfo["total"]?></td>
        <td>
				<a href="#exampleModal<?= $itmPrfo["codigo"]?>" data-toggle="modal" data-target="#exampleModal<?= $itmPrfo["codigo"]?>"><i class="far fa-edit"></i></a> 
				<a href="#delete<?= $itmPrfo["codigo"]?>" data-toggle="modal" data-target="#delete<?= $itmPrfo["codigo"]?>"> <i class="far fa-trash-alt"></i></a></td>
			</tr>
      <!-- MODAL EDITAR -->
      <div class="modal fade" id="exampleModal<?= $itmPrfo["codigo"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?= $itmPrfo["nombre"]?>?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="EDIT_FRM<?= $itmPrfo["codigo"]?>" action="../router/post_EMP_upt_venta.php" method="post">
                <div class="form-group">
                  <label for="formGroupExampleInput">Cantidad</label>
                  <input form="EDIT_FRM<?= $itmPrfo["codigo"]?>" name="id_vt" type="hidden" value="<?= $itmPrfo["codigo"]?>">
                  <input form="EDIT_FRM<?= $itmPrfo["codigo"]?>" name="cant" type="text" class="form-control" id="formGroupExampleInput" placeholder="Cantidad De Pedido" value="<?= $itmPrfo["pedido"]?>">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit"class="btn btn-primary" form="EDIT_FRM<?= $itmPrfo["codigo"]?>" >Actualizar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- FIN MODAL -->


      <!-- MODAL ELIMINAR -->
      <div class="modal fade" id="delete<?= $itmPrfo["codigo"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="hh2 modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Eliminara Venta <?= $itmPrfo["nombre"]?>?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="DEL<?= $itmPrfo["codigo"]?>" action="../router/post_EMP_del_venta.php" method="post">
                  <input form="DEL<?= $itmPrfo["codigo"]?>" name="id_vt" type="hidden" value="<?= $itmPrfo["codigo"]?>">
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              <button type="submit" class="btn btn-warning" form="DEL<?= $itmPrfo["codigo"]?>">Si</button>
            </div>
          </div>
        </div>
      </div>
      <!-- FIN MODAL -->


      <script>
        $('#myModal').on('shown.bs.modal', function () {
          $('#myInput').trigger('focus')
        })
      </script>
      
			<?php endforeach;?>
		</tbody>
	</table>
  </div>
</div>

<script>
        var ctx= document.getElementById("myChart").getContext("2d");
        var myChart= new Chart(ctx,{
            type:"doughnut",
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

		document.getElementById("tipoProductos").onchange = function(e){
			const datoss = [];
			<?php foreach ($type_Products as $itmPrfo):?>
				datoss.push('<?= $itmPrfo["tipo_prod"];?>');
			<?php endforeach;?>
			myChart.data.labels = datoss;
			myChart.update();
		};
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pedido Sodas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>