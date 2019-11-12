<?php

	function conectaDb() {

		$host='localhost';
		$dbname='editorial';
		$user='root';
		$pass=''; 

		try {

			$pdo = new PDO("mysql: host=$host; dbname=$dbname; charset=utf8", $user, $pass);
			return $pdo;

			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "Conectado a la base de datos.";
		}
		catch(PDOException $e) {
			echo "Error en la conexion ".$e->getMessage();

		}
	}

?>