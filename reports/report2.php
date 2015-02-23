<?php 
	error_reporting (5);

	require_once('../core/conection.php');
	require_once('../core/process_util.php');
	
	
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
	 
	// $params['periods'] = array("2013-12","2014-1");
	
	function hallarNivel($params)
	{
		$n_p1 = obtener_promedio_acumulado_pregunta($params);
		if($n_p1 >= 4)
		{
			$n_p1 = "ALTO";
		}elseif($n_p1 >= 3)
		{
			$n_p1 = "MEDIO";
		}elseif($n_p1 < 3)
		{
			$n_p1 = "BAJO";
		}
		return $n_p1; 
	}
	
	function hallarDetractor($params)
	{
		$params['pregunta'] = "b1";
		
		$n_p1 = obtener_promedio_acumulado_pregunta($params);
		if($n_p1 >= 9)
		{
			$n_p1 = "PROMOTOR";
		}elseif($n_p1 >= 7)
		{
			$n_p1 = "NEUTRO";
		}elseif($n_p1 < 7)
		{
			$n_p1 = "DETRACTOR";
		}
		return $n_p1; 
	}
	
	function hallarEcpectativas($params)
	{
		$params['pregunta'] = "b2";
		
		$n_p1 = obtener_promedio_acumulado_pregunta($params);
		if($n_p1 >= 2)
		{
			$n_p1 = "IGUAL O MEJOR";
		}elseif($n_p1 < 2)
		{
			$n_p1 = "PEOR";
		}
		return $n_p1; 
	}
	

	while ($row = mysql_fetch_assoc($data))
	{
		$params['pdv'] = $row['c_costo_nombre'];
		
		
		$params['pregunta'] = "p1";
		$n_p1 = hallarNivel($params);
		
		$params['pregunta'] = "p2a";
		$n_p2a = hallarNivel($params);
		
		$params['pregunta'] = "p2b";
		$n_p2b = hallarNivel($params);
		
		$params['pregunta'] = "p2c";
		$n_p2c = hallarNivel($params);
		
		$params['pregunta'] = "p2d";
		$n_p2d = hallarNivel($params);
		
		$params['pregunta'] = "p2e";
		$n_p2e = hallarNivel($params);
		
		$params['pregunta'] = "p2f";
		$n_p2f = hallarNivel($params);
		
		$params['pregunta'] = "p3a";
		$n_p3a = hallarNivel($params);
		
		$params['pregunta'] = "p3b";
		$n_p3b = hallarNivel($params);
		
		$params['pregunta'] = "p3c";
		$n_p3c = hallarNivel($params);
		
		$params['pregunta'] = "p3d";
		$n_p3d = hallarNivel($params);
		
		$params['pregunta'] = "p3e";
		$n_p3e = hallarNivel($params);
		
		$params['pregunta'] = "p3f";
		$n_p3f = hallarNivel($params);
		
		$params['pregunta'] = "p3g";
		$n_p3g = hallarNivel($params);
		
		$params['pregunta'] = "p3h";
		$n_p3h = hallarNivel($params);
		
		$detractor = hallarDetractor($params);
		$expectativa = hallarEcpectativas($params);
		
		$params['no_header'] = true;
		$ponderado = obtener_general_acum_tiendas_v2($params);
		$result['centros'][] = array("nombre" => $row['c_costo_nombre'],
										"pais" => $row['pais'],
										"ciudad" =>$row['ciudad'],
										"regional" => $row['regional'],
										"zona" =>$row['zona'],
										"c_costo_id" =>$row['c_costo_id'],
										"razon_social" =>$row['unidad_negocio'],
										"ponderado" => $ponderado,
										"p1" => $n_p1,
										"p2a" => $n_p2a,
										"p2b" => $n_p2b,
										"p2c" => $n_p2c,
										"p2d" => $n_p2d,
										"p2e" => $n_p2e,
										"p2f" => $n_p2f,
										"p3a" => $n_p3a,
										"p3b" => $n_p3b,
										"p3c" => $n_p3c,
										"p3d" => $n_p3d,
										"p3e" => $n_p3e,
										"p3f" => $n_p3f,
										"p3g" => $n_p3g,
										"p3h" => $n_p3h,
										"detractor" => $detractor,
										"expectativa" => $expectativa);                      
	}
	
	mysql_free_result($data);
	
	$encoded  = json_encode($result);
	header('Content-Type: application/json');
	echo($encoded);
	
	?>
	

