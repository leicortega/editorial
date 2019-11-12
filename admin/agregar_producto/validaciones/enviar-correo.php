<?php 

extract($_REQUEST);
extract($_POST);

require "../../assets/config/ConexionBaseDatos_PDO.php";
require "../../postulados/seg.php";
require '../../assets/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$objConexion=conectaDb();

//SE hace la consulta de la sancion recibiendo la variable num
$sql = $objConexion->prepare('SELECT * from operativos o, procedimiento p where o.num_operativo = :num and o.num_operativo = p.num_op_foreing;');
$sql->bindParam(':num', $_REQUEST['num']);
$sql->execute();

foreach ($sql->fetchAll() as $row) {
	$nombre = $row['nom_conductor'];
	$fecha_ini = $row['f_ini_suspen'];
	$fecha_fin = $row['f_fin_suspen'];
}

$dia_ini = substr($fecha_ini, 0, 2);
$mes_ini = substr($fecha_ini, 3, 2);
$ano_ini = substr($fecha_ini, 6, 4);

$dia_fin = substr($fecha_fin, 0, 2); 
$mes_fin = substr($fecha_fin, 3, 2);
$ano_fin = substr($fecha_fin, 6, 4);

switch ($mes_ini) {
	case '01':
		$mes_1 = 'Enero';
		$diasxmes_1 = 31;
		break;
	case '02':
		$mes_1 = 'Febrero';
		$diasxmes_1 = 28;
		break;
	case '03':
		$mes_1 = 'Marzo';
		$diasxmes_1 = 31;
		break;
	case '04':
		$mes_1 = 'Abril';
		$diasxmes_1 = 30;
		break;
	case '05':
		$mes_1 = 'Mayo';
		$diasxmes_1 = 31;
		break;
	case '06':
		$mes_1 = 'Junio';
		$diasxmes_1 = 30;
		break;
	case '07':
		$mes_1 = 'Julio';
		$diasxmes_1 = 31;
		break;
	case '08':
		$mes_1 = 'Agosto';
		$diasxmes_1 = 31;
		break;
	case '09':
		$mes_1 = 'Septiembre';
		$diasxmes_1 = 30;
		break;
	case '10':
		$mes_1 = 'Octubre';
		$diasxmes_1 = 31;
		break;
	case '11':
		$mes_1 = 'Noviembre';
		$diasxmes_1 = 30;
		break;
	case '12':
		$mes_1 = 'Diciembre';
		$diasxmes_1 = 31;
		break;
}

switch ($mes_fin) {
	case '01':
		$mes_2 = 'Enero';
		$diasxmes_2 = 31;
		break;
	case '02':
		$mes_2 = 'Febrero';
		$diasxmes_2 = 28;
		break;
	case '03':
		$mes_2 = 'Marzo';
		$diasxmes_2 = 31;
		break;
	case '04':
		$mes_2 = 'Abril';
		$diasxmes_2 = 30;
		break;
	case '05':
		$mes_2 = 'Mayo';
		$diasxmes_2 = 31;
		break;
	case '06':
		$mes_2 = 'Junio';
		$diasxmes_2 = 30;
		break;
	case '07':
		$mes_2 = 'Julio';
		$diasxmes_2 = 31;
		break;
	case '08':
		$mes_2 = 'Agosto';
		$diasxmes_2 = 31;
		break;
	case '09':
		$mes_2 = 'Septiembre';
		$diasxmes_2 = 30;
		break;
	case '10':
		$mes_2 = 'Octubre';
		$diasxmes_2 = 31;
		break;
	case '11':
		$mes_2 = 'Noviembre';
		$diasxmes_2 = 30;
		break;
	case '12':
		$mes_2 = 'Diciembre';
		$diasxmes_2 = 31;
		break;
}

if ($mes_ini == $mes_fin) {
	$dias_sancion = 1;
	while ($dia_ini <> $dia_fin) {
		$dias_sancion = $dias_sancion + 1;
		$dia_ini++;
	}
} else {
	$dias_sancion = ($diasxmes_1 - $dia_ini) + $dia_fin + 1;
}


$men = "Cordial saludo, \n\nInformo suspensión del señor ".$nombre." por el término de ".$dias_sancion." días a partir de hoy ".$dia_ini." de ".$mes_1." de ".$ano_ini.". Ingresa a rodamiento el ".($dia_fin+1)." de ".$mes_2." de ".$ano_fin.".\n\nGracias,\n\nCorreo generado por el aplicativo de sanciones. (favor verificar informacion)";

// print_r($men);

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'clientes@cootranshuila.com';       // SMTP username
$mail->Password = 'jhon891100';                       // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('clientes@cootranshuila.com', 'Clientes Cootranshuila');
$mail->addAddress('pasajes_neiva@cootranshuila.com', 'Pedro Diaz');     
$mail->addAddress('asistente_recursoshumanos@cootranshuila.com', 'Piedad Galindez');     

$mail->Subject = 'SUSPENCION';
$mail->Body    = $men;

if(!$mail->send()) {
    echo 'Error del mensaje: ' . $mail->ErrorInfo;
} else {
    echo 'Ok';
}

?>