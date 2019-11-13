<?php 

extract($_REQUEST);
extract($_POST);

require "../../assets/config/ConexionBaseDatos_PDO.php";

require "../../assets/config/seguridad.php";
$conexion=conectaDb();

$ruta = "../../assets/img/productos/";
$nombre_imagen = "imagen_".date("dHis").".".pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
$guardar_imagen = $ruta . $nombre_imagen;

$sql = $conexion->prepare("INSERT INTO `producto_editorial` (`id_producto`, `nombre_producto`, `descripcion_producto`, `precio_producto`, `autor_producto`, `editorial_producto`, `edicion_producto`, `formato_producto`, `ISBN_producto`, `facultad`, `n_paginas`, `idioma`, `terminado`, `alto_ancho`, `imagen`, `id_categoria_fk`) VALUES (NULL, :nombre_producto, :descripcion_producto, :precio_producto, :autor_producto, :editorial_producto, :edicion_producto, :formato_producto, :ISBN_producto, :facultad, :n_paginas, :idioma, :terminado, :alto_ancho, :imagen, 1)");
$sql->bindParam(":nombre_producto", $_POST['nombre_producto'], PDO::PARAM_STR);
$sql->bindParam(":descripcion_producto", $_POST['descripcion_producto'], PDO::PARAM_STR);
$sql->bindParam(":precio_producto", $_POST['precio_producto'], PDO::PARAM_INT);
$sql->bindParam(":autor_producto", $_POST['autor_producto'], PDO::PARAM_STR);
$sql->bindParam(":editorial_producto", $_POST['editorial_producto'], PDO::PARAM_STR);
$sql->bindParam(":edicion_producto", $_POST['edicion_producto'], PDO::PARAM_INT);
$sql->bindParam(":formato_producto", $_POST['formato_producto'], PDO::PARAM_STR);
$sql->bindParam(":ISBN_producto", $_POST['ISBN_producto'], PDO::PARAM_STR);
$sql->bindParam(":facultad", $_POST['facultad'], PDO::PARAM_STR);
$sql->bindParam(":n_paginas", $_POST['n_paginas'], PDO::PARAM_INT);
$sql->bindParam(":idioma", $_POST['idioma'], PDO::PARAM_STR);
$sql->bindParam(":terminado", $_POST['terminado'], PDO::PARAM_STR);
$sql->bindParam(":alto_ancho", $_POST['alto_ancho'], PDO::PARAM_STR);
$sql->bindParam(":imagen", $nombre_imagen, PDO::PARAM_STR);
$sql->execute();
if ($sql->rowCount() == 1) {

	if (move_uploaded_file($_FILES['imagen']['tmp_name'], $guardar_imagen)) {
		// $datos = json_decode( $_POST['datos']);
		// print_r($datos['nombre_producto']);
		// foreach ($_POST['datos']->fetchAll() as $row) {
		// 	echo "<br>".$row['nombre_producto'];
		// 	echo "<br>".$row['descripcion_producto'];
		// 	echo "<br>".$row['precio_producto'];
		// 	echo "<br>".$row['autor_producto'];
		// 	echo "<br>".$row['editorial_producto'];
		// 	echo "<br>".$row['edicion_producto'];
		// 	echo "<br>".$row['formato_producto'];
		// 	echo "<br>".$row['ISBN_producto'];
		// 	echo "<br>".$row['facultad'];
		// 	echo "<br>".$row['n_paginas'];
		// 	echo "<br>".$row['idioma'];
		// 	echo "<br>".$row['terminado'];
		// 	echo "<br>".$row['alto_ancho'];
		// }
	
		
		// echo "<br>".$nombre_imagen;
	
		
		
		// echo $sql->rowCount();
		
		header("location:../");
	
	} else {
		echo "Se hizo la consulta pero no se guardo la imagen, contacte al administrador";
	}

} else {
	print_r( $sql->errorInfo() );
}



?>