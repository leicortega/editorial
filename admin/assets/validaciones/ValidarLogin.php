<?php
session_start();
extract($_REQUEST);
require "../config/ConexionBaseDatos_PDO.php";

$objConexion=conectaDb();
$pass = MD5($_REQUEST['pass']);
$id_usu = $_REQUEST['id_usu'];

$sql= $objConexion->prepare("SELECT * from usuarios where id_usuario = :id and psw_usuario = :psw");
$sql->bindParam(":id", $id_usu);
$sql->bindParam(":psw", $pass);
$sql->execute();
$resultado = $sql->fetchAll();
$existe = $sql->rowCount();

foreach ($resultado as $row) {
	$i = $row['id_usuario'];
}

if ($existe == 1) {
	$_SESSION["n-user"] = $i;

	echo "Ok";
}
else{
	echo "Error: ".$sql->errorInfo();
}

?>
