<?php 

extract($_REQUEST);
extract($_POST);

require "../../assets/config/ConexionBaseDatos_PDO.php";

require "../../postulados/seg.php";
$objConexion=conectaDb();
// $procedimiento = 'Citado a diligencia de descargos';

$sql = $objConexion->prepare('INSERT into procedimiento (num_op_foreing, cargo, vinculacion) values (:num, :cargo, :vinculacion)');
$sql->bindParam(':num', $_REQUEST['num_op']);
$sql->bindParam(':cargo', $_REQUEST['cargo']);
$sql->bindParam(':vinculacion', $_REQUEST['vinculacion']);
// $sql->bindParam(':procedimiento', $procedimiento);
$sql->execute();

if ($sql->rowCount() == 1) { ?>
	<div class="row text-center">
      <h4 class="col-md-6">Cargo: <span class="qa-message-who-data text-primary"><?php echo $_REQUEST['cargo'] ?></span></h4>
      <h4 class="col-md-6">Vinculacion: <span class="qa-message-who-data text-primary"><?php echo $_REQUEST['vinculacion'] ?></span></h4>
      <input type="text" name="num_op" id="num_op" class="d-none" value="<?php echo $_REQUEST['num_op']; ?>">
    </div>
<?php } else { ?>
	<div class="row text-center">
      <h4 class="col-md-6">Ha ocurrido un error, contacte al desarrollador.</h4>
    </div>
<?php }

?>