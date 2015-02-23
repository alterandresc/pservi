<?php 
	error_reporting (5);
	session_start(); 
	require_once('conection.php');
	require_once('params_processor.php');
	require_once('process_util.php');
	require_once('process_util_filters.php');
	require_once('keep_filters.php');
	
	
	$filters = getFilterParams();
	if(isset($filters['register']))
	{
		register_filters($filters);
	}
	$response =  get_registered_filters();
	$encoded = json_encode($response);
	
	header('Content-Type: application/json');
	echo($encoded);
	
	
	//$devu = array();
	
	//$devu[] = array('x','alto','medio','bajo');
	//$devu[] = array('Dic-13',0.8,0.5,0.1);
	//$devu[] = array('Ene-14',0.5,0.3,0.2);
	//$devu[] = array('Feb-14',0.7,0.4,0.1);
	
	//$codified = json_encode($devu);
	//echo $codified;
	
	
	mysql_close($conexion);
?>
