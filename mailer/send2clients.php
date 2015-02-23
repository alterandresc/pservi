<?php
error_reporting (5);
require_once('../core/conection.php');

function api_request($url) {
    $call = curl_init($url);
    curl_setopt($call,CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($call);
    $result = json_decode($result,true);
    curl_close($call);
    return $result;
}

function sendEmail($actual_period_results,$mails)
{

			$table_rows = '';
			$para = implode(",",$mails['users']);
			$con = 1;
			foreach($actual_period_results['centros'] as $centro)
			{ 
							$table_rows .= '<tr>';
							$table_rows .= sprintf('<td> %s </td>',$centro['pais']);
							$table_rows .= sprintf('<td> %s </td>',$centro['ciudad']);
							$table_rows .= sprintf('<td> %s </td>',$centro['nombre']);
							$table_rows .= sprintf('<td> %s </td>',$centro['ponderado']);
							$table_rows .= '</tr>';			
			}
			
			if(sizeof($actual_period_results['centros']) == 0 )
			{
			  $table_rows .= "En esta medición ningún punto tuvo bajas calificaciones.<br>";
			}
			$titulo = 'Evaluación Experiencia del Servicio - Alerta Calificaciones bajas (Menores a 80%)';
			$css = 'table {
				width: 650px;
				border-collapse:collapse;
				border:1px solid #FFCA5E;
			}
			caption {
				font: 1.8em/1.8em Arial, Helvetica, sans-serif;
				text-align: left;
				text-indent: 10px;
				background: url(bg_caption.jpg) right top;
				height: 45px;
				color: #FFAA00;
			}
			thead th {
				background: url(bg_th.jpg) no-repeat right;
				height: 47px;
				color: #FFFFFF;
				font-size: 0.8em;
				font-weight: bold;
				padding: 0px 7px;
				margin: 20px 0px 0px;
				text-align: left;
				border-right: 1px solid #FCF1D4;
			}
			tbody tr {
			background: url(bg_td1.jpg) repeat-x top;
			}
			tbody tr.odd {
				background: #FFF8E8 url(bg_td2.jpg) repeat-x;
			}

			tbody th,td {
				font-size: 0.8em;
				line-height: 1.4em;
				font-family: Arial, Helvetica, sans-serif;
				color: #777777;
				padding: 10px 7px;
				border-top: 1px solid #FFCA5E;
				border-right: 1px solid #DDDDDD;
				text-align: left;
			}
			a {
				color: #777777;
				font-weight: bold;
				text-decoration: underline;
			}
			a:hover {
				color: #F8A704;
				text-decoration: underline;
			}
			tfoot th {
				background: url(bg_total.jpg) repeat-x bottom;
				color: #FFFFFF;
				height: 30px;
			}
			tfoot td {
				background: url(bg_total.jpg) repeat-x bottom;
				color: #FFFFFF;
				height: 30px;
			}';

			// message
			$mensaje = sprintf('
			<html>
			<head>
				<title></title>

				<style>
					%s   
				</style>
			</head>
			<body>
				<p>En la tabla se encuentran los puntos de venta con niveles de satisfacción inferiores a 80%s. Este resultado corresponde a las evaluaciones hechas hasta la fecha en el mes de Junio<p>
			<br/>
			<br/>  
			<table>
					<tr>
						<th>País</th><th>Ciudad</th><th>Punto de venta </th><th>satisfacción general</th>
					</tr>
					%s
				</table>
				<br/>
				<br/>
// 				Para consultar la evaluación completa de los puntos ingrese a este <a href="http://popsyservicio.synapsis-rs.org/index.php">Link</a>
			</body>
			</html>
			',$css,'%',$table_rows);

			// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

			// Cabeceras adicionales
			$cabeceras .= 'From: Notification <notification@synapsis-rs.org>' . "\r\n";

			echo $mensaje ; 
			// Mail it
			mail($para, $titulo, $mensaje, $cabeceras);
}

function getReceiveAllMails()
{
	$periods_query = "SELECT `id`,`type`,`value`, `email` FROM `users_to_notify` WHERE `type` = 'all';";
	$periods_data = mysql_query($periods_query);
	$mails = array();
	while ($mail_row = mysql_fetch_assoc($periods_data))
	{
		$mails['users'][] = $mail_row['email'];
	}
	
	return $mails;
}

function getReceivePerPDV($name)
{
	$periods_query = sprintf("SELECT `id`,`type`,`value`, `email` FROM `users_to_notify` WHERE `type` = 'pdv' and `value`= '%s';",$name);
	$periods_data = mysql_query($periods_query);
	$mails = array();
	while ($mail_row = mysql_fetch_assoc($periods_data))
	{
		$mails['users'][] = $mail_row['email'];
	}
	
	return $mails;
}

$actual_period_url = sprintf("http://popsyservicio.synapsis-rs.org/reports/report2_mailing.php");
$actual_period_results = api_request($actual_period_url);

 
$receive_all = getReceiveAllMails();
sendEmail($actual_period_results, $receive_all);




$receive_per_pdv = array();

foreach($actual_period_results['centros'] as $centro)
{
	$receive_per_pdv[$centro['c_costo_id']]['mails'] = getReceivePerPDV($centro['nombre']);
	$receive_per_pdv[$centro['c_costo_id']]['info'] = $centro;
	$tmp['centros'] = array($centro);
	sendEmail($actual_period_results, getReceivePerPDV($centro['nombre']));
}






// Varios destinatarios
//$para  = 'andresc1125@gmail.com' . ', '; // atención a la coma
//$para .= 'ahcobos@yahoo.com';

// subject



?>

