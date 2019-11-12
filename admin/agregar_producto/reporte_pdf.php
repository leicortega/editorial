<?php 

require('../assets/lib/pdf/mpdf.php');
require "../assets/config/ConexionBaseDatos_PDO.php";
$conexion = conectaDb();
$fecha = date("y/m/d");

if (isset($_REQUEST['edit'])) {	
	$edit = $_REQUEST['edit'];
	$sql = $conexion->prepare("select * from reporte where id_reporte = :id");
	$sql->bindParam(":id", $edit);
	$sql->execute();
	$resultado = $sql->fetchAll();
	foreach ($resultado as $row) {
		
	$html = '<header class="clearfix">
		      <div>
				<img src="img/logo_coo.jpg" />
			  </div>
		      <h1>REPORTE DE FALLA N°'.$edit.'</h1>
		      <div id="company" class="clearfix">
		        <div>Cootranshuila LTDA.</div>
		        <div>20'.$fecha.'<br /> Neiva, Huila</div>
		        <div>(57) 310 695 9595</div>
		        <div><a href="">clientes@cootranshuila.com</a></div>
		      </div>
		      <div id="project">
		        <div>Datos de quien reporta la falla:</div>
		        <div><span>NOMBRE</span>: '.$row["nombre"].'</div>
		        <div><span>CONTACTO</span>: '.$row["contacto"].'</div>
		      </div>
		    </header>
		    <main>
		    	<div class="dato">Datos del producto:</div>
		      <table>
		        <thead>
		          <tr>
		            <th>Placa</th>
					<th>Tipo</th>
					<th>Id o serie</th>
					<th>Observacion</th>
					
		          </tr>
		        </thead>
		        <tbody>
		          	echo "<tr>";
					echo "<td>'.$row["placa_carro"].'</td>";
					echo "<td>'.$row["tipo_prod"].'</td>";
					echo "<td>'.$row["id_prod"].'</td>";
					echo "<td>'.$row["observacion"].'</td>";
					
					echo "</tr>";
		        </tbody>
		      </table>
		      <div id="notices">
		        <div>NOTA:</div>
		        <div class="notice">Constancia de recibido de producto que reporta falla. Por favor guarde este documento. </div>
		      </div>
		    </main>
		    <footer>
		      COOTRANSHUILA LTDA. Llegamos lejos.
		    </footer>';

	}
	$mpdf = new mPDF('c', 'A4');
	$css = file_get_contents("css/style.css");
	$mpdf->WriteHTML($css, 1);
	$mpdf->WriteHTML($html, 2);
	$mpdf->Output('reporte_'.$edit.'.pdf', 'I');
	header("location:Index.php");
}

	if (isset($_REQUEST['san'])) {
		$san = $_REQUEST['san'];
		$sql = $conexion->prepare("select * from operativos where num_operativo = :id");
		$sql->bindParam(":id", $san);
		$sql->execute();
		$resultado = $sql->fetchAll();

		$sql = $conexion->prepare("select * from procedimiento where num_op_foreing = :i");
        $sql->bindParam(":i", $san);
        $sql->execute();
        $cont = $sql->rowCount();
        $res = $sql->fetchAll();

        if ($cont != 1) { 

        	$procedimiento = '
            <tbody>
                <tr align="center">
                    <td colspan="5"><p>Aun no hay datos de procedimiento para este operativo.</p></td>
                </tr>
            </tbody> ';
        } else{
        foreach ($res as $new) {

        	$procedimiento = '
              <tbody>
                <tr>
                  <td colspan="3">
                    <div class="form-group">
                      <label for="cargo" class=""><b>Cargo</b>&nbsp;&nbsp; '.$new['cargo'].'</label>
                    </div>
                  </td>
                  <td colspan="2">
                    <div class="form-group">
                      <label for="vinculacion" class=""><b>Vinculacion</b>&nbsp;&nbsp; '.$new['vinculacion'].'</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="5">
                    <div class="form-group">
                      <label for="falta"><b>Falta</b>&nbsp;&nbsp; '.$new['falta'].'</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <div class="form-group">
                      <label for="procedimiento" class=""><b>Procedimiento</b>&nbsp;&nbsp; '.$new['procedimiento'].'</label>
                    </div>
                  </td>
                  <td colspan="2">
                    <div class="form-group">
                      <label for="sancion" class=""><b>Sancion</b>&nbsp;&nbsp; '.$new['sancion'].'</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="5">
                    <div class="form-group">
                      <label for="observacion"><b>Observaciones</b>&nbsp;&nbsp; '.$new['observacion'].'</label>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <div class="form-group">
                      <label for="f_ini_suspen" class=""><b>Fecha de suspencion</b>&nbsp;&nbsp; '.$new['f_ini_suspen'].'</label>
                    </div>
                  </td>
                  <td colspan="2">
                    <div class="form-group">
                      <label for="f_fin_suspen" class=""><b>Fecha de terminacion</b>&nbsp;&nbsp; '.$new['f_fin_suspen'].'</label>
                    </div>
                  </td>
                </tr>
              </tbody>';
              	} 
            }

		foreach ($resultado as $row) {
		
		if ($row['presentacion_conductor'] == 'Bueno') {$rc1 = "✔";} else{$rc1 = "";} 
		if ($row['presentacion_conductor'] == 'Regular') {$rc2 = "✔";} else{$rc2 = "";} 
		if ($row['presentacion_conductor'] == 'Malo') {$rc3 = "✔";} else{$rc3 = "";} 

		if ($row['presentacion_auxiliar'] == 'Bueno') {$ra1 = "✔";} else{$ra1 = "";} 
		if ($row['presentacion_auxiliar'] == 'Regular') {$ra2 = "✔";} else{$ra2 = "";} 
		if ($row['presentacion_auxiliar'] == 'Malo') {$ra3 = "✔";} else{$ra3 = "";}

		if ($row['presentacion_vehiculo'] == 'Bueno') {$rv1 = "✔";} else{$rv1 = "";} 
		if ($row['presentacion_vehiculo'] == 'Regular') {$rv2 = "✔";} else{$rv2 = "";} 
		if ($row['presentacion_vehiculo'] == 'Malo') {$rv3 = "✔";} else{$rv3 = "";}
		echo $rc1;
		$html = '
				<div class="logo">
					<img src="../assets/img/logo_coo.jpg" />
				 </div>
				 <div class="info"><p><h4>Nit. 891.100.299-7</h4>
				 <h4 class="h42">Av 26 No. 4-82 Tel: 8756365 Neiva</h4></p></div>

				<div id="agg_sanciones" class="container tab-pane"><br>
				    <table class="table table-bordered">
				      <thead>
				        <tr align="center">
				          <th colspan="4">OPERATIVO DE CARRETERA</th>
				          <th colspan="1">
				            <div class="form-group"> 
				              <label for="num_operativo" class="col-md-2"><b>No. &nbsp;&nbsp;</b> '.$row['num_operativo'].'</label>
				            </div>
				          </th>
				        </tr>
				      </thead>
				      <tbody>

				        <tr>
				          <td colspan="5">
				            <div class="form-group">
				              <label for="nom_conductor" class="col-md-3"><b>Nombre del conductor &nbsp;&nbsp;</b> '.$row['nom_conductor'].'</label>
				            </div>
				          </td>
				        </tr>

				        <tr>
				          <td colspan="1">
				            <div class="form-group">
				              <label for="fecha_operativo" class="col-md"><b>Fecha </b><br> '.$row['fecha_operativo'].'</label>
				            </div>
				          </td>
				          <td colspan="1">
				            <div class="form-group">
				              <label for="hora_operativo" class="col-md"><b>Hora </b><br> '.$row['hora_operativo'].'</label>
				            </div>
				          </td>
				          <td colspan="1">
				            <div class="form-group">
				              <label for="placa_vehiculo" class="col-md"><b>Placa </b><br> '.$row['placa_vehiculo'].'</label>
				            </div>
				          </td>
				          <td colspan="1">
				            <div class="form-group">
				              <label for="modalidad" class="col-md"><b>Modalidad </b><br> '.$row['modalidad'].'</label>
				            </div>
				          </td>
				          <td colspan="1">
				            <div class="form-group">
				              <label for="num_vehiculo" class="col-md"><b>No. Vehiculo </b><br> '.$row['num_vehiculo'].'</label>
				            </div>
				          </td>
				        </tr>

				        <tr>
				          <td colspan="2">
				            <div class="form-group">
				              <label for="origen_ruta" class="col-md"><b>Origen </b><br> '.$row['origen_ruta'].'</label>
				            </div>
				          </td>
				          <td colspan="1">
				            <div class="form-group">
				              <label for="hora_salida" class="col-md"><b>Hora salida </b><br> '.$row['hora_salida'].'</label>
				            </div>
				          </td>
				          <td colspan="2">
				            <div class="form-group">
				              <label for="destino_ruta" class="col-md"><b>Destino </b><br> '.$row['destino_ruta'].'</label>
				            </div>
				          </td>
				        </tr>

				        <tr>
				          <td colspan="5">
				            <div class="form-group">
				              <label for="sitio_operativo" class="col-md-3"><b>Sitio del operativo &nbsp;&nbsp;</b> '.$row['sitio_operativo'].'</label>
				            </div>
				          </td>
				        </tr>

				        <tr>
				          <td colspan="3">
				            <div class="form-group">
				              <label for="pasajeros_con_tiquete" class="col-md-4"><b>Pasajeros con tiquete &nbsp;&nbsp;</b>'.$row['pasajeros_con_tiquete'].'</label>
				            </div>
				          </td>
				          <td colspan="2">
				            <div class="form-group">
				              <label for="pasajeros_sin_tiquete" class="col-md-5"><b>Pasajeros sin tiquete &nbsp;&nbsp;</b>'.$row['pasajeros_sin_tiquete'].'</label>
				            </div>
				          </td>
				        </tr>

				        <tr>
		                  <td colspan="2">
		                    <div class="form-group">
		                      <label for="" class="col-md-10">Presentacion del conductor </label>
		                    </div>
		                  </td>
		                  <td colspan="1">
		                    <div class="custom-control custom-radio custom-control-inline">
		                      <label class="custom-control-label" for="rc-Bueno">'.$rc1.'&nbsp; Bueno</label>
		                    </div>
		                  </td>
		                  <td colspan="1">
		                    <div class="custom-control custom-radio custom-control-inline">
		                      <label class="custom-control-label" for="rc-Regular">'. $rc2 .'&nbsp; Regular</label>
		                    </div>
		                  </td>
		                  <td colspan="1">
		                    <div class="custom-control custom-radio custom-control-inline">
		                      <label class="custom-control-label" for="rc-Malo">'. $rc3 .'&nbsp; Malo</label>
		                    </div>
		                  </td>
		                </tr>

		                <tr>
		                  <td colspan="2">
		                    <div class="form-group">
		                      <label for="" class="col-md-10">Presentacion del auxiliar </label>
		                    </div>
		                  </td>
		                  <td colspan="1">
		                    <div class="custom-control custom-radio custom-control-inline">
		                      <label class="custom-control-label" for="rc-Bueno">'.$ra1.'&nbsp; Bueno</label>
		                    </div>
		                  </td>
		                  <td colspan="1">
		                    <div class="custom-control custom-radio custom-control-inline">
		                      <label class="custom-control-label" for="rc-Regular">'. $ra2 .'&nbsp; Regular</label>
		                    </div>
		                  </td>
		                  <td colspan="1">
		                    <div class="custom-control custom-radio custom-control-inline">
		                      <label class="custom-control-label" for="rc-Malo">'. $ra3 .'&nbsp; Malo</label>
		                    </div>
		                  </td>
		                </tr>

		                <tr>
		                  <td colspan="2">
		                    <div class="form-group">
		                      <label for="" class="col-md-10">Presentacion del vehiculo </label>
		                    </div>
		                  </td>
		                  <td colspan="1">
		                    <div class="custom-control custom-radio custom-control-inline">
		                      <label class="custom-control-label" for="rc-Bueno">'.$rv1.'&nbsp; Bueno</label>
		                    </div>
		                  </td>
		                  <td colspan="1">
		                    <div class="custom-control custom-radio custom-control-inline">
		                      <label class="custom-control-label" for="rc-Regular">'. $rv2 .'&nbsp; Regular</label>
		                    </div>
		                  </td>
		                  <td colspan="1">
		                    <div class="custom-control custom-radio custom-control-inline">
		                      <label class="custom-control-label" for="rc-Malo">'. $rv3 .'&nbsp; Malo</label>
		                    </div>
		                  </td>
		                </tr>

				        <tr>
				          <td colspan="5">
				            <div class="form-group">
				              <label for="observaciones"><b>Observaciones: &nbsp;&nbsp;</b>'.$row['observaciones'].'</label>
				            </div>
				          </td>
				        </tr>

				      </tbody>

					  <thead>
		                <tr align="center">
		                  <th colspan="5">Procedimiento</th>
		                </tr>
		              </thead>

					  '.$procedimiento.'


				    </table>
				  </div>
				  <footer>
		    	    COOTRANSHUILA LTDA. Llegamos lejos.
		    	  </footer>';

		}
		$mpdf = new mPDF('c', 'A4');
		$css = file_get_contents("../assets/css/estiloPDFsancion.css");
		$mpdf->WriteHTML($css, 1);
		$mpdf->WriteHTML($html, 2);
		$mpdf->Output('operativo_'.$san.'.pdf', 'I');
		header("location:Sanciones.php");
		}

?>

