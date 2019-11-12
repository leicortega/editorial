<?php 

extract($_REQUEST);
extract($_POST);

require "../../assets/config/ConexionBaseDatos_PDO.php";

require "../../postulados/seg.php";
$objConexion=conectaDb();

$sql0 = $objConexion->prepare('UPDATE operativos set estado = "En descargos" where num_operativo = :num');
$sql0->bindParam(':num', $_REQUEST['num']);
$sql0->execute();

$sql = $objConexion->prepare('UPDATE procedimiento set procedimiento = :procedimiento where num_op_foreing = :num');
$sql->bindParam(':procedimiento', $_REQUEST['procedimiento']);
$sql->bindParam(':num', $_REQUEST['num']);
$sql->execute();

if ($sql->rowCount() == 1) { ?>
	<select name="select-procedimiento" id="select-procedimiento" class="form-control" disabled>
      <option value="Citado a diligencia de descargos" <?php echo $_REQUEST['procedimiento'] == "Citado a diligencia de descargos" ? "selected" : ""; ?>>Citado a diligencia de descargos</option>
      <option value="Se presentó a diligencia de descargos" <?php echo $_REQUEST['procedimiento'] == "Se presentó a diligencia de descargos" ? "selected" : ""; ?>>Se presentó a diligencia de descargos</option>
      <option value="Se reporta a cuadro de mantenimiento" <?php echo $_REQUEST['procedimiento'] == "Se reporta a cuadro de mantenimiento" ? "selected" : ""; ?>>Se reporta a cuadro de mantenimiento</option>
    </select>
<?php } else { ?>
	<div class="row text-center">
      <h4 class="col-md-6">Ha ocurrido un error, contacte al desarrollador.</h4>
    </div>
<?php }


?>