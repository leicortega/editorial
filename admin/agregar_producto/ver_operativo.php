<?php 

require "../assets/config/ConexionBaseDatos_PDO.php";

extract($_REQUEST);
extract($_POST);
require "../postulados/seg.php";

if ($_SESSION['rol'] == 'Operativos') {
  header("location:agregar-operativo.php");
}

$objConexion=conectaDb();

$sql = $objConexion->prepare('SELECT * from operativos where num_operativo = :edit');
$sql->bindParam(':edit', $_REQUEST['edit']);
$sql->execute();
foreach ($sql->fetchAll() as $row) {
  if ($row['estado'] == "Finalizado") {
    header("location:ver_terminados.php?edit=".$_REQUEST['edit']);
  }
}

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
    <link href="../assets/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="estilo.css" rel="stylesheet">
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
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="nav-icon icon-plus"></i> Agregar Operativo
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
          <li class="breadcrumb-item">Sanciones</li>
          <li class="breadcrumb-item active">Procedimiento</li>
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
            
            <?php 

              $sqlProce = $objConexion->prepare('SELECT * from procedimiento where num_op_foreing = :edit');
              $sqlProce->bindParam(':edit', $_REQUEST['edit']);
              $sqlProce->execute();
              $cont = $sqlProce->rowCount();

              if ($cont == 1) {
                $consulta = "SELECT * from operativos o, procedimiento p where o.num_operativo = :num and o.num_operativo = p.num_op_foreing";
              } else {
                $consulta = "SELECT * from operativos where num_operativo = :num";
              }
              // echo '<script>console.log("'.$consulta.'");</script>';
              $sql = $objConexion->prepare($consulta);
              $sql->bindParam(':num', $_REQUEST['edit']);
              $sql->execute();
              $resultado = $sql->fetchAll();
              foreach ($resultado as $row) { 
            ?>

            <!-- CONTENT PAGE -->
            <div class="row mb-2">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h2 class="text-center">Operativo No. <?php echo $row['num_operativo']; ?></h2>
                    <hr class="mb-4">
                    <!-- <h4><span class="badge badge-primary">Nombre del conductor</span></h4> -->

                    <table class="" id="operativo">
                      <thead>
                        <tr align="center">
                          <th colspan="3"></th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Nombre del conductor </span> <?php echo $row['nom_conductor']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</label></h4>
                            </div>
                          </td>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Fecha </span> <?php echo $row['fecha_operativo']; ?></label></h4>
                            </div>
                          </td>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Hora </span> <?php echo $row['hora_operativo']; ?></label></h4>
                            </div>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Placa </span> <?php echo $row['placa_vehiculo']; ?></label></h4>
                            </div>
                          </td>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Modalidad </span> <?php echo $row['modalidad']; ?></label></h4>
                            </div>
                          </td>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">No. Vehiculo </span> <?php echo $row['num_vehiculo']; ?></label></h4>
                            </div>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Origen </span> <?php echo $row['origen_ruta']; ?></label></h4>
                            </div>
                          </td>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Hora salida </span> <?php echo $row['hora_salida']; ?></label></h4>
                            </div>
                          </td>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Destino </span> <?php echo $row['destino_ruta']; ?></label></h4>
                            </div>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Sitio operativo </span> <?php echo $row['sitio_operativo']; ?></label></h4>
                            </div>
                          </td>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Pasajeros con tiquete </span> <?php echo $row['pasajeros_con_tiquete']; ?></label></h4>
                            </div>
                          </td>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Pasajeros sin tiquete </span> <?php echo $row['pasajeros_sin_tiquete']; ?></label></h4>
                            </div>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Presentacion del conductor </span> <?php echo $row['presentacion_conductor']; ?></label></h4>
                            </div>
                          </td>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Presentacion del auxiliar </span> <?php echo $row['presentacion_auxiliar']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</label></h4>
                            </div>
                          </td>
                          <td colspan="1">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Presentacion del vehiculo </span> <?php echo $row['presentacion_vehiculo']; ?></label></h4>
                            </div>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="3">
                            <div class="form-group">
                              <h4><label><span class="badge badge-primary">Observaciones </span> <?php echo $row['observaciones']; ?></label></h4>
                            </div>
                          </td>
                        </tr>
                        <?php  ?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-lg-12">
                 <div class="qa-message-list" id="wallmessages">
                    <!-- NOMBRE DE QUIEN AGREGO EL OPERATIVO -->
                    <div class="message-item" id="m16">
                       <div class="message-inner">
                          <div class="message-head clearfix">
                             <div class="user-detail">
                                <h5 class="handle">Operativo agregado por</h5>
                                <div class="post-meta">
                                   <div class="asker-meta">
                                      <span class="qa-message-what"></span>
                                      <span class="qa-message-when">
                                      </span>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="qa-message-content">
                             <h4><span class="qa-message-who-data text-primary"><?php echo $row['nom_usuario'] ?></span></h4>
                          </div>
                       </div>
                    </div>

                    <!-- DATOS DEL CONDUCTOR -->
                    <div class="message-item" id="m9">
                       <div class="message-inner">
                          <div class="message-head clearfix">
                             <div class="user-detail">
                                <h5 class="handle">Datos del conducor: <b class="text-primary"><?php echo $row['nom_conductor'] ?></b></h5>
                                <div class="post-meta">
                                   <div class="asker-meta">
                                      <span class="qa-message-what"></span>
                                      <span class="qa-message-when">
                                      </span>
                                      <span class="qa-message-who">
                                      </span>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="qa-message-content" id="res-datos-conductor">
                            <?php if (empty($row['cargo'])) { ?>
                              <!-- <div class="row form-inline text-center"> -->
                                <form action="" name="datos-conductor" id="datos-conductor" class="row form-inline text-center">
                                  <div class="col-md-1"></div>
                                  <div class="col-md-4 row">
                                    <label for="cargo" class="col-md-4">Cargo: </label>
                                    <select name="cargo" id="cargo" class='form-control col-md-8'>
                                      <option value="">Seleccione</option>
                                      <option value="Conductor">Conductor</option>
                                      <option value="Auxiliar">Auxiliar</option>
                                    </select>
                                  </div>
                                  <div class="col-md-1"></div>
                                  <div class="col-md-4 row">
                                    <label for="vinculacion" class="col-md-4">Vinculacion: </label>
                                    <select name="vinculacion" id="vinculacion" class='form-control col-md-8'>
                                      <option value="">Seleccione</option>
                                      <option value="Empresa">Empresa</option>
                                      <option value="Asociado">Asociado</option>
                                    </select>
                                  </div>
                                  <div class="col-md-2 text-right">
                                    <input type="text" name="num_op" id="num_op" class="d-none" value="<?php echo $_REQUEST['edit']; ?>">
                                    <button class="btn btn-success" disabled id="btn-conductor">Enviar</button>
                                  </div>
                                </form>
                              <!-- </div> -->
                            <?php } else {?>
                              <div class="row text-center">
                                <h4 class="col-md-6">Cargo: <span class="qa-message-who-data text-primary"><?php echo $row['cargo'] ?></span></h4>
                                <h4 class="col-md-6">Vinculacion: <span class="qa-message-who-data text-primary"><?php echo $row['vinculacion'] ?></span></h4>
                                <input type="text" name="num_op" id="num_op" class="d-none" value="<?php echo $_REQUEST['edit']; ?>">
                              </div>
                            <?php } ?>
                          </div>
                       </div>
                    </div>

                    <!-- TEXTAREA PARA EDITAR LA FALTA -->
                    <div class="message-item <?php echo empty($row['cargo']) ? "d-none" : ""; ?>" id="falta">
                       <div class="message-inner">
                          <div class="message-head clearfix">
                             <div class="user-detail">
                                <h5 class="handle text-left float-left mt-2">Falta</h5>
                                <button class="btn btn-primary text-right float-right" id="editar-falta">Editar</button>
                                <button class="btn btn-success text-right float-right d-none" id="enviar-falta">Enviar</button>
                                <div class="post-meta">
                                   <div class="asker-meta">
                                      <span class="qa-message-what"></span>
                                      <span class="qa-message-when">
                                      </span>
                                      <span class="qa-message-who">
                                      </span>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="qa-message-content" id="textarea-falta">
                             <textarea name="txt-falta" id="txt-falta" class="form-control" readonly=""><?php echo $row['observaciones'] ?></textarea>
                          </div>
                       </div>
                    </div>

                    <!-- SELECT PARA EDITAR EL PROCEDIMIENTO -->
                    <div class="message-item <?php echo empty($row['cargo']) ? "d-none" : ""; ?>" id="procedimiento">
                       <div class="message-inner">
                          <div class="message-head clearfix">
                             <div class="user-detail">
                                <h5 class="handle text-left float-left mt-2">Procedimiento</h5>
                                <button class="btn btn-primary text-right float-right <?php echo empty($row['procedimiento']) ? "d-none" : ""; ?>" id="editar-procedimiento">Editar</button>
                                <button class="btn btn-success text-right float-right <?php echo empty($row['procedimiento']) ? "" : "d-none"; ?>" id="enviar-procedimiento">Enviar</button>
                                <div class="post-meta">
                                   <div class="asker-meta">
                                      <span class="qa-message-what"></span>
                                      <span class="qa-message-when">
                                      </span>
                                      <span class="qa-message-who">
                                      </span>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <?php if (empty($row['procedimiento'])) {
                            $pro = '';
                          } else {
                            $pro = $row['procedimiento'];
                          } ?>
                          <div class="qa-message-content" id='select-proce'>
                              <select name="select-procedimiento" id="select-procedimiento" class="form-control" <?php echo empty($row['procedimiento']) ? "" : "disabled"; ?>>
                                <option value="">Seleccione el procedimiento</option>
                                <option value="Citado a diligencia de descargos" <?php echo $pro == "Citado a diligencia de descargos" ? "selected" : ""; ?>>Citado a diligencia de descargos</option>
                                <option value="Se presentó a diligencia de descargos" <?php echo $pro == "Se presentó a diligencia de descargos" ? "selected" : ""; ?>>Se presentó a diligencia de descargos</option>
                                <option value="Se reporta a cuadro de mantenimiento" <?php echo $pro == "Se reporta a cuadro de mantenimiento" ? "selected" : ""; ?>>Se reporta a cuadro de mantenimiento</option>
                              </select>
                              <p id="empty-procedimiento" class="text-danger"></p>
                          </div>
                       </div>
                    </div>
                    
                    <!-- AGREGAR SANCION -->
                    <div class="<?php echo empty($row['procedimiento']) ? "d-none" : ""; ?>" id="sancion1">
                      <div class="message-item <?php echo $row['procedimiento'] == "Se reporta a cuadro de mantenimiento" ? "d-none" : ""; ?>" id="sancion2">
                         <div class="message-inner">
                            <div class="message-head clearfix">
                               <div class="user-detail">
                                  <h5 class="handle text-left float-left mt-2">Sancion y observaciones</h5>
                                  <div class="post-meta">
                                     <div class="asker-meta">
                                        <span class="qa-message-what"></span>
                                        <span class="qa-message-when"></span>
                                        <span class="qa-message-who"></span>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="qa-message-content mb-5" id='div-sancion'>
                               <label for="textarea-sancion">Sancion:</label>
                               <textarea name="textarea-sancion" <?php echo !empty($row['sancion']) ? "readonly" : ""; ?> id="textarea-sancion" class="form-control" placeholder="Escriba la sancion..."><?php echo !empty($row['sancion']) ? $row['sancion'] : ""; ?></textarea>
                               <p id="empty-sancion" class="text-danger"></p>

                               <label for="textarea-observacion">Observaciones:</label>
                               <textarea name="textarea-observacion" <?php echo !empty($row['observacion']) ? "readonly" : ""; ?> id="textarea-observacion" class="form-control" placeholder="Escriba las observaciones..."><?php echo !empty($row['observacion']) ? $row['observacion'] : ""; ?></textarea>
                               <p id="empty-observacion" class="text-danger"></p>
                            </div>
                            <button class="btn btn-success text-right float-right <?php echo !empty($row['sancion']) ? "d-none" : ""; ?>" id="enviar-sancion" style="margin-top: -35px;">Enviar</button>
                         </div>
                      </div>
                    </div>

                    <!-- AGREGAR FECHAS DE SUSPENSION Y TERMINACION -->
                    <div class="message-item <?php echo empty($row['sancion']) ? "d-none" : ""; ?>" id="fechas">
                       <div class="message-inner">
                          <div class="message-head clearfix">
                             <div class="user-detail">
                                <h5 class="handle text-left float-left mt-2">Fechas de suspencion y terminacion</h5>
                                <div class="post-meta">
                                   <div class="asker-meta">
                                      <span class="qa-message-what"></span>
                                      <span class="qa-message-when"></span>
                                      <span class="qa-message-who"></span>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="qa-message-content mt-3 mb-3" id='div-fechas'>
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="input-sm form-control" <?php echo !empty($row['f_ini_suspen']) ? "disabled" : ""; ?> placeholder="Fecha desde" <?php echo !empty($row['f_ini_suspen']) ? "value='".$row['f_ini_suspen']."'" : ""; ?> name="f_ini_suspen" id="f_ini_suspen" />
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
                                <input type="text" class="input-sm form-control" <?php echo !empty($row['f_ini_suspen']) ? "disabled" : ""; ?> placeholder="Fecha hasta" <?php echo !empty($row['f_ini_suspen']) ? "value='".$row['f_fin_suspen']."'" : ""; ?> name="f_fin_suspen" id="f_fin_suspen" />
                            </div>
                            <p class="text-danger" id="empty-fechas"></p>
                          </div>
                          <div class="text-center">
                            <button class="btn btn-success btn-md <?php echo !empty($row['f_ini_suspen']) ? "d-none" : ""; ?>" id="enviar-fechas"> Enviar</button>
                          </div>
                       </div>
                    </div>

                    <!-- CONTENEDOR CUANDO EL PROCEDIMIENTO ES REPORTE A MANTENIMIENTO -->
                    <div class="message-item <?php echo $row['procedimiento'] != "Se reporta a cuadro de mantenimiento" ? "d-none" : ""; ?>" id="mantenimiento">
                       <div class="message-inner">
                          <div class="message-head clearfix">
                             <div class="user-detail">
                                <h5 class="handle text-left float-left mt-2">Revision del vehiculo</h5>
                                <div class="post-meta">
                                   <div class="asker-meta">
                                      <span class="qa-message-what"></span>
                                      <span class="qa-message-when"></span>
                                      <span class="qa-message-who"></span>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="qa-message-content mt-3 mb-3" id='div-mantenimiento'>
                            <div class="text-center">
                              <h3><b><?php if (empty($row['reparado'])) {
                                echo '¿Las fallas reportadas fueron debidamente reparadas?';
                              } else {
                                echo 'Las fallas reportadas '.$row['reparado'].' fueron debidamente reparadas';
                              } ?></b></h3>
                            </div>
                          
                            <div class="text-center <?php echo !empty($row['reparado']) ? "d-none" : ""; ?>">
                              <button class="btn btn-success btn-md" onclick="reparado('SI')"> Si</button>
                              <button class="btn btn-primary btn-md" onclick="reparado('NO')"> No</button>
                            </div>
                          </div>
                       </div>
                    </div>

                    <?php if (!empty($row['procedimiento']) and $row['procedimiento'] == "Se reporta a cuadro de mantenimiento") { ?>
                      <div class="message-item <?php echo empty($row['reparado']) ? "d-none" : ""; ?>" id="finalizar">
                    <?php } else { ?>
                      <div class="message-item <?php echo empty($row['f_ini_suspen']) ? "d-none" : ""; ?>" id="finalizar">
                    <?php } ?>

                    <!-- CONTENEDOR PARA FINALIZAR LA SANCION -->
                    
                       <div class="message-inner">
                          <div class="message-head clearfix">
                             <div class="user-detail">
                                <h5 class="handle text-left float-left mt-2">Finalizar sancion</h5>
                                <div class="post-meta">
                                   <div class="asker-meta">
                                      <span class="qa-message-what"></span>
                                      <span class="qa-message-when"></span>
                                      <span class="qa-message-who"></span>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <div class="qa-message-content mt-3 mb-3" id='div-finalizar'>
                            <div class="text-center">
                              <h3><b>¿Desea dar por finalizada esta sancion?</b></h3>
                            </div>
                          </div>
                          <div class="text-center">
                            <button class="btn btn-success btn-md" onclick="finalizar('Si')"> Si</button>
                            <button class="btn btn-primary btn-md" onclick="finalizar('No')"> No</button>
                          </div>
                       </div>
                    </div>

                 </div>
      
              </div>
              <!-- /.col-->
            </div> 
            
            <?php } ?>

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
    <script src="../assets/js/bootstrap-datepicker.min.js"></script>
    <script src="../assets/js/bootstrap-datepicker.es.min.js"></script>
    <script src="../assets/js/TweenMax.min.js"></script>
    <script type="text/javascript" src="../../assets/js/mainAd.js"></script>
    
    <!-- Plugins and scripts required by this view-->
    <!-- <script src="node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js"></script> -->
    <!-- <script src="js/main.js"></script> -->
    <script>
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

      $(function() {
  
        var watchScroll =0;
        var rightComments = $('.r-event .event-body');
        var leftComments = $('.l-event .event-body');
        TweenMax.staggerFrom(rightComments, 1, {x: 100, ease:Bounce.easeOut},1);
        TweenMax.staggerFrom(leftComments, 1, {x: -100,ease:Bounce.easeOut},1);

        $(window).on('scroll', function() {
          var scrollTop = $(window).scrollTop();
          (scrollTop > watchScroll)?
          $('footer').addClass('footer-up'):
          $('footer').removeClass('footer-up');
            
          watchScroll = scrollTop;
        });
      });
      
      // INICIAR DATEPICKER 
      $('#div-fechas .input-daterange').datepicker({
          format: "dd/mm/yyyy",
          language: "es",
          todayHighlight: true
      });

      // Funcion para verificar que la vinculacion y el cargo no esten vacios y habilitar boton enviar
      $("#cargo, #vinculacion").change(function(){
        if ($("#cargo").val() != '' && $("#vinculacion").val() != '') {
          $("#btn-conductor").prop("disabled", false);
        } 
      });

      // Peticon AJAX para agregar cargo y vinculacion del conductor
      $("#datos-conductor").submit(function(){
        $.ajax({
          type: 'POST',
          url: 'validaciones/datos-conductor.php',
          data: $("#datos-conductor").serialize(),
          success: function(data){
            Command: toastr["success"]("Datos agregados correctamente.", "Correcto!");
            $("#res-datos-conductor").html(data);
            $("#falta").removeClass('d-none');
            $("#procedimiento").removeClass('d-none');
            // $("#sancion").removeClass('d-none');
          }
        });
        return false;
      });

      // Habilitar textarea editar falta
      $('#editar-falta').click(function(){
        $("textarea, #txt-falta").prop("readonly", false);
        $("#editar-falta").addClass('d-none');
        $("#enviar-falta").removeClass('d-none');
      });

      // Peticion AJAX para editar FALTA
      $("#enviar-falta").click(function(){
        var falta = $("#txt-falta").val();
        var num = $("#num_op").val();
        // alert(num+' '+falta);
        $.ajax({
          type: 'POST',
          url: 'validaciones/editar-falta.php',
          data: {falta:falta, num:num},
          success: function(data){
            // console.log(data);
            Command: toastr["success"]("Falta editada correctamente.", "Correcto!");
            $("#textarea-falta").html(data);
            $("#editar-falta").removeClass('d-none');
            $("#enviar-falta").addClass('d-none');
          }
        });
      });

      // Habilitar select editar procedimiento
      $('#editar-procedimiento').click(function(){
        $("#select-procedimiento").prop("disabled", false);
        $("#editar-procedimiento").addClass('d-none');
        $("#enviar-procedimiento").removeClass('d-none');
      });

      // PETICION AJAX PARA EDITAR PROCEDIMIENTO
      $("#enviar-procedimiento").click(function(){
        var procedimiento = $("#select-procedimiento").val();
        var num = $("#num_op").val();
        if (procedimiento != '') {
          if (procedimiento == 'Se reporta a cuadro de mantenimiento') {
            $("#mantenimiento").removeClass('d-none');
          } else {
            $("#sancion1").removeClass('d-none');
            $("#sancion2").removeClass('d-none');
          }
          // alert(procedimiento);
          $.ajax({
            type: 'POST',
            url: 'validaciones/editar-procedimiento.php',
            data: {procedimiento:procedimiento, num:num},
            success: function(data){
              // console.log(data);
              Command: toastr["success"]("Procedimiento agregado correctamente.", "Correcto!");
              $("#select-proce").html(data);
              $("#editar-procedimiento").removeClass('d-none');
              $("#enviar-procedimiento").addClass('d-none');
            }
          });
        } else  {
          $("#select-procedimiento").css("border", "1px solid red");
          $("#empty-procedimiento").text("Debe seleccionar el procedimiento.");
        }
      });

      // PETICION AJAX PARA AGREGAR SANCION
      $("#enviar-sancion").click(function(){
        var sancion = $("#textarea-sancion").val();
        var observacion = $("#textarea-observacion").val();
        var num = $("#num_op").val();
        // alert(num+' '+sancion);
        if (sancion != '' && observacion != '') {
        $.ajax({
          type: 'POST',
          url: 'validaciones/agregar-sancion.php',
          data: {sancion:sancion, observacion:observacion, num:num},
          success: function(data){
            // console.log(data);
            Command: toastr["success"]("Sancion y observaciones agregadas correctamente.", "Correcto!");
            $("#div-sancion").html(data);
            $("#enviar-sancion").addClass('d-none');
            $("#fechas").removeClass('d-none');
          }
        });
        } else {
          if (sancion == '') {
            $("#textarea-sancion").css("border", "1px solid red");
            $("#empty-sancion").text("Debe escribir la sancion.");
          }  
          if (observacion == '') {
            $("#textarea-observacion").css("border", "1px solid red");
            $("#empty-observacion").text("Debe escribir las observaciones.");
          }
        }
      });

      // PETICION AJAX PARA AGREGAR LAS FECHAS DE SUSPENCION 
      $("#enviar-fechas").click(function(){
        var f_ini_suspen = $("#f_ini_suspen").val();
        var f_fin_suspen = $("#f_fin_suspen").val();
        var num = $("#num_op").val();
        // alert(num+' '+sancion);
        if (f_ini_suspen != '' && f_fin_suspen != '' && f_ini_suspen != f_fin_suspen) {
        $.ajax({
          type: 'POST',
          url: 'validaciones/agregar-fechas.php',
          data: {f_ini_suspen:f_ini_suspen, f_fin_suspen:f_fin_suspen, num:num},
          success: function(data){
            // console.log(data);
            Command: toastr["success"]("Fechas agregadas correctamente.", "Correcto!");
            $("#div-fechas").html(data);
            $("#finalizar").removeClass('d-none');
            $("#enviar-fechas").addClass('d-none');
            alert("Se enviara un correo a pasajes_neiva@cootranshuila.com y asistente_recursoshumanos@cootranshuila.com informando los dias de suspension para que sean descontados.");
            $.ajax({
              type: 'POST',
              url: 'validaciones/enviar-correo.php',
              data: {num:num},
              success: function(data){
                // console.log(data);
                if (data == 'Ok') {
                  Command: toastr["success"]("Correo enviado correctamente.", "Correcto!");
                } else{
                  Command: toastr["error"](data, "Error!");
                }
                
              }
            });
          }
        });
        } else if ((f_ini_suspen == f_fin_suspen) && (f_ini_suspen != '')) {
          $("#f_ini_suspen").css("border", "1px solid red");
          $("#f_fin_suspen").css("border", "1px solid red");
          $("#empty-fechas").text("Las fechas no pueden ser iguales.");
        } else {
          $("#f_ini_suspen").css("border", "1px solid red");
          $("#f_fin_suspen").css("border", "1px solid red");
          $("#empty-fechas").text("Por favor escriba las dos fechas.");
        }
      });

      // FUNCION AJAX PARA REVISION DEL VEHICULO
      function reparado(data){
        var num = $("#num_op").val();

        $.ajax({
          type: 'POST',
          url: 'validaciones/revision.php',
          data: {reparado:data, num:num},
          success: function(data){
            // console.log(data);
            Command: toastr["success"]("Fue agregada la revision correctamente.", "Correcto!");
            $("#div-mantenimiento").html(data);
            $("#finalizar").removeClass('d-none');
            // $("#enviar-fechas").addClass('d-none');
          }
        });
      }

      // PETICION AJAX PARA FINALIZAR OPERATIVO
      function finalizar(data){
        var num = $("#num_op").val();

        $.ajax({
          type: 'POST',
          url: 'validaciones/finalizar.php',
          data: {finalizar:data, num:num},
          success: function(data){
            if (data == 'Ok') {
              Command: toastr["success"]("La sancion se finalizo correctamente.", "Correcto!");
              setTimeout("redireccionarPagina("+num+")", 5000);
            } else {
              Command: toastr["info"]("La sancion no se ha finalizado.", "Informacion!");
            }
          }
        });
      }

      function redireccionarPagina(num) {
        window.location = "terminados.php?edit="+num;
      }

    </script>
  </body>
</html>