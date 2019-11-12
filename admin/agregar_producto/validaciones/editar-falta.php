<?php 

extract($_REQUEST);
extract($_POST);

require "../../assets/config/ConexionBaseDatos_PDO.php";

require "../../postulados/seg.php";
$objConexion=conectaDb();

$sql_op = $objConexion->prepare('SELECT * from operativos where num_operativo = :num');
$sql_op->bindParam(':num', $_REQUEST['num']);
$sql_op->execute();
$res_op = $sql_op->fetchAll();

foreach ($res_op as $row) {
	if ($row['observaciones'] == $_REQUEST['falta']) { ?>
		<textarea name="txt-falta" id="txt-falta" class="form-control" readonly=""><?php echo $_REQUEST['falta'] ?></textarea>
	<?php } else {
		$sql = $objConexion->prepare('UPDATE operativos set observaciones = :falta where num_operativo = :num');
		$sql->bindParam(':falta', $_REQUEST['falta']);
		$sql->bindParam(':num', $_REQUEST['num']);
		$sql->execute();

		if ($sql->rowCount() == 1) { ?>
			<textarea name="txt-falta" id="txt-falta" class="form-control" readonly=""><?php echo $_REQUEST['falta'] ?></textarea>
		<?php } else { ?>
			<div class="row text-center">
		      <h4 class="col-md-6">Ha ocurrido un error, contacte al desarrollador.</h4>
		    </div>
		<?php }
	}
}

?>