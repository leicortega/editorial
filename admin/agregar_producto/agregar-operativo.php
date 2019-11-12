<?php 
extract($_REQUEST);
extract($_POST);
require "../assets/config/ConexionBaseDatos_PDO.php";

require "../postulados/seg.php";
$objConexion=conectaDb();


?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="author" content="cootranshuila">
    <title>Cootranshuila</title>
    <link rel="icon" type="image/png" href="../assets/img/logo-icon.png">
    <!-- Icons-->
    <link href="../assets/css/coreui-icons.min.css" rel="stylesheet">
    <link href="../assets/css/flag-icon.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/toastr.min.css" rel="stylesheet">
    <link href="../assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
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
        <img class="navbar-brand-full" src="../assets/img/brand/logo.png" width="89" height="25" alt="logo cootranshuila">
        <img class="navbar-brand-minimized" src="../assets/img/brand/loog.png" width="30" height="30" alt="logo cootranshuila">
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
          <a class="nav-link" href="../index.php">inicio</a>
        </li>
        <?php if ($_SESSION['rol'] == 'PQR' or $_SESSION['rol'] == 'Todos'): ?>
          <li class="nav-item px-3">
            <a class="nav-link" href="pqrs/index.php">PQR's</a>
          </li>
        <?php endif ?>
        <?php if ($_SESSION['rol'] == 'Especial' or $_SESSION['rol'] == 'Todos'): ?>
          <li class="nav-item px-3">
            <a class="nav-link" href="#">Servicio especial</a>
          </li>
          <?php endif ?>
          <?php if ($_SESSION['rol'] == 'Modem y GPS' or $_SESSION['rol'] == 'Todos'): ?>
          <li class="nav-item px-3">
            <a class="nav-link" href="#">Modem y GPS</a>
          </li>
          <?php endif ?>
          <?php if ($_SESSION['rol'] == 'Sanciones' or $_SESSION['rol'] == 'Todos' or $_SESSION['rol'] == 'Operativos'): ?>
          <li class="nav-item px-3">
            <a class="nav-link" href="index.php">Sanciones</a>
          </li>
          <?php endif ?>
          <?php if ($_SESSION['rol'] == 'Postulados' or $_SESSION['rol'] == 'Todos'): ?>
          <li class="nav-item px-3">
            <a class="nav-link" href="postulados/index.php?cargo=conductor&estado=Postulado">Postulados</a>
          </li>
          <?php endif ?>
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
            <a class="dropdown-item text-center" href="index.php"><?php echo $_SESSION["user"]; ?></a>
            <div class="dropdown-header text-center">
              <strong><i class="fa fa-users-cog"></i> Configuraciones</strong>
            </div>
            <a class="dropdown-item" href="#">
              <i class="fa fa-key"></i> Cambiar contraseña
            </a>
              <?php if ($_SESSION['rol'] == 'Todos'): ?>                
                <a class="dropdown-item" href="#">
                  <i class="fa fa-users"></i> Agregar usuarios</a>
                <a class="dropdown-item" href="#">
                  <i class="fa fa-unlock-alt"></i> Administrador
                </a>
              <?php endif ?>
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
          <?php if ($_SESSION['rol'] == 'Sanciones' or $_SESSION['rol'] == 'Todos') { ?>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="nav-icon icon-clock"></i> Operativos en proceso
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="terminados.php">
                <i class="nav-icon icon-check"></i> Operativos terminados
              </a>
            </li>
          <?php } if ($_SESSION['rol'] == 'Operativos' or $_SESSION['rol'] == 'Sanciones' or $_SESSION['rol'] == 'Todos') { ?>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="nav-icon icon-plus"></i> Agregar Operativo
              </a>
            </li>
          <?php } ?>
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Inicio</li>
          <li class="breadcrumb-item">Sanciones</li>
          <li class="breadcrumb-item active">Agregar operativo</li>
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
                    <i class="fa fa-align-justify"></i> Agregar Operativo</div>
                  <div class="card-body">
                    <div class="row">
                      <div id="respuesta"></div>
                      <div id="agg_sanciones" class="container tab-pane"><br>
                        <form id="agregar-operativo" class="form-inline" method="post">
                          <table class="table table-bordered">
                            <thead>
                              <tr align="center">
                                <th colspan="4">FORMATO OPERATIVO DE CARRETERA</th>
                                <th colspan="1">
                                  <div class="form-group">
                                    <label for="num_operativo" class="col-md-2">No.</label>
                                    <input type="number" class="form-control-plaintext col-md-10" placeholder="Numero de operativo" name="num_operativo" id="num_operativo" required>
                                  </div>
                                </th>
                              </tr>
                            </thead>
                            <tbody>

                              <tr>
                                <td colspan="5">
                                  <div class="form-group">
                                    <label for="nom_conductor" class="col-md-3">Nombre del conductor </label>
                                    <input type="text" class="form-control-plaintext col-md-8" placeholder="Escriba el nombre" name="nom_conductor" id="nom_conductor" required>
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td colspan="1">
                                  <div class="form-group">
                                    <label for="fecha_operativo" class="col-md">Fecha </label>
                                    <input type="date" class="form-control-plaintext" placeholder="Ponga la fecha" name="fecha_operativo" id="fecha_operativo" required>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="form-group">
                                    <label for="hora_operativo" class="col-md">Hora </label>
                                    <input type="time" class="form-control-plaintext" name="hora_operativo" id="hora_operativo" required>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="form-group">
                                    <label for="placa_vehiculo" class="col-md">Placa </label>
                                    <input type="text" class="form-control-plaintext" placeholder="Placa del vehiculo" name="placa_vehiculo" id="placa_vehiculo" required>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="form-group">
                                    <label for="modalidad" class="col-md">Modalidad </label>
                                    <!-- <input type="text" class="form-control-plaintext" placeholder="Modalidad del vehiculo" name="modalidad" id="modalidad" required> -->
                                    <select name="modalidad" id="modalidad" class="form-control-plaintext" required>
                                      <option value="">Seleccione</option>
                                      <option value="Doble Yo">Doble Yo</option>
                                      <option value="VIP">VIP</option>
                                      <option value="Platino Expres">Platino Expres</option>
                                      <option value="Platino Jet">Platino Jet</option>
                                      <option value="Platino Especial">Platino Especial</option>
                                      <option value="Mixto">Mixto</option>
                                    </select>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="form-group">
                                    <label for="num_vehiculo" class="col-md">No. Vehiculo </label>
                                    <input type="number" class="form-control-plaintext" placeholder="Numero del vehiculo" name="num_vehiculo" id="num_vehiculo" required>
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td colspan="2">
                                  <div class="form-group">
                                    <label for="origen_ruta" class="col-md">Origen </label>
                                    <input type="text" class="form-control-plaintext" placeholder="Origen de ruta" name="origen_ruta" id="origen_ruta" required>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="form-group">
                                    <label for="hora_salida" class="col-md">Hora salida </label>
                                    <input type="time" class="form-control-plaintext" name="hora_salida" id="hora_salida">
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                    <label for="destino_ruta" class="col-md">Destino </label>
                                    <input type="text" class="form-control-plaintext" placeholder="Destino de ruta" name="destino_ruta" id="destino_ruta" required>
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td colspan="5">
                                  <div class="form-group">
                                    <label for="sitio_operativo" class="col-md-3">Sitio del operativo </label>
                                    <input type="text" class="form-control-plaintext col-md-8" placeholder="Escriba el sitio del operativo" name="sitio_operativo" id="sitio_operativo" required>
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td colspan="3">
                                  <div class="form-group">
                                    <label for="pasajeros_con_tiquete" class="col-md-4">Pasajeros con tiquete </label>
                                    <input type="number" class="form-control-plaintext col-md-8" placeholder="Escriba el numero de pasajeros" name="pasajeros_con_tiquete" id="pasajeros_con_tiquete" required>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                    <label for="pasajeros_sin_tiquete" class="col-md-5">Pasajeros sin tiquete </label>
                                    <input type="number" class="form-control-plaintext col-md-7" placeholder="Escriba el numero de pasajeros" name="pasajeros_sin_tiquete" id="pasajeros_sin_tiquete" required>
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td colspan="2">
                                  <div class="form-group">
                                    <label for="" class="col-md-10">Presentacion del conductor </label>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="rcBueno" name="rb-pconductor" value="Bueno" required>
                                    <label class="custom-control-label" for="rcBueno">Bueno</label>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="rcRegular" name="rb-pconductor" value="Regular" required>
                                    <label class="custom-control-label" for="rcRegular">Regular</label>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="rc-Malo" name="rb-pconductor" value="Malo" required>
                                    <label class="custom-control-label" for="rcMalo">Malo</label>
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td colspan="2">
                                  <div class="form-group">
                                    <label for="" class="col-md-10">Presentacion del auxiliar </label>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="raBueno" name="rb-pauxiliar" value="Bueno" required>
                                    <label class="custom-control-label" for="raBueno">Bueno</label>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="raRegular" name="rb-pauxiliar" value="Regular" required>
                                    <label class="custom-control-label" for="raRegular">Regular</label>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="raMalo" name="rb-pauxiliar" value="Malo" required>
                                    <label class="custom-control-label" for="raMalo">Malo</label>
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td colspan="2">
                                  <div class="form-group">
                                    <label for="" class="col-md-10">Presentacion del vehiculo </label>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="rvBueno" name="rb-pvehiculo" value="Bueno" required>
                                    <label class="custom-control-label" for="rvBueno">Bueno</label>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="rvRegular" name="rb-pvehiculo" value="Regular" required>
                                    <label class="custom-control-label" for="rvRegular">Regular</label>
                                  </div>
                                </td>
                                <td colspan="1">
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="rvMalo" name="rb-pvehiculo" value="Malo" required>
                                    <label class="custom-control-label" for="rvMalo">Malo</label>
                                  </div>
                                </td>
                              </tr>

                              <tr>
                                <td colspan="5">
                                  <div class="form-group">
                                    <label for="observaciones">Observaciones:</label>
                                    <textarea class="form-control-plaintext" placeholder="Escriba la observacion" rows="5" id="observaciones" name="observaciones" required></textarea>
                                  </div>
                                </td>
                              </tr>

                              <tr align="center">
                                <td colspan="5">
                                  <button type="submit" id="enviar" name="enviar" class="btn btn-success btn-lg">ENVIAR</button>
                                </td>
                              </tr>

                            </tbody>
                          </table>
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
        <a href="https://www.cootranshuila.com">Cootranshuila</a>
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
    <script src="../assets/js/toastr.min.js"></script>
    <script type="text/javascript" src="../../assets/js/mainAd.js"></script>
    <!-- Plugins and scripts required by this view-->
    <!-- <script src="node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js"></script> -->
    <!-- <script src="js/main.js"></script> -->
    <!-- <script>$('[data-toggle="tooltip"]').tooltip();</script> -->
    <script>

      // Command: toastr["success"]("Operativo agregado correctamente.", "Correcto!");

      toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "800",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }

      $("#agregar-operativo").submit(function (){
        $.ajax({
          type: 'POST',
          url: 'validaciones/agregar-operativo.php',
          data: $(this).serialize(),
          success: function(respuesta) {
            if (respuesta == "Ok") {
              Command: toastr["success"]("Operativo agregado correctamente.", "Correcto!");
            }
            if (respuesta == "Error") {
              Command: toastr["error"]("El operativo NO agrego.", "Error!");
            }
            // console.log(respuesta);
          }
        });

        $("#agregar-operativo")[0].reset();

        return false;
      });
    </script>
  </body>
</html>