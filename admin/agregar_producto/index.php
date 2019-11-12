<?php 

require "../assets/config/ConexionBaseDatos_PDO.php";
require "../assets/config/seguridad.php";
extract($_REQUEST);
extract($_POST);

if (!isset($_REQUEST['p'])) {
  header("location:index.php?p=1");
}

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
    <title>Agregar Producto - Editorial Usco</title>
    <link rel="icon" type="image/png" href="../../img/uscoicon.png">
    <!-- Icons-->
    <link href="../assets/css/coreui-icons.min.css" rel="stylesheet">
    <link href="../assets/css/flag-icon.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
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
        <img class="navbar-brand-full" src="../../img/usco.png" width="89" height="25" alt="logo usco">
        <img class="navbar-brand-minimized" src="../../img/usco.png" width="30" height="30" alt="logo usco">
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
          <a class="nav-link" href="../index.php">Inicio</a>
        </li>
        
          <li class="nav-item px-3">
            <a class="nav-link" href="index.php?=1">Agregar Producto</a>
          </li>
          
      </ul>
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="index.php" role="button" aria-haspopup="true" aria-expanded="false">
            <img class="img-avatar" src="../assets/img/avatars/face-0.jpg" alt="Usuario">
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
            <a class="dropdown-item" href="../assets/validaciones/cerrar_session.php">
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
              <a class="nav-link active" href="../">
                <i class="nav-icon icon-home"></i> Administrador
              </a>
            </li>
            <br>
          
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="nav-icon icon-list"></i> Lista de productos
              </a>
            </li>
          
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../"> Inicio</a></li>
          <li class="breadcrumb-item active">Agregar producto</li>
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
            

            <!-- CONTENT PAGE -->
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <i class="fa fa-align-justify"></i> Agregar producto
                    
                  </div>
                  <div class="card-body">
                    <div class="row">

                      <div class="col-md-10 offset-md-1">
                        <span class="anchor" id="formComplex"></span>
                        
                        <h3 class="mt-5">Agregar producto </h3>
                        <hr class="mb-3">
                        <!-- form complex example -->
                        <form method="POST" name="agg_producto" id="agg_producto" action="validaciones/agregar-img.php" enctype="multipart/form-data">
                          <div class="form-row mt-4">
                              <div class="col-sm-5 pb-3">
                                  <label for="nombre_producto">Nombre</label>
                                  <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" placeholder="Nombre del producto">
                              </div>
                              <div class="col-sm-4 pb-3">
                                  <label for="autor_producto">Autor</label>
                                  <input type="text" class="form-control" id="autor_producto" name="autor_producto" placeholder="Escriba el autor">
                              </div>
                              <div class="col-sm-3 pb-3">
                                  <label for="precio_producto">Precio</label>
                                  <div class="input-group">
                                      <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                      <input type="text" class="form-control" id="precio_producto" name="precio_producto" placeholder="Escriba el precio">
                                  </div>
                              </div>
                              
                              <div class="col-sm-3 pb-3">
                                  <label for="editorial_producto">Editorial</label>
                                  <input type="text" class="form-control" id="editorial_producto" name="editorial_producto" placeholder="Escriba la editorial">
                              </div>
                              <div class="col-sm-3 pb-3">
                                  <label for="edicion_producto">Edicion</label>
                                  <input type="text" class="form-control" id="edicion_producto" name="edicion_producto" placeholder="Escriba la edicion">
                              </div>
                              <div class="col-sm-3 pb-3">
                                  <label for="formato_producto">Formato</label>
                                  <input type="text" class="form-control" id="formato_producto" name="formato_producto" placeholder="Escriba el formato">
                              </div>
                              <div class="col-sm-3 pb-3">
                                  <label for="ISBN_producto">ISBN</label>
                                  <input type="text" class="form-control" id="ISBN_producto" name="ISBN_producto" placeholder="Escriba el ISBN">
                              </div>
                              <div class="col-sm-3 pb-3">
                                  <label for="id_categoria_fk">Categoria</label>
                                  <select class="form-control" id="id_categoria_fk" name="id_categoria_fk">
                                      <option>Categoria 1</option>
                                      <option>Categoria 2</option>
                                      <option>Categoria 3</option>
                                      <option>Categoria 4</option>
                                  </select>
                              </div>
                              <div class="col-sm-3 pb-3">
                                  <label for="facultad">Facultad</label>
                                  <input type="text" class="form-control" id="facultad" name="facultad" placeholder="Escriba la facultad">
                              </div>
                              <div class="col-sm-2 pb-3">
                                  <label for="idioma">Idioma</label>
                                  <input type="text" class="form-control" id="idioma" name="idioma" placeholder="Escriba el idioma">
                              </div>
                              <div class="col-sm-2 pb-3">
                                  <label for="n_paginas">No. paginas</label>
                                  <input type="text" class="form-control" id="n_paginas" name="n_paginas" placeholder="250">
                              </div>
                              <div class="col-sm-2 pb-3">
                                  <label for="alto_ancho">Alto y ancho</label>
                                  <input type="text" class="form-control" id="alto_ancho" name="alto_ancho" placeholder="100 X 100">
                              </div>

                              
                              <div class="col-md-12 pb-3">
                                  <label for="descripcion_producto">Descripcion</label>
                                  <textarea class="form-control" rows="5" id="descripcion_producto" name="descripcion_producto" placeholder="Escriba la descripcion del producto"></textarea>
                              </div>

                              <div class="col-md-9 pb-3">
                                <label for="imagen">Imagen</label>
                                <div class="custom-file">
                                  <!-- <label for="imagen">Imagen</label> -->
                                  <input type="file" class="custom-file-input" id="imagen" name="imagen" lang="es">
                                  <label class="custom-file-label" for="customFileLang">Seleccionar imagen</label>
                                </div>
                              </div>

                              <div class="col-sm-3 pb-3">
                                  <label for="terminado">Terminado</label>
                                  <input type="text" class="form-control" id="terminado" name="terminado" placeholder="Ejemplo: Tapa Rustica">
                              </div>
                              
                              <div class="row col-sm-12 justify-content-center">
                                <input type="submit" class="btn btn-u btn-lg mt-3 mb-5">
                              </div>

                          </div>
                        </form>

                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
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
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/pace.min.js"></script>
    <script src="../assets/js/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/coreui.min.js"></script>
    <script type="text/javascript" src="validaciones/js/agregar_producto.js"></script>
    <script type="text/javascript" src="../assets/js/mainAd.js"></script>
    
  </body>
</html>