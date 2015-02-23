<?php 
	error_reporting (5);

	require_once('../core/conection.php');
	
	
	$result = array();
	
	$tablename = "dt_encuesta_popsy";
	
	$query = sprintf("SELECT * FROM `dt_encuesta_popsy` WHERE `synchronized` = 0 ORDER BY `id` limit 100");
	
	
	$data = mysql_query($query);
	

	while ($row = mysql_fetch_assoc($data))
	{	
		$result['encuestas'][] = $row;
	}
	
	$query = sprintf("UPDATE `synapsis_tracking_popsy`.`dt_encuesta_popsy` SET `synchronized` = '1' WHERE `synchronized` = '0'  ORDER BY `id` limit 100;");
	$data = mysql_query($query);
	
	
	mysql_free_result($data);
	
	$encoded  = json_encode($result);
	header('Content-Type: application/json');
	
	echo($encoded);
	
	?>
	

