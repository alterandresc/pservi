<?php


//$mkdirectorio = 'http://www.synapsis-rs.com/familia/';
//$mklibrerias = 'http://www.synapsis-rs.com/_librerias/';

// Conexion de Seguridad
$mysql_hostname = "localhost";
$mysql_user = "synapsis_vsr";
//$mysql_user = "root";
$mysql_password = "vsr123=";
//$mysql_password = "sky123";
$mysql_database = "synapsis_tracking_popsy";
//$mysql_database = "visor";

$connect = mysql_connect($mysql_hostname, $mysql_user, $mysql_password);
mysql_select_db("synapsis_tracking_popsy"); 




?>
