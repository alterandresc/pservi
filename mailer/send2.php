<?php


require_once('../core/conection.php');

function api_request($url) {
    $call = curl_init($url);
    curl_setopt($call,CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($call);
    $result = json_decode($result,true);
    curl_close($call);
    return $result;
}

$period = "2014-4";

$actual_period_url = sprintf("http://popsyservicio.synapsis-rs.org/reports/report2_mailing.php");
$actual_period_results = api_request($actual_period_url);
$table_rows = '';

foreach($actual_period_results['centros'] as $centro)
{ 
        $table_rows .= '<tr>';
        $table_rows .= sprintf('<td> %s </td>',$centro['pais']);
        $table_rows .= sprintf('<td> %s </td>',$centro['ciudad']);
        $table_rows .= sprintf('<td> %s </td>',$centro['nombre']);
        $table_rows .= sprintf('<td> %s </td>',$centro['ponderado']);
}

$users_to_mailing_url = "http://popsyservicio.synapsis-rs.org/reports/report2_get_mailing_users.php";
$users_to_mail = api_request($users_to_mailing_url);
$para = implode(",",$users_to_mail['users']);





// Varios destinatarios
//$para  = 'andresc1125@gmail.com' . ', '; // atención a la coma
//$para .= 'ahcobos@yahoo.com';

// subject
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
   <p>En la tabla se encuentran los puntos de venta con niveles de satisfacción inferiores a 80%s. Este resultado corresponde a las evaluaciones hechas en el último fin de semana<p>
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
  Para consultar la evaluación completa de los puntos ingrese a este <a href="http://popsyservicio.synapsis-rs.org/index.php">Link</a>
</body>
</html>
',$css,'%',$table_rows);

// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'From: Recordatorio <notification@synapsis-rs.org>' . "\r\n";

echo $mensaje ; 
// Mail it
mail($para, $titulo, $mensaje, $cabeceras);
?>

