<?php 
	error_reporting (5);

	require_once('../core/conection.php');
	require_once('../core/process_util.php');
	
	
	$result = array();
	
	$tablename = "relaciones";
	
	$query = sprintf("SELECT * FROM `users_to_notify`");
	
	$data = mysql_query($query);
	

	while ($row = mysql_fetch_assoc($data))
	{	
		$result['users'][] = $row['email'];
	}
	
	mysql_free_result($data);
	
	$encoded  = json_encode($result);
	header('Content-Type: application/json');
	echo($encoded);
	
	?>
	

