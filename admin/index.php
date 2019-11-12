<?php 

require "assets/config/ConexionBaseDatos_PDO.php";
require "assets/config/seguridad.php";

extract($_REQUEST);
extract($_POST);

$conexion=conectaDb();

$sql_user = $conexion->prepare("SELECT * from usuarios where id_usuario = :id");
$sql_user->bindParam(":id", $_SESSION['n-user']);
$sql_user->execute();

foreach ($sql_user->fetchAll() as $row) {
  $nombre_usuario = $row['nombre_usuario'];
}

?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Editorial Usco</title>
    <link rel="icon" type="image/png" href="../img/uscoicon.png">
    <!-- Icons-->
    <link href="assets/css/coreui-icons.min.css" rel="stylesheet">
    <link href="assets/css/flag-icon.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <img class="navbar-brand-full" src="../img/usco.png" width="89" height="25" alt="logo usco">
        <img class="navbar-brand-minimized" src="../img/usco.png" width="30" height="30" alt="logo usco">
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
          <a class="nav-link" href="index.php">Inicio</a>
        </li>
        
        <li class="nav-item px-3">
          <a class="nav-link" href="agregar_producto/">Agregar Producto</a>
        </li>
        
      </ul>
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="index.php" role="button" aria-haspopup="true" aria-expanded="false">
            <img class="img-avatar" src="assets/img/avatars/face-0.jpg" alt="Usuario">
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong><i class="fa fa-user"></i> Usuario</strong>
            </div>
            <a class="dropdown-item text-center" href="index.php"><?php echo $nombre_usuario; ?></a>
            <div class="dropdown-header text-center">
              <strong><i class="fa fa-users-cog"></i> Configuraciones</strong>
            </div>
            <a class="dropdown-item" href="#">
              <i class="fa fa-key"></i> Cambiar contraseña
            </a>           
                <a class="dropdown-item" href="#">
                  <i class="fa fa-users"></i> Agregar usuarios</a>
                <a class="dropdown-item" href="#">
                  <i class="fa fa-unlock-alt"></i> Administrador
                </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="assets/validaciones/cerrar_session.php">
              <i class="fa fa-sign-out-alt"></i> Salir</a>
          </div>
        </li>
      </ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <i class="nav-icon icon-home"></i> Administrador
              </a>
            </li>
            <br>

            <li class="nav-item">
              <a class="nav-link" href="agregar_producto/">
                <i class="nav-icon icon-plus"></i> Agregar Producto
              </a>
            </li>
            
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Inicio</li>
          <li class="breadcrumb-menu d-md-down-none">
            <div class="reloj"><?php echo date("d / m / y  | ");?>
                <span id="pHoras"></span><span> : </span>
                <span id="pMinutos"></span><span> : </span>
                <span id="pSegundos"></span>
            </div>
          </li>
          <!-- Breadcrumb Menu-->
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h1>Bienvenido <?php echo $nombre_usuario; ?></h1>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </main>
    </div>
    <footer class="app-footer">
      <div>
        <a href="https://www.usco.edu.co/es/">Universidad Surcolombiana</a>
        <span>&copy; 2019.</span>
      </div>
    </footer>
    <!-- CoreUI and necessary plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/pace.min.js"></script>
    <script src="assets/js/perfect-scrollbar.min.js"></script>
    <script src="assets/js/coreui.min.js"></script>
    <script type="text/javascript" src="assets/js/mainAd.js"></script>
    
  </body>
</html>