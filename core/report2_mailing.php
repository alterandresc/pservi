<?php 
	error_reporting (5);

	require_once('../core/conection.php');
	require_once('../core/process_util.php');
	
	
	$periods_query = "SELECT `periodo`,`mes`,`time_stamp` FROM `dt_encuesta_popsy` group by `periodo`,`mes` order by `time_stamp` ";
	$periods_data = mysql_query($periods_query);
	$periods_info = array();
	while ($period_row = mysql_fetch_assoc($periods_data))
	{
		$periods_info[] = $period_row['periodo']."-".$period_row['mes'];
	}
	
	
	$result = array();
	
	$tablename = "relaciones";
	
	$query = sprintf("SELECT DISTINCT `c_costo_nombre`, `pais`,`ciudad`,`regional`,`zona`,`c_costo_id`,`unidad_negocio` FROM `%s` ",$tablename);
	
	$data = mysql_query($query);
	
	$params = array();
	
	$params['pregunta'] ;
	$params['pais'] = "todo";
	$params['ciudad']  = "todo";
	$params['region']  = "todo" ;
	$params['zona']  = "todo";
	$params['negocio']  = "todo";
	$params['pdv']  = "todo";
	
	if (isset($_GET['periods']))
		{
			//var_dump($_GET['periods']);
			$optionArray = $_GET['periods'];
			$params['periods'] = $optionArray;


			
		}else
		{
		$params['periods'] = array("2013-12");
		}
		
	$params['periods'] = array($periods_info[sizeof($periods_info) -1],$periods_info[sizeof($periods_info) -2],$periods_info[sizeof($periods_info) -3] );
	$params['last-id'] = "true";
	while ($row = mysql_fetch_assoc($data))
	{
		$params['pdv'] = $row['c_costo_nombre'];
		
		$params['no_header'] = true;
		$params['last-id'] = "true";
		$ponderado = obtener_general_acum_tiendas_v2($params);
		
		if($ponderado < 80 && $ponderado > 0 )
		{
		
		$result['centros'][] = array("nombre" => $row['c_costo_nombre'],
										"pais" => $row['pais'],
										"ciudad" =>$row['ciudad'],
										"regional" => $row['regional'],
										"zona" =>$row['zona'],
										"c_costo_id" =>$row['c_costo_id'],
										"razon_social" =>$row['unidad_negocio'],
										"ponderado" => $ponderado);   
		}
	}
	
	mysql_free_result($data);
	
	
	$notified_consult = "UPDATE `synapsis_tracking_popsy`.`dt_encuesta_popsy` SET `notified` = '1'";
	$notified_data = mysql_query($notified_consult);
	
	$encoded  = json_encode($result);
	header('Content-Type: application/json');
	echo($encoded);
	
	?>
	

