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
			var_dump($actual_period_results);
			foreach($actual_period_results['centros'] as $centro)
			{ 
							$table_rows .= '<tr>';
							$table_rows .= sprintf('<td> %s </td>',$centro['pais']);
							$table_rows .= sprintf('<td> %s </td>',$centro['ciudad']);
							$table_rows .= sprintf('<td> %s </td>',$centro['pventa']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p1']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p2a']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p2b']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p2c']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p2d']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p2e']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p2f']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p3a']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p3b']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p3c']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p3d']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p3e']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p3f']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p3g']);
							$table_rows .= sprintf('<td> %s </td>',$centro['p3h']);
                                                        $table_rows .= sprintf('<td> %s </td>',$centro['b1']);
                                                        $table_rows .= sprintf('<td> %s </td>',$centro['b1_razones']);
                                                        $table_rows .= sprintf('<td> %s </td>',$centro['b2']);
                                                        $table_rows .= sprintf('<td> %s </td>',$centro['b2_razones']);
							$table_rows .= '</tr>';			
			}
			
			if(sizeof($actual_period_results['centros']) == 0 )
			{
			  $table_rows .= "En esta medición ningún punto tuvo bajas calificaciones.<br>";
			}
			$titulo = 'Evaluación Experiencia del Servicio - Nuevas Encuestas En El Sistema ';
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
				<p>En la tabla se encuentran las evaluaciones realizadas en los últimos días<p>
			<br/>
			<br/>  
			<table>
					<tr>
						<th>País</th><th>Ciudad</th><th>Punto de venta </th><th>P1</th><th>P2A</th><th>P2B</th><th>P2C</th><th>P2D</th><th>P2E</th><th>P2F</th><th>P3A</th><th>P3B</th><th>P3C</th><th>P3D</th><th>P3E</th><th>P3F</th><th>P3G</th><th>P3H</th><th>B1</th><th>Razones B1 </th><th>B2</th><th> Razones B2</th>
					</tr>
					%s
				</table>
				<br/>
				<br/>
                        <table>
                          <tr><th> Label </th><th> Pregunta </th></tr>
                          <tr>
                            <td>
                              P1
                            </td>
                            <td>
                              ¿Qué tan satisfecho estuvo usted hoy en general con su experiencia de compra en Popsy?
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P2A
                            </td>
                            <td>
                              ¿Qué tan satisfecho o insatisfecho se encuentra usted con la amabilidad del personal que lo atendió? 
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P2B
                            </td>
                            <td>
                               ¿Qué tan satisfecho o insatisfecho se encuentra usted con la limpieza/aseo del uniforme del personal? 
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P2C
                            </td>
                            <td>
                                ¿Qué tan satisfecho o insatisfecho se encuentra usted con el tiempo de espera en la caja mientras le tomaban su pedido?
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P2D
                            </td>
                            <td>
                                ¿Qué tan satisfecho o insatisfecho se encuentra usted con el tiempo de espera para que le entregaran el pedido?
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P2E
                            </td>
                            <td>
                                ¿Qué tan satisfecho o insatisfecho se encuentra usted con la asesoría y acompañamiento que le brindó el personal?
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P2F
                            </td>
                            <td>
                                ¿Qué tan satisfecho o insatisfecho se encuentra usted con la solución a todos los problemas / inquietudes que se le presentaron a usted durante su visita?
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P3A
                            </td>
                            <td>
                                Teniendo en cuenta la siguiente escala, qué tan de acuerdo está usted enque el día de hoy en POPSY se sintió a gusto y en confianza
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P3B
                            </td>
                            <td>
                                Teniendo en cuenta la siguiente escala, qué tan de acuerdo está usted enque el día de hoy en POPSY las personas que lo atendieron conocen lo que usted quiere
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P3C
                            </td>
                            <td>
                                Teniendo en cuenta la siguiente escala, qué tan de acuerdo está usted enque el día de hoy en POPSY el servicio que recibió lo hizo feliz
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P3D
                            </td>
                            <td>
                                Teniendo en cuenta la siguiente escala, qué tan de acuerdo está usted enque el día de hoy en POPSY estaba limpio y ordenado
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P3E
                            </td>
                            <td>
                                Teniendo en cuenta la siguiente escala, qué tan de acuerdo está usted enque el día de hoy en POPSY el personal que lo atendió era alegre
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P3F
                            </td>
                            <td>
                                Teniendo en cuenta la siguiente escala, qué tan de acuerdo está usted enque el día de hoy en POPSY el personal lo hizo sentir un cliente especial
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P3G
                            </td>
                            <td>
                                Teniendo en cuenta la siguiente escala, qué tan de acuerdo está usted enque el día de hoy en POPSY es un sitio para invitar a alguien
                            </td>
                          </tr>
                          <tr>
                            <td>
                              P3H
                            </td>
                            <td>
                                Teniendo en cuenta la siguiente escala, qué tan de acuerdo está usted enque el día de hoy en POPSY lo atendieronmás rápido que en otras heladerías
                            </td>
                          </tr>
                          <tr>
                            <td>
                              B1
                            </td>
                            <td>
                                 Utilizando una escala de 10 puntos, donde 1 es Definitivamente NO la recomendaría y10 Definitivamente SI la recomendaría  ¿Qué tanto Recomendaría Usted a un familiar o amigo, venir a este punto de venta Popsy?                            </td>
                          </tr>
                          <tr>
                            <td>
                              B2
                            </td>
                            <td>
                                De acuerdo con la siguiente escala (1,2,3) ¿Diría usted que en general el servicio que recibió en POPSY el día de hoy ha sido…?
                            </td>
                          </tr>
                        </table>
				Para consultar la evaluación completa de los puntos ingrese a este <a href="http://popsyservicio.synapsis-rs.org/index.php">Link</a>
			</body>
			</html>
			',$css,$table_rows);

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


function getReceivePerCustom($type, $value)
{
	$periods_query = sprintf("SELECT * FROM `users_to_notify` WHERE `type` = '%s' and `value`= '%s';",$type,$value);
	echo $periods_query;
	$periods_data = mysql_query($periods_query);
	$mails = array();
	while ($mail_row = mysql_fetch_assoc($periods_data))
	{
		$mails['users'][] = $mail_row['email'];
	}
	
	return $mails;
}
$actual_period_url = sprintf("http://popsyservicio.synapsis-rs.org/reports/report2_mailingLive.php");
$actual_period_results = api_request($actual_period_url);


var_dump($actual_period_results );

if(sizeof($actual_period_results['centros']) > 0 )
{
 
    $receive_all = getReceiveAllMails();

    //enviar notification a los usuarios que deben recibir todos los correos
    sendEmail($actual_period_results, $receive_all);


    //enviar notificaciones a los responsables por pais
    $countries = array();

    foreach($actual_period_results['centros'] as $centro)
    {
	    $countries[$centro['pais']]['centros'][] = $centro;
    }

    foreach($countries as $name => $country)
    {
      echo "pais ".$name."<br>";
      var_dump(getReceivePerCustom('pais',$name));
      sendEmail($country, getReceivePerCustom('pais',$name));
    }

    //enviar notificaciones por ciudad

    $cities = array();

    foreach($actual_period_results['centros'] as $centro)
    {
	    $cities[$centro['ciudad']]['centros'][] = $centro;
    }

    foreach($cities as $name => $city)
    {
      echo "ciudad ".$name."<br>";
      var_dump(getReceivePerCustom('ciudad',$name));
      sendEmail($city, getReceivePerCustom('ciudad',$name));
    }

    //enviar notificaciones por zona

    $zones = array();

    foreach($actual_period_results['centros'] as $centro)
    {
	    $zones[$centro['zona']]['centros'][] = $centro;
    }

    foreach($zones as $name => $zone)
    {
      echo "zona ".$name."<br>";
      var_dump(getReceivePerCustom('zona',$name));
      sendEmail($zone, getReceivePerCustom('zona',$name));
    }



    //enviar notificaciones por regional
      $regions = array();


    foreach($actual_period_results['centros'] as $centro)
    {
	    $regions[$centro['regional']]['centros'][] = $centro;
    }

    foreach($regions as $name => $zone)
    {
      echo "zona ".$name."<br>";
      var_dump(getReceivePerCustom('zona',$name));
      sendEmail($zone, getReceivePerCustom('regional',$name));
    }
    //enviar notificaciones  a los responsables de cada pdv
    $receive_per_pdv =array();

    foreach($actual_period_results['centros'] as $centro)
    {
      echo "pdv ".$centro['pventa']."<br>";
      var_dump(getReceivePerCustom('pdv',$centro['pventa']));
	    $receive_per_pdv[$centro['pventa']]['info'] = $centro;
	    $tmp['centros'] = array($centro);
	    sendEmail($tmp, getReceivePerCustom('pdv',$centro['pventa']));
    }
    
}

?>

