<?php 

extract($_REQUEST);
extract($_POST);

require "../../assets/config/ConexionBaseDatos_PDO.php";

require "../../postulados/seg.php";
$objConexion=conectaDb();

$sql1 = $objConexion->prepare('UPDATE procedimiento set reparado = :reparado where num_op_foreing = :num');
$sql1->bindParam(':reparado', $_REQUEST['reparado']);
$sql1->bindParam(':num', $_REQUEST['num']);
$sql1->execute();

if ($sql1->rowCount() == 1) { ?>
	<div class="text-center">
      <h3><b>Las fallas reportadas <?php echo $_REQUEST['reparado']; ?> fueron debidamente reparadas</b></h3>
    </div>
<?php } else { ?>
	<div class="row text-center">
      <h4 class="col-md-6">Ha ocurrido un error, contacte al desarrollador.</h4>
    </div>
<?php }


?>