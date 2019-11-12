<?php 
extract($_REQUEST);
extract($_POST);

if (!isset($_REQUEST['p'])) {
  header("location:terminados.php?p=1");
}
require "../assets/config/ConexionBaseDatos_PDO.php";

require "../postulados/seg.php";

if ($_SESSION['rol'] == 'Operativos') {
  header("location:agregar-operativo.php");
}

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
              <a class="nav-link" href="#">
                <i class="nav-icon icon-check"></i> Operativos terminados
              </a>
            </li>
          <?php } if ($_SESSION['rol'] == 'Operativos' or $_SESSION['rol'] == 'Sanciones' or $_SESSION['rol'] == 'Todos') { ?>
            <li class="nav-item">
              <a class="nav-link" href="agregar-operativo.php">
                <i class="nav-icon icon-plus"></i> Agregar Operativo
              </a>
            </li>
          <?php } echo '<script>console.log("'.$_SESSION['rol'].'");</script>';?>
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Inicio</li>
          <li class="breadcrumb-item">Sanciones</li>
          <li class="breadcrumb-item active">Operativos terminados</li>
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
                    <i class="fa fa-align-justify"></i> Operativos terminados
                    <div class="text-right float-right"><h4><a href="terminados.php?p=1"><span class="badge badge-info p-2">Generar consulta SQL</span></a></h4></div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group row">
                          <!-- <label for="order" class="mt-2 col-lg-5"></label> -->
                          <select name="order" id="order" class="form-control ml-2 col-lg-11">
                            <option value="">Ordenar por</option>
                            <?php if (isset($_REQUEST['b'])) { ?> 
                            <option value="no">No ordenar</option>
                            <?php } ?>
                            <option value="num_operativo">Numero operativo</option>
                            <option value="fecha_operativo">Fecha operativo</option>
                            <!-- <option value="placa_vehiculo">Placa</option> -->
                            <option value="num_vehiculo">Numero interno</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group row">
                          <!-- <label for="order" class="mt-2 col-lg-5"></label> -->
                          <select name="agergados" id="agergados" class="form-control col-lg-11">
                            <option value="">Agregados por</option>
                            <?php if (isset($_REQUEST['a'])) { ?> 
                            <option value="no">Ver todos</option>
                            <?php 
                              }
                              $sqlAgregados = $objConexion->prepare('SELECT nombre_usuario from usuarios where rol_usuario = "Operativos"');
                              $sqlAgregados->execute();
                              $resAgregados = $sqlAgregados->fetchAll();
                              // echo '<script>console.log("'.$sqlAgregados->rowCount().'1");</script>';
                              foreach ($resAgregados as $key) {
                            ?>
                              <option value="<?php echo $key['nombre_usuario'] ?>"><?php echo $key['nombre_usuario'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group row">
                          <!-- <label for="modalidad" class="mt-2 col-lg-5"></label> -->
                          <select name="modalidad" id="modalidad" class="form-control col-lg-11">
                            <option value="">Modalidad</option>
                            <?php if (isset($_REQUEST['m'])) { ?> 
                            <option value="no">Ver todos</option>
                            <?php } ?>
                            <option value="Doble Yo">Doble Yo</option>
                            <option value="VIP">VIP</option>
                            <option value="Platino Expres">Platino Expres</option>
                            <option value="Platino Jet">Platino Jet</option>
                            <option value="Platino Especial">Platino Especial</option>
                            <option value="Mixto">Mixto</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group row">
                          <label for="mes" class="mt-2 col-lg-5">Ver por mes</label>
                          <select name="mes" id="mes" class="form-control col-lg-6">
                            <option value="">Seleccione</option>
                            <?php if (isset($_REQUEST['buscar'])) { ?> 
                            <option value="no">Ver todos</option>
                            <?php } ?>
                            <option value="Enero">Enero</option>
                            <option value="Febrero">Febrero</option>
                            <option value="Marzo">Marzo</option>
                            <option value="Abril">Abril</option>
                            <option value="Mayo">Mayo</option>
                            <option value="Junio">Junio</option>
                            <option value="Julio">Julio</option>
                            <option value="Agosto">Agosto</option>
                            <option value="Septiembre">Septiembre</option>
                            <option value="Octubre">Octubre</option>
                            <option value="Noviembre">Noviembre</option>
                            <option value="Diciembre">Diciembre</option>
                          </select>
                        </div>
                      </div>

                      <?php if (isset($_REQUEST['a']) or isset($_REQUEST['b']) or isset($_REQUEST['m']) or isset($_REQUEST['e']) or isset($_REQUEST['buscar'])): ?>
                      <div class="col-lg-2">
                        <div class="form-group row">
                          <div class="col-lg-2 mt-2"><h4><a href="terminados.php?p=1"><span class="badge badge-info">Ver todos</span></a></h4></div>
                        </div>
                      </div>
                      <?php endif ?>

                      <!-- <div class="col-lg-7">
                        <div class="form-group row">  
                          <div class="col-lg-1"></div>
                          <div class="col-lg-2 mt-2 text-right">Estado:</div>
                          <div class="col-lg-3 mt-2 text-right"><h4><a href="index.php?e=Iniciado&p=1"><span class="badge badge-success">Iniciado</span></a></h4></div>
                          <div class="col-lg-3 mt-2 text-right"><h4><a href="index.php?e=En descargos&p=1"><span class="badge badge-warning">En descargos</span></a></h4></div>
                          <div class="col-lg-3 mt-2"><h4><a href="index.php?e=Sancion aplicada&p=1"><span class="badge badge-danger">Sancion aplicada</span></a></h4></div>
                        </div>
                      </div> -->
                      <?php if (isset($_REQUEST['a']) or isset($_REQUEST['b']) or isset($_REQUEST['m']) or isset($_REQUEST['e']) or isset($_REQUEST['buscar'])){ ?>
                      	<div class="col-lg-6">
                      <?php } else { ?>
						<div class="col-lg-8">
                      <?php } ?>
                      
                        <div class="form-group row">
                          <!-- <label for="buscar" class="mt-2 col-lg-4">Buscar</label> -->
                          <input type="text" id="buscar" name="buscar" class="form-control col-lg-11" placeholder="Buscar...">
                        </div>
                      </div>
                    </div>
                    <div id="resultados" class='mb-2'></div>
                    <table class="table table-responsive-sm table-bordered table-sm">
                      <thead>
                        <tr>
                          <th>No. operativo</th>
                          <th>Nombre conductor</th>
                          <th>Fecha operativo</th>
                          <th>Estado</th>
                          <th>No. interno</th>
                          <th>Modalidad</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                           // Condicional para ordenar datos de la tabla
                           if (isset($_REQUEST['b'])) {
                             $order = 'order by '.$_REQUEST['b'].' desc';
                           } else {
                             $order = '';
                           }
                           // Condicional para ordenar datos de la tabla por modalidad
                           if (isset($_REQUEST['m'])) {
                             $likeModalidad = "where modalidad like '".$_REQUEST['m']."'";
                           } else {
                             $likeModalidad = '';
                           }
                           // Condicional para mostrar los datos por estado
                           if (isset($_REQUEST['e'])) {
                             $likeEstado = "where estado like '".$_REQUEST['e']."'";
                           } else {
                             $likeEstado = '';
                           }
                           // Condicional para mostrar los datos por nombre de quien los agrego
                           if (isset($_REQUEST['a'])) {
                             $likeNombre = "where nom_usuario like '".$_REQUEST['a']."'";
                           } else {
                             $likeNombre = "";
                           }
                           // Condicional para mostrar los datos por nombre de quien los agrego
                           if (!isset($_REQUEST['m']) and !isset($_REQUEST['e']) and !isset($_REQUEST['a'])) {
                             $where_estado = "where estado = 'Finalizado'";
                           } else {
                             $where_estado = "and estado = 'Finalizado'";
                           }
                           // Consulta para ver cantidad de datos para hacer el paginagor
                           $sql_p = $objConexion->prepare("select * from operativos where estado = 'Finalizado'");
                           $sql_p->execute();
                           $cont = $sql_p->rowCount();
                           // operacion para obtener el inicio de dato por pagina
                           $inicio = ($_REQUEST['p'] - 1) * 10;
                           // condicion para saber si el usuario ha utilizado el buscador
                           if (isset($_REQUEST['buscar'])) {
                              $busqueda = trim($_REQUEST['buscar']);
                              if ($busqueda > 2000) {
                                $bus = "fecha_operativo LIKE  '".$busqueda."%'";
                              } else{
                                $bus = "fecha_operativo LIKE  '".$busqueda."'";
                              }
                              $sqlTabla = "SELECT * FROM operativos WHERE (num_operativo LIKE '".$busqueda."' OR nom_conductor LIKE '%".$busqueda."%' OR $bus OR modalidad LIKE '".$busqueda."%' OR num_vehiculo LIKE '".$busqueda."') and estado = 'Finalizado' order by fecha_operativo desc";
                           } else {
                             $sqlTabla = "SELECT * from operativos ".$likeEstado . $likeModalidad . $likeNombre . $where_estado." ".$order." limit ".$inicio.", 10";
                             // echo '<script>console.log("'.$sqlTabla.'");</script>';
                           }

                           $sql = $objConexion->prepare($sqlTabla);
                           $sql->execute();

                           if (isset($_REQUEST['m']) or isset($_REQUEST['buscar']) or isset($_REQUEST['e'])  or isset($_REQUEST['a'])) {
                             $cont = $sql->rowCount();
                           } else {
                             $cont = $sql_p->rowCount();
                           }
                           // $cont = $sql->rowCount();
                           $resultado = $sql->fetchAll();
                           foreach ($resultado as $row) {
                             echo "<tr>";
                             echo "<td>".$row['num_operativo']."</td>";
                             echo "<td>".$row['nom_conductor']."</td>";
                             echo "<td>".$row['fecha_operativo']."</td>";
                             echo "<td><span class='badge badge-info'>Finalizado</span></td>";
                             echo "<td>".$row['num_vehiculo']."</td>";
                             echo "<td>".$row['modalidad']."</td>";
                          ?>
                          <td class="text-center">
                            <a href="ver_terminados.php?edit=<?php echo $row['num_operativo']; ?>" data-toggle="tooltip" data-placement="top" title="Ver proceso"><button type="button" class="btn btn-info btn-pill" value="Editar"><i class="far fa-eye"></i></button></a>
                            <a href="reporte_pdf.php?san=<?php echo $row['num_operativo']; ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Descargar"><button type="button" class="btn btn-success btn-pill" value="DescargarSan" id="myBtn"><i class="fas fa-file-download"></i></button></a>
                          </td>
                          <?php } 
                            if (isset($_REQUEST['b'])) {
                              $url_atras = 'terminados.php?b='.$_REQUEST['b'].'&p='.($_REQUEST['p']-1);
                              $url_next = 'terminados.php?b='.$_REQUEST['b'].'&p='.($_REQUEST['p']+1);
                            } elseif (isset($_REQUEST['m'])) {
                              $url_atras = 'terminados.php?m='.$_REQUEST['m'].'&p='.($_REQUEST['p']-1);
                              $url_next = 'terminados.php?m='.$_REQUEST['m'].'&p='.($_REQUEST['p']+1);
                            } elseif (isset($_REQUEST['e'])) {
                              $url_atras = 'terminados.php?e='.$_REQUEST['e'].'&p='.($_REQUEST['p']-1);
                              $url_next = 'terminados.php?e='.$_REQUEST['e'].'&p='.($_REQUEST['p']+1);
                            } elseif (isset($_REQUEST['a'])) {
                              $url_atras = 'terminados.php?a='.$_REQUEST['a'].'&p='.($_REQUEST['p']-1);
                              $url_next = 'terminados.php?a='.$_REQUEST['a'].'&p='.($_REQUEST['p']+1);
                            }  elseif (isset($_REQUEST['buscar'])) {
                              $url_atras = 'terminados.php?buscar='.$_REQUEST['buscar'].'&p='.($_REQUEST['p']-1);
                              $url_next = 'terminados.php?buscar='.$_REQUEST['buscar'].'&p='.($_REQUEST['p']+1);
                            } else {
                              $url_atras = 'terminados.php?p='.($_REQUEST['p']-1);
                              $url_next = 'terminados.php?p='.($_REQUEST['p']+1);
                            }
                          ?>
                        </tr>
                      </tbody>
                    </table>
                    <?php if (isset($_REQUEST['b'])) { ?>
                      <div id="resultados-hide" class="d-none">Resultado: <b><?php echo $cont; ?></b> operativos finalizados en total ordenados por <b><?php if ($_REQUEST['b'] == 'num_operativo') { echo 'Numero de operativo'; } elseif ($_REQUEST['b'] == 'fecha_operativo') { echo 'Fecha de operativo'; } elseif ($_REQUEST['b'] == 'num_vehiculo') { echo 'Numero interno de vehiculo'; }; ?></b>.</div>
                    <?php } elseif (isset($_REQUEST['m'])) { ?>
                      <div id="resultados-hide" class="d-none">Resultado: <b><?php echo $cont; ?></b> operativos finalizados en total de la modalidad <b><?php echo $_REQUEST['m']; ?></b>.</div>
                    <?php } elseif (isset($_REQUEST['e'])) { ?>
                      <div id="resultados-hide" class="d-none">Resultado: <b><?php echo $cont; ?></b> operativos finalizados en estado <b><?php echo $_REQUEST['e']; ?></b>.</div>
                    <?php } elseif (isset($_REQUEST['a'])) { ?>
                      <div id="resultados-hide" class="d-none">Resultado: <b><?php echo $cont; ?></b> operativos finalizados en total agregados por <b><?php echo $_REQUEST['a']; ?></b>.</div>
                    <?php } elseif (isset($_REQUEST['buscar']) && !isset($_REQUEST['mes'])) { ?>
                      <div id="resultados-hide" class="d-none">Resultado: <b><?php echo $cont; ?></b> operativos finalizados en total de la busqueda <b>"<?php echo $_REQUEST['buscar']; ?>"</b>.</div>
                    <?php } elseif (isset($_REQUEST['buscar']) && isset($_REQUEST['mes'])) { ?>
                      <div id="resultados-hide" class="d-none">Resultado: <b><?php echo $cont; ?></b> operativos finalizados en total del mes de <b><?php echo $_REQUEST['mes']; ?></b>.</div>
                    <?php } else{ ?>
                      <div id="resultados-hide" class="d-none">Resultado: <b><?php echo $cont; ?></b> operativos finalizados en total.</div>
                    <?php } ?>
                    
                    <nav>
                      <ul class="pagination">
                        <li class="page-item <?php echo $_REQUEST["p"] == 1 ? "disabled" : ""; ?>">
                          <a class="page-link" href="<?php echo $url_atras; ?>">Atras</a>
                        </li>

                        <?php 
                          $num_item = ceil($cont / 10);
                          if ($num_item == 0) {
                            $num_item = 1;
                          }
                          $i = 1;
                          // echo '<script>console.log("'.$_SERVER['REQUEST_URI'].'");</script>';
                          while ($i <= $num_item) {
                            if (isset($_REQUEST['b'])) {
                              $url_pagina = 'terminados.php?b='.$_REQUEST['b'].'&p='.$i;
                            } elseif (isset($_REQUEST['m'])) {
                              $url_pagina = 'terminados.php?m='.$_REQUEST['m'].'&p='.$i;
                            } elseif (isset($_REQUEST['buscar'])) {
                              $url_pagina = 'terminados.php?buscar='.$_REQUEST['buscar'].'&p='.$i;
                            } else {
                              $url_pagina = 'terminados.php?p='.$i;
                            }
                        ?>
                        <li class="page-item <?php echo $_REQUEST["p"] == $i ? "active" : ""; ?>">
                          <a class="page-link" href="<?php echo $url_pagina; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php 
                          $i++; } 
                        ?>

                        <li class="page-item <?php echo $_REQUEST["p"] == $num_item ? "disabled" : ""; ?>">
                          <a class="page-link" href="<?php echo $url_next; ?>">Siguiente</a>
                        </li>
                      </ul>
                    </nav>
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
    <script type="text/javascript" src="../../assets/js/mainAd.js"></script>
    <!-- Plugins and scripts required by this view-->
    <!-- <script src="node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js"></script> -->
    <!-- <script src="js/main.js"></script> -->
    <!-- <script>$('[data-toggle="tooltip"]').tooltip();</script> -->
    <script>
      var res = $("#resultados-hide").html();
      $("#resultados").html(res);
      // funcion para ver por quien agrego el operativo
      $('select, #agregados').on('change', function() {  
        
        // var nombre = this.value;
        // console.log(nombre);

        window.location.href="terminados.php?a="+this.value+"&p=1";
      });

      // funcion para ordenar la tabla
      $('select, #order').on('change', function() {  
    
        if (this.value == 'num_operativo') {
          window.location.href="terminados.php?b=num_operativo&p=1";
        } 
        if (this.value == 'fecha_operativo') {
          window.location.href="terminados.php?b=fecha_operativo&p=1";
        } 
        if (this.value == 'placa_vehiculo') {
          window.location.href="terminados.php?b=placa_vehiculo&p=1";
        }
        if (this.value == 'num_vehiculo') {
          window.location.href="terminados.php?b=num_vehiculo&p=1";
        }
        if (this.value == 'no') {
          window.location.href="terminados.php?p=1";
        }
      });

      // funcion para ver por modalidad
      $('select, #modalidad').on('change', function() {  
    
        if (this.value == 'Doble Yo') {
          window.location.href="terminados.php?m=Doble Yo&p=1";
        } 
        if (this.value == 'VIP') {
          window.location.href="terminados.php?m=VIP&p=1";
        } 
        if (this.value == 'Platino Expres') {
          window.location.href="terminados.php?m=Platino Expres&p=1";
        }
        if (this.value == 'Platino Jet') {
          window.location.href="terminados.php?m=Platino Jet&p=1";
        }
        if (this.value == 'Platino Especial') {
          window.location.href="terminados.php?m=Platino Especial&p=1";
        }
        if (this.value == 'Mixto') {
          window.location.href="terminados.php?m=Mixto&p=1";
        }
        if (this.value == 'no') {
          window.location.href="terminados.php?p=1";
        }
      });

      // funcion para ver por mes
      $('select, #mes').on('change', function() {  
    
        if (this.value == 'Enero') {
          window.location.href="terminados.php?buscar=2019-01&mes=Enero&p=1";
        } 
        if (this.value == 'Febrero') {
          window.location.href="terminados.php?buscar=2019-02&mes=Febrero&p=1";
        }
        if (this.value == 'Marzo') {
          window.location.href="terminados.php?buscar=2019-03&mes=Marzo&p=1";
        }
        if (this.value == 'Abril') {
          window.location.href="terminados.php?buscar=2019-04&mes=Abril&p=1";
        }
        if (this.value == 'Mayo') {
          window.location.href="terminados.php?buscar=2019-05&mes=Mayo&p=1";
        }
        if (this.value == 'Junio') {
          window.location.href="terminados.php?buscar=2019-06&mes=Junio&p=1";
        }
        if (this.value == 'Julio') {
          window.location.href="terminados.php?buscar=2019-07&mes=Julio&p=1";
        }
        if (this.value == 'Agosto') {
          window.location.href="terminados.php?buscar=2019-08&mes=Agosto&p=1";
        }
        if (this.value == 'Septiembre') {
          window.location.href="terminados.php?buscar=2019-09&mes=Septiembre&p=1";
        }
        if (this.value == 'Octubre') {
          window.location.href="terminados.php?buscar=2019-10&mes=Octubre&p=1";
        }
        if (this.value == 'Noviembre') {
          window.location.href="terminados.php?buscar=2019-11&mes=Noviembre&p=1";
        }
        if (this.value == 'Diciembre') {
          window.location.href="terminados.php?buscar=2019-12&mes=Diciembre&p=1";
        }
        if (this.value == 'no') {
          window.location.href="terminados.php?p=1";
        }
      });
      
      // funcion para redireccionar a la busqueda
      $('#buscar').keyup(function(e){
          if(e.keyCode == 13)
          {
            var busqueda = $('#buscar').val();
            window.location.href = 'terminados.php?buscar='+busqueda+"&p=1";
          }
      });
    </script>
  </body>
</html>