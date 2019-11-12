<?php 

extract($_REQUEST);
extract($_POST);

require "../../assets/config/ConexionBaseDatos_PDO.php";
require "../../postulados/seg.php";

$objConexion=conectaDb();

//SE ACTUALIZA EL ESTADO DE OPERATIVO EN SANCION APLICADA
$sql0 = $objConexion->prepare('UPDATE operativos set estado = "Sancion aplicada" where num_operativo = :num');
$sql0->bindParam(':num', $_REQUEST['num']);
$sql0->execute();

//SE AGREGAN LAS FECHAS DE SUSPENCION Y TERMINACION DE SANCION
$sql1 = $objConexion->prepare('UPDATE procedimiento set f_ini_suspen = :f_ini_suspen, f_fin_suspen = :f_fin_suspen where num_op_foreing = :num');
$sql1->bindParam(':f_ini_suspen', $_REQUEST['f_ini_suspen']);
$sql1->bindParam(':f_fin_suspen', $_REQUEST['f_fin_suspen']);
$sql1->bindParam(':num', $_REQUEST['num']);
$sql1->execute();

if ($sql1->rowCount() == 1) { ?>
	<div class="input-daterange input-group" id="datepicker">
        <input type="text" class="input-sm form-control" value="<?php echo $_REQUEST['f_ini_suspen']; ?>" disabled readonly/>
        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
        <input type="text" class="input-sm form-control" value="<?php echo $_REQUEST['f_fin_suspen'] ?>" disabled readonly/>
    </div>
<?php } else { ?>
	<div class="row text-center">
      <h4 class="col-md-6">Ha ocurrido un error, contacte al desarrollador.</h4>
    </div>
<?php }

?>