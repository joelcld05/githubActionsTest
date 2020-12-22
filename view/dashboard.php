<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Houseki | Dashboard</title>
  
  <link rel="stylesheet" href="../public/css/styleCliente.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/layout/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../public/layout/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../public/layout/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../public/layout/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/layout/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../public/layout/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../public/layout/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../public/layout/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">





<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!--
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" id="myInput" type="search" placeholder="Buscar" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
			<i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><h6 style = "font-weight: bold;"><?php echo $_SESSION['usuario'];?></h6></span>
          <div class="dropdown-divider" ></div>
          <a  onclick="cargar_contenido('contenido_principal','profile/perfil.php')" class="dropdown-item">
		        <i class="far fa-address-card"></i> Perfil
          </a>
		  <div class="dropdown-divider"></div>
		  <form action="logout.php">
				<button class="dropdown-item dropdown-footer" type="submit"><h6 style = "font-weight: bold;">Cerrar Sesion</h6></button>
		  </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../public/layout/dist/img/favicon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Houseki</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="../view/dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
              </p>
            </a>
		  </li>
		  <?php
		  	if($_SESSION['rol'] == 'Operativo Cliente'):
		  ?>
	  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
				<i class="fas fa-wine-bottle nav-icon"></i>
              <p>
                Operador Cliente
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" >
                <a onclick="cargar_contenido('contenido_principal','operativo/operador_cliente/crearPedidos.php')" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Realizar Pedido</p>
                </a>
              </li>
              <li class="nav-item">
                <a onclick="cargar_contenido('contenido_principal','operativo/operador_cliente/tablaPedidosCLI.php')" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Historial Pedido</p>
                </a>
			        </li>
            </ul>
			  </li>
			  <?php endif;?>
			<?php
		  	if($_SESSION['rol'] == 'Operativo Empresa'):
		  ?>	
		<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
				<i class="fas fa-wine-bottle nav-icon"></i>
              <p>
                Operador Empresa
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a onclick="cargar_contenido('contenido_principal','operativo/operador_empresa/tablaProducto.php')" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
              <li class="nav-item" >
                <a onclick="cargar_contenido('contenido_principal','operativo/operador_empresa/agregarProductos.php')" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a onclick="cargar_contenido('contenido_principal','operativo/operador_empresa/tablaPedidosEMP.php')" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Historial Pedidos</p>
                </a>
			        </li>
			        
            </ul>
	  </li>
			  <?php endif;?>

	  	<?php
		  	if($_SESSION['rol'] == 'Reporte'):
		  ?>
      <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
				<i class="fas fa-wine-bottle nav-icon"></i>
              <p>
                Tactico
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" >
                <a onclick="cargar_contenido('contenido_principal','tactico/tablaProductoTactico.php')" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reporte Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a onclick="cargar_contenido('contenido_principal','tactico/tablaClienteTactico.php')" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reporte Clientes</p>
                </a>
			        </li>
              <li class="nav-item">
                <a onclick="cargar_contenido('contenido_principal','tactico/ReportesTotales.php')" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reporte Totales</p>
                </a>
			        </li>
            </ul>
	  </li>
			  <?php endif;?>
	  <?php
		  	if($_SESSION['rol'] == 'Estrategico'):
		  ?>
      <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
				<i class="fas fa-wine-bottle nav-icon"></i>
              <p>
                Estrategico
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" >
                <a onclick="cargar_contenido('contenido_principal','estrategico/estrategicoHistorialProducto.php')" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a onclick="cargar_contenido('contenido_principal','estrategico/compararProductos.php')" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Comparar Productos</p>
                </a>
			        </li>
            </ul>
	  </li>
			  <?php endif;?>
        
	    <?php
		  	if($_SESSION['rol'] == 'Administrador'):
		  ?>
      
      <?php if (isset($_SESSION['CRUD']) && $_SESSION['CRUD'] != ""):?>
    <script>
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: '<?php echo $_SESSION['CRUD']?>',
      showConfirmButton: false,
      timer: 1500
    })
    </script>
<?php echo ""; endif ?>
      
      <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
				<i class="fas fa-wine-bottle nav-icon"></i>
              <p>
                Administrador 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" >
                <a onclick="cargar_contenido('contenido_principal','admin/crearCliente.php')" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar Usuario</p>
                </a>
              </li>
              <li class="nav-item">
                <a onclick="cargar_contenido('contenido_principal','admin/historialClientes.php')" class="nav-link" style="cursor: pointer;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuarios Registrados</p>
                </a>
			        </li>
            </ul>
	  </li>
			  <?php endif;?>
   
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Main content -->
		<div class="container">
			<div class="row m-3 " id="contenido_principal">
			<div class="card text-white bg-primary mb-3  w-100">
				<div class="card-header"><h5 style = "font-weight: bold;">Bienvenido al sistema automatizado Houseki</h5></div>
					<div class="card-body" style="background-color: rgb(52,58,64)">
						<p class="card-text">Puedes seleccionar la opcion que necesites verificar en la parte izquierda de tu pantalla</p>
					</div>
				</div>
				<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
						<img src="../public/img/fondo.jpg" class="d-block w-100"  alt="First slide">
						</div>
						<div class="carousel-item">
						<img src="../public/img/fondo2.jpg" class="d-block w-100"  alt="First slide">
						</div>
						<div class="carousel-item">
						<img src="../public/img/fondo3.jpg" class="d-block w-100"  alt="First slide">
						</div>
					</div>
				</div>
				

			</div>
		</div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="">Houseki</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<script src="../public/layout/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../public/layout/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	function cargar_contenido(Contenedor,contenido){
		$("#"+Contenedor).load(contenido);
	}

  $.widget.bridge('uibutton', $.ui.button)
</script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<!-- Bootstrap 4 -->
<script src="../public/layout/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../public/layout/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../public/layout/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../public/layout/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../public/layout/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../public/layout/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../public/layout/plugins/moment/moment.min.js"></script>
<script src="../public/layout/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../public/layout/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../public/layout/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../public/layout/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../public/layout/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../public/layout/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../public/layout/dist/js/demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</body>
</html>
