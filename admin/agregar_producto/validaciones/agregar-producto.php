<?php 

extract($_REQUEST);
extract($_POST);

require "../../assets/config/ConexionBaseDatos_PDO.php";

require "../../assets/config/seguridad.php";
$conexion=conectaDb();

echo $_FILES['imagen']['tmp_name'];

$ruta = "../../assets/img/productos/";
$nombre_imagen = "imagen_".date("dHis").".".pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
$guardar_imagen = $ruta . $nombre_imagen;

if (move_uploaded_file($_FILES['imagen']['tmp_name'], $guardar_imagen)) {
	echo "Imagen cargada";
} else {
	echo "Error al cargar la imagen";
}

?>