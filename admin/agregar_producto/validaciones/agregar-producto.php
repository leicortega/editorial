<?php 

extract($_REQUEST);
extract($_POST);

require "../../assets/config/ConexionBaseDatos_PDO.php";

require "../../assets/config/seguridad.php";
$conexion=conectaDb();

$sql = $objConexion->prepare("insert into operativos(num_operativo, nom_conductor, fecha_operativo, hora_operativo, placa_vehiculo, modalidad, num_vehiculo, origen_ruta, hora_salida, destino_ruta, sitio_operativo, pasajeros_con_tiquete, pasajeros_sin_tiquete, presentacion_conductor, presentacion_auxiliar, presentacion_vehiculo, observaciones, nom_usuario, estado) values (:num_op, :nom_con, :fecha_op, :hora_op, :placa_vehi, :modalidad, :num_vehi, :origen, :hora_salida, :destino, :sitio_op, :pas_con_t, :pas_sin_t, :pres_con, :pres_aux, :pres_vehi, :obs, :nom_usuario, 'Iniciado')");
$sql->bindParam(":num_op", $_REQUEST['num_operativo']);
$sql->bindParam(":nom_con", $_REQUEST['nom_conductor']);
$sql->bindParam(":fecha_op", $_REQUEST['fecha_operativo']);
$sql->bindParam(":hora_op", $_REQUEST['hora_operativo']);
$sql->bindParam(":placa_vehi", $_REQUEST['placa_vehiculo']);
$sql->bindParam(":modalidad", $_REQUEST['modalidad']);
$sql->bindParam(":num_vehi", $_REQUEST['num_vehiculo']);
$sql->bindParam(":origen", $_REQUEST['origen_ruta']);
$sql->bindParam(":hora_salida", $_REQUEST['hora_salida']);
$sql->bindParam(":destino", $_REQUEST['destino_ruta']);
$sql->bindParam(":sitio_op", $_REQUEST['sitio_operativo']);
$sql->bindParam(":pas_con_t", $_REQUEST['pasajeros_con_tiquete']);
$sql->bindParam(":pas_sin_t", $_REQUEST['pasajeros_sin_tiquete']);
$sql->bindParam(":pres_con", $_REQUEST['rb-pconductor']);
$sql->bindParam(":pres_aux", $_REQUEST['rb-pauxiliar']);
$sql->bindParam(":pres_vehi", $_REQUEST['rb-pvehiculo']);
$sql->bindParam(":obs", $_REQUEST['observaciones']);
$sql->bindParam(":nom_usuario", $_SESSION["user"]);
$sql->execute();
$existe = $sql->rowCount();
if ($existe == 1) {
	echo 'Ok';
} else {
	echo 'Error';
}

?>