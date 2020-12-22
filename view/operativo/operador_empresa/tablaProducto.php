<?php 
	require '../../../controller/opr_EMP_controller.php';

	$emp = new opr_EMP();
	$productos = $emp->get_productos();
	$type_Products = $emp->get_Type_product();
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
	<div class="input-group w-50 card-subtitle mt-4 mb-5">
		<select class="custom-select" id="tipoProductos" onchange="ShowSelected();">
		<?php foreach ($type_Products as $itmPrfo):?>
				<option value="<?= $itmPrfo["tipo_prod"]?>"> <?= $itmPrfo["tipo_prod"]?></option>
			<?php endforeach;?>
		</select>
		<div class="input-group-append">
			<label class="input-group-text" for="tipoProductos">Filtro</label>
		</div>
	</div>
	<table id="table_id" class="display">
		<thead>
			<tr>
			<th scope="col">ID</th>
			<th scope="col">Nombre</th>
			<th scope="col">Descripcion</th>
			<th scope="col">tipo</th>
			<th scope="col">Stock</th>
			<th scope="col">Precio CP.</th>
			<th scope="col">Precio VT.</th>
			<th scope="col">Reorden</th>
			<th scope="col">Accion</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($productos as $itmPrfo):?>
			<tr>
				<th><?= $itmPrfo["ID"]?></th>
				<th><?= $itmPrfo["nombre"]?></th>
				<td><?= $itmPrfo["descripcion"]?></td>
				<td><?= $itmPrfo["tipo"]?></td>
				<td><?= $itmPrfo["cantidad"]?></td>
				<td><?= $itmPrfo["precio_cp"]?></td>
				<td><?= $itmPrfo["precio_vt"]?></td>
				<td>
					<?php if($itmPrfo["reorden"] == 1){?>
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reorden<?= $itmPrfo["ID"]?>">Agregar</button>
					<?php }?>
				</td>
				<td>
				<a href="#mirar<?= $itmPrfo["ID"]?>"data-toggle="modal" data-target="#mirar<?= $itmPrfo["ID"]?>"><i class="fas fa-eye"></i></a>
				<a href=""><i class="far fa-edit"></i></a> 
				<a href="#del<?= $itmPrfo["ID"]?>" data-toggle="modal" data-target="#del<?= $itmPrfo["ID"]?>"><i class="far fa-trash-alt"></i></a></td>
			</tr>

					<!-- MODAL EDITAR -->
				  	<div class="modal fade" id="reorden<?= $itmPrfo["ID"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><?= $itmPrfo["nombre"]?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							</div>
							<div class="modal-body">
							<form id="RED<?= $itmPrfo["ID"]?>" action="../router/post_EMP_red_venta.php" method="post">
								<div class="form-group">
								<label for="formGroupExampleInput">Cantidad</label>
								<input form="RED<?= $itmPrfo["ID"]?>" name="id_gp" type="hidden" value="<?= $itmPrfo["ID"]?>">
								<input form="RED<?= $itmPrfo["ID"]?>" name="cant" type="text" class="form-control" id="formGroupExampleInput" placeholder="Cantidad De Pedido" value="<?= $itmPrfo["ID"]?>">
								</div>
							</form>
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							<button type="submit"class="btn btn-primary" form="RED<?= $itmPrfo["ID"]?>" >Actualizar</button>
							</div>
						</div>
						</div>
					</div>

					<!-- MODAL VISUALIZAR PRODUCTO -->
					<div class="modal fade" id="mirar<?= $itmPrfo["ID"]?>" tabindex="-1" role="dialog" aria-labelledby="mirar" aria-hidden="true">
						<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title" id="mirar"><?= $itmPrfo["nombre"]?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							</div>
							<div class="modal-body w-100">
								<div class="col-sm coll">
		
									<img src="<?= $itmPrfo["Imagen"]?>" class="imaPr" alt="">
								</div>
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-4 col-form-label">Nombre:</label>
									<div class="col-sm-4 ">
									<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $itmPrfo["nombre"]?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-4 col-form-label">Descripcion:</label>
									<div class="col-sm-4 ">
									<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $itmPrfo["descripcion"]?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label">Tipo:</label>
									<div class="col">
									<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $itmPrfo["tipo"]?>">
									</div>
								</div>
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
						</div>
					</div>

					<!-- MODAL ELIMINAR -->
					<div class="modal fade" id="del<?= $itmPrfo["ID"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="hh2 modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Eliminara PRODUCTO Definitivamente <?= $itmPrfo["nombre"]?>?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<form id="DEL<?= $itmPrfo["ID"]?>" action="../router/post_EMP_del_product.php" method="post">
							<input form="DEL<?= $itmPrfo["ID"]?>" name="id_pd" type="hidden" value="<?= $itmPrfo["ID"]?>">
						</form>
						<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
						<button type="submit" class="btn btn-warning" form="DEL<?= $itmPrfo["ID"]?>">Si</button>
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
				<!-- FIN MODAL -->
			<?php endforeach;?>
			
		</tbody>
</table>
  </div>
</div>

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

<style type="text/css">
	.imaPr{
		width: auto;
		height: 50vh;
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
	}
	.coll{
		
	display: flex;
	justify-content: center;
	align-items: center;
	}
</style>