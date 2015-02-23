<?php


require_once('../core/conection.php');

// Varios destinatarios
$para  = 'juan.rodriguez@synapsis-rs.com' . ', '; // atención a la coma

// subject
$titulo = 'Nuevas Evaluaciones Popsy';


// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'From: Recordatorio <notification@synapsis-rs.com>' . "\r\n";

	$notified_consult = "SELECT * FROM `dt_encuesta_popsy` WHERE `synchronized` = 0";
	$notified_data = mysql_query($notified_consult);
	$cantidad = mysql_num_rows($notified_data);

$mensaje = sprintf("Buen día, hay %s encuestas nuevas en la base de datos, por favor eliminar las repetidas,
						luego ir a la hoja de evaluaciones y actualizarlas, Gracias.",$cantidad);

echo $mensaje ; 
// Mail it
mail($para, $titulo, $mensaje, $cabeceras);
?>

