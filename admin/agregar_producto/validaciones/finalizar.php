<?php 

extract($_REQUEST);
extract($_POST);

require "../../assets/config/ConexionBaseDatos_PDO.php";

require "../../postulados/seg.php";
$objConexion=conectaDb();


if ($_REQUEST['finalizar'] == 'Si') {

	$sql1 = $objConexion->prepare('UPDATE operativos set estado = "Finalizado" where num_operativo = :num');
	$sql1->bindParam(':num', $_REQUEST['num']);
	$sql1->execute();

	if ($sql1->rowCount() == 1) {
			echo 'Ok';
		} else {
			echo 'Error';
		}

} else {
	echo 'Error';
}

?>