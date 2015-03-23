<?php

or die ("Fallo en el establecimiento de la conexion");

mysql_select_db("synapsis_tracking_popsy")
or die("Error en la seleccion de la base de datos");
//mysql_close($conexion);

mysql_set_charset('utf8');
?>