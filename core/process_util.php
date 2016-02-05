<?php 

ini_set("log_errors", 5);
ini_set("error_log", "ac_errors.log");

	function executeRequest($params)
	{
		$can_datos = hallar_cantidad_datos($params);
                if(cacheIsValid($can_datos, $params))
                {
                  return getCacheValue($params);
                }
                $to_return = "";
		switch ($params['nombre_grafica']) {
			case 'general_acum':
                                $to_return = obtener_general_acum($params);
				break;
			case 'obtener_promediop2_acum':
				$to_return =  obtener_promediop2_acum($params);
				break;
			case 'obtener_promediop3_acum':
				$to_return =  obtener_promediop3_acum($params);
				break;
			case 'obtener_satisfaccion_general_periodo':
				$to_return =  obtener_satisfaccion_general_periodo($params);
				break;
			case 'obtener_satisfaccion_general_periodo_multi':
				$to_return =  obtener_satisfaccion_general_periodo_multi($params);
				break;
			case 'obtener_promedio_acumulado_multi':
				$to_return =  obtener_promedio_acumulado_multi($params);
				break;
			case 'obtener_general_acum_b':
				$to_return =  obtener_general_acum_b($params);
				break;
			case 'obtener_satisfaccion_general_periodo_b':
				$to_return =  obtener_satisfaccion_general_periodo_b($params);
				break;
			case 'obtener_general_acum_b2':
				$to_return =  obtener_general_acum_b2($params);
				break;
			case 'obtener_satisfaccion_general_periodo_b2':
				$to_return =  obtener_satisfaccion_general_periodo_b2($params);
				break;
			case 'obtener_general_acum_tiendas':
				$to_return =  obtener_general_acum_tiendas($params);
				break;
			case 'obtener_general_acum_tiendas_relojes':
				$to_return =  obtener_general_acum_tiendas_relojes($params);
				break;
			case 'obtener_general_acum_tiendas_v2':
				$to_return =  obtener_general_acum_tiendas_v2($params);
				break;
			case 'obtener_promedio_acumulado_pregunta':
				$to_return =  obtener_promedio_acumulado_pregunta($params);
				break;
			case 'obtener_indice_tienda':
				$to_return =  obtener_indice_tienda($params['pregunta'],4.0,2.9,20,20*0.8,0);
				break;
			case 'obtener_pdvs_segun_filtros':
				$to_return =  obtener_pdvs_segun_filtros($params);
				break;
		}
		generateCache($can_datos,$params,$to_return);
		return $to_return;
	}
	
	function obtenerQueryLastId($id)
	{
		$lIdQuery = "";
		if($id == "true")
		{
			$lIdQuery = " and  `notified` = 0";
		}
		return $lIdQuery; 
	}
	
	function obtenerQueryPdvAcum($pdv)
	{
		$pdvQuery = "";
		if($pdv != 'todo')
		{
			$pdvQuery = sprintf("and  `pventa` = '%s'",$pdv);
		}
		return $pdvQuery; 
	}
	
	function obtenerQueryCuidad($ciudad)
	{
		$ciudadQuery = "";
		if($ciudad != 'todo')
		{
			$ciudadQuery= "and  `ciudad` LIKE  '%".$ciudad."%'";
		}
		return $ciudadQuery; 
	}
	
	function obtenerQueryPais($pais)
	{
		$paisQuery = "";
		if($pais != 'todo')
		{
			$paisQuery= "and  `pais` LIKE  '%".$pais."%'";
		}
		return $paisQuery; 
	}
	
	function obtenerQueryRegion($region)
	{
		$regionQuery = "";
		if($region != 'todo')
		{
			$regionQuery= "and  `regional` LIKE  '%".$region."%'";
		}
		return $regionQuery; 
	}
	
	function obtenerQueryZona($zona)
	{
		$zonaQuery = "";
		if($zona != 'todo')
		{
			$zonaQuery= "and  `zona` LIKE  '%".$zona."%'";
		}
		return $zonaQuery; 
	}
	
	//query de razon social 
	function obtenerQueryRazon($razon)
	{
		$razonQuery = "";
		if($razon != 'todo')
		{
			$razonQuery= "and  `razon_social` LIKE  '%".$razon."%'";
		}
		return $razonQuery; 
	}
	
	function obtenerQueryBandera($bandera)
	{
		$banderaQuery = "";
		if($bandera != 'todo')
		{
			$banderaQuery= "and  `bandera` LIKE  '%".$bandera."%'";
		}
		return $banderaQuery; 
	}
	
	function obtenerQueryPeriodo($periodos = array(),$opt = "")
	{
		$periodosQuery = "";
		if(!empty($periodos))
		{
			$periodosQuery ="and (";
			if($opt == "no_and")
			{
				$periodosQuery ="(";
			}
			$subQueries = array();
			foreach($periodos as $periodo)
			{
				$fecha = $periodo;
				$fecha =  explode("-",$fecha);
				$anio = $fecha[0];
				$mes = $fecha[1];
				$subQueries[] = sprintf("( periodo =  %s   and mes = %s)",$anio,$mes);
			}
			$preQuery = implode(" or ",$subQueries);
			$periodosQuery = $periodosQuery.$preQuery.")";
		}
		else
		{
			$periodosQuery = "and periodo = '' and mes = ''";
			if($opt == "no_and")
			{
				$periodosQuery ="periodo = '' and mes = ''";
			}
		}
		
		return $periodosQuery; 
		
	}
	
	function redondeado ($numero, $decimales)
	{
		$factor = pow(10, $decimales);
		return (round($numero*$factor)/$factor);
	} 
	 
	function hallar_cantidad_datos($params)
	{
		$tablename="dt_encuesta_popsy";
		$pregunta = $params['pregunta'];
		$pais = $params['pais'];
		$ciudad = $params['ciudad'];
		$region = $params['region'];
		$zona = $params['zona'];
		$unegocio = $params['negocio'];
		$bandera = $params['bandera'];
		$anio = $fecha[0];
		$mes = $fecha[1];
		$pdv = $params['pdv'];
		$lId = $params['last-id'];
		
		$pdvQuery = obtenerQueryPdvAcum($pdv);
		$ciudadQuery = obtenerQueryCuidad($ciudad);
		$periodosQuery = obtenerQueryPeriodo($params['periods'],"no_and");
		$paisQuery = obtenerQueryPais($pais);
		$regionQuery = obtenerQueryRegion($region);
		$zonaQuery = obtenerQueryZona($zona);
		$razonQuery = obtenerQueryRazon($unegocio);
		$banderaQuery = obtenerQueryBandera($bandera);
		$lIdQuery = obtenerQueryLastId($lId);
		
		$query= sprintf("SELECT COUNT(*) as num FROM %s where  %s  %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery,$paisQuery, $regionQuery, $zonaQuery, $razonQuery,$banderaQuery,$lIdQuery);
		$ql =$query;
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		
		return $row1['num'];
	}
	
	///example 
	function getPercentOfResposeP1($value = "3")
	{
		$tablename="dt_encuesta_popsy";
		$query= sprintf("SELECT COUNT(*) as num FROM %s where p1 = '%s'",$tablename, 3);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$numUsers1 = $row1['num'];
		
		$query= sprintf("SELECT COUNT(*) as num FROM %s where p1 = '%s'",$tablename, 4);
		$data = mysql_query($query);
		$row2 = mysql_fetch_assoc($data);
		$numUsers2 = $row2['num'];
		
		$query= sprintf("SELECT COUNT(*) as num FROM %s where p1 = '%s'",$tablename, 5);
		$data = mysql_query($query);
		$row3 = mysql_fetch_assoc($data);
		$numUsers3 = $row3['num'];
		
		$devu = array();

		$devu[] = array('x','P1 3','P1 4','P1 5');
		$devu[] = array('Dic-13',intval($row1['num']),intval($row2['num']),intval($row3['num']));
		$devu[] = array('Ene-14',0.5,0.3,0.2);
		$devu[] = array('Feb-14',0.7,0.4,0.1);
		
		return $devu;
	}
	
	function obtener_general_acum($params)
	{
		
		$dataResult = array();
		$dataResult[] = array('x','Alto','Medio','Bajo');
		
		$fecha = $params['periods'][0];
		$fecha =  explode("-",$fecha);
		
		$pregunta = $params['pregunta'];
		$pais = $params['pais'];
		$ciudad = $params['ciudad'];
		$region = $params['region'];
		$zona = $params['zona'];
		$unegocio = $params['negocio'];
		$bandera = $params['bandera'];
		$anio = $fecha[0];
		$mes = $fecha[1];
		$pdv = $params['pdv'];
		$lId = $params['last-id'];
		
		$pdvQuery = obtenerQueryPdvAcum($pdv);
		$ciudadQuery = obtenerQueryCuidad($ciudad);
		$periodosQuery = obtenerQueryPeriodo($params['periods']);
		$paisQuery = obtenerQueryPais($pais);
		$regionQuery = obtenerQueryRegion($region);
		$zonaQuery = obtenerQueryZona($zona);
		$razonQuery = obtenerQueryRazon($unegocio);
		$banderaQuery = obtenerQueryBandera($bandera);
		$lIdQuery = obtenerQueryLastId($lId);
		 
		$total_results = 0;
		$alto = 0.0;
		$medio = 0.0;
		$bajo = 0.0;
				
		$tablename="dt_encuesta_popsy";
		$query= sprintf("SELECT COUNT(*) as num FROM %s where `%s` = '%s' %s  %s %s %s %s %s %s %s %s",
						$tablename,$pregunta, 1, $periodosQuery,$pdvQuery,$ciudadQuery,$paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$ql =$query;
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$bajo = $row1['num'];
		
		$query= sprintf("SELECT COUNT(*) as num FROM %s where `%s` = '%s' %s %s %s %s %s %s %s %s %s",
						$tablename,$pregunta, 2, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$bajo = $bajo + $row1['num'];
		
		$query= sprintf("SELECT COUNT(*) as num FROM %s where `%s` = '%s' %s %s %s %s %s %s %s %s %s",
						$tablename,$pregunta, 3,$periodosQuery,$pdvQuery,$ciudadQuery,$paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$medio = $row1['num'] +0 ;
		
		$query= sprintf("SELECT COUNT(*) as num FROM %s where `%s` = '%s' %s %s %s %s %s %s %s %s %s",
						$tablename,$pregunta, 4, $periodosQuery,$pdvQuery ,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$alto = $row1['num'];
		
		$query= sprintf("SELECT COUNT(*) as num FROM %s where `%s` = '%s' %s %s %s %s %s %s %s %s %s",
						$tablename,$pregunta, 5, $periodosQuery,$pdvQuery,$ciudadQuery,$paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$ql =$query;
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$alto = $alto + $row1['num'];
		
		$total_results = $bajo + $medio + $alto;
		
		if($total_results > 0)
		{
			$bajo = $bajo / $total_results;
			$alto = $alto / $total_results;
			$medio = $medio / $total_results;
		}
		$pf = sprintf('%s - ',strtoupper($pregunta));
		
		
			$dataResult[] = array($pf,$alto,$medio,$bajo);
		
		
		if(isset($params['no_headers']))
		{
			return array($params['new_label'],$alto,$medio,$bajo);
		}
		return $dataResult;
	}
	
	function obtener_promediop2_acum($params)
	{
		
		$dataResult = array();
		$dataResult[] = array('Label','Value');
		
		$fecha = $params['periods'][0];
		$fecha =  explode("-",$fecha);
		
		$pais = $params['pais'];
		$ciudad = $params['ciudad'];
		$region = $params['region'];
		$zona = $params['zona'];
		$unegocio = $params['negocio'];
		$bandera = $params['bandera'];
		$anio = $fecha[0];
		$mes = $fecha[1];
		$pdv = $params['pdv'];
		$lId = $params['last-id'];
		
		$pdvQuery = obtenerQueryPdvAcum($pdv);
		$ciudadQuery = obtenerQueryCuidad($ciudad);
		$periodosQuery = obtenerQueryPeriodo($params['periods'],"no_and");
		$paisQuery = obtenerQueryPais($pais);
		$regionQuery = obtenerQueryRegion($region);
		$zonaQuery = obtenerQueryZona($zona);
		$razonQuery = obtenerQueryRazon($unegocio);
		$banderaQuery = obtenerQueryBandera($bandera);
		$lIdQuery = obtenerQueryLastId($lId);
		 
		$total_results = 0;
				
		$tablename="dt_encuesta_popsy";
		$query= sprintf("SELECT COUNT(*) as num FROM %s where  %s  %s %s %s %s %s %s %s %s",
						$tablename,$periodosQuery,$pdvQuery,$ciudadQuery , $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$ql =$query;
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$total_results = $row1['num'];
		
		$query= sprintf("SELECT SUM(p2a) as num FROM %s where  %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery,$banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p2a = $row1['num'];
		
		$query= sprintf("SELECT SUM(p2b) as num FROM %s where %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p2b = $row1['num'];
		
		$query= sprintf("SELECT SUM(p2c) as num FROM %s where  %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p2c = $row1['num'];
		
		$query= sprintf("SELECT SUM(p2d) as num FROM %s where %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery,$paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p2d = $row1['num'];
		
		$query= sprintf("SELECT SUM(p2e) as num FROM %s where  %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p2e = 2;
		
		$query= sprintf("SELECT SUM(p2f) as num FROM %s where %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p2f = $row1['num'];
		
		$promedio = 0;
		$suma_total = $p2a +$p2b +$p2c +$p2d + $p2e + $p2f; 
		$total_results = $total_results *6;
		if($total_results > 0)
		{
			$promedio = $suma_total /  $total_results;
		}
		
		$promedio = redondeado($promedio,1);
		$dataResult[] = array('',$promedio);

		return $dataResult;
	}
	
	function obtener_promediop3_acum($params)
	{
		
		$dataResult = array();
		$dataResult[] = array('Label','Value');
		
		$fecha = $params['periods'][0];
		$fecha =  explode("-",$fecha);
		
		$pais = $params['pais'];
		$ciudad = $params['ciudad'];
		$region = $params['region'];
		$zona = $params['zona'];
		$unegocio = $params['negocio'];
		$bandera = $params['bandera'];
		$anio = $fecha[0];
		$mes = $fecha[1];
		$pdv = $params['pdv'];
		$lId = $params['last-id'];
		
		$pdvQuery = obtenerQueryPdvAcum($pdv);
		$ciudadQuery = obtenerQueryCuidad($ciudad);
		$periodosQuery = obtenerQueryPeriodo($params['periods'],"no_and");
		$paisQuery = obtenerQueryPais($pais);
		$regionQuery = obtenerQueryRegion($region);
		$zonaQuery = obtenerQueryZona($zona);
		$razonQuery = obtenerQueryRazon($unegocio);
		$banderaQuery = obtenerQueryBandera($bandera);
		$lIdQuery = obtenerQueryLastId($lId);
		 
		$total_results = 0;
				
		$tablename="dt_encuesta_popsy";
		$query= sprintf("SELECT COUNT(*) as num FROM %s where  %s  %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$ql =$query;
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$total_results = $row1['num'];
		
		$query= sprintf("SELECT SUM(p3a) as num FROM %s where  %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p3a = $row1['num'];
		
		$query= sprintf("SELECT SUM(p3b) as num FROM %s where %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery ,$paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p3b = $row1['num'];
		
		$query= sprintf("SELECT SUM(p3c) as num FROM %s where  %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p3c = $row1['num'];
		
		$query= sprintf("SELECT SUM(p3d) as num FROM %s where %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery,$lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p3d = $row1['num'];
		
		$query= sprintf("SELECT SUM(p3e) as num FROM %s where  %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p3e = 2;
		
		$query= sprintf("SELECT SUM(p3f) as num FROM %s where  %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p3f = $row1['num'];
		
		$query= sprintf("SELECT SUM(p3g) as num FROM %s where  %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery,$zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p3g = $row1['num'];
		
		$query= sprintf("SELECT SUM(p3h) as num FROM %s where  %s %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$p3h = $row1['num'];
		
		$promedio = 0;
		$suma_total = $p3a +$p3b +$p3c +$p3d + $p3e + $p3f + $p3g + $p3h; 
		$total_results = $total_results * 8;
		if($total_results > 0)
		{
			$promedio = $suma_total /  $total_results;
		}
		$promedio = redondeado($promedio,1);
		$dataResult[] = array('',$promedio);

		return $dataResult;
	}
	
	function obtener_satisfaccion_general_periodo($params)
	{
		$dataResult = array();
		$dataResult[] = array('x','Alto','Medio','Bajo');
				
		if(!empty($params['periods']))
		{	
			foreach($params['periods'] as $p)
			{
				$params['no_headers'] = true;
				$params['new_label'] = $p;
				$tmpParams = $params;
				$tmpParams['periods'] = array($p);
				$tmp_res = obtener_general_acum($tmpParams);
				
				if( ($tmp_res[1] >0 || $tmp_res[2]  > 0 || $tmp_res[3]  > 0))
				{
					$dataResult[] = $tmp_res; 
				}
			}
				
		}else
		{
			$dataResult[] = array('x',0,0,0);
		}
		if(sizeof($dataResult) == 1)
		{
			$dataResult[] = array('x',0,0,0);
		}
	
		return $dataResult;
	}
	
	function obtener_satisfaccion_general_periodo_multi($params)
	{
		$dataResult = array();
		$dataResult[] = array('x','Alto','Medio','Bajo');
				
		if(!empty($params['periods']))
		{	
				foreach($params['preguntas'] as $pregunta)
				{
					$params['no_headers'] = true;
					$params['new_label'] = $pregunta;
					$params['pregunta'] = $pregunta;
					$tmpParams = $params;
					$dataResult[] = obtener_general_acum($tmpParams);
				}	
		}else
		{
			$dataResult[] = array('x',0,0,0);
		}

		return $dataResult;
		
	}
	
	function obtener_promedio_acumulado_pregunta($params)
	{
		$pais = $params['pais'];
		$ciudad = $params['ciudad'];
		$region = $params['region'];
		$zona = $params['zona'];
		$unegocio = $params['negocio'];
		$bandera = $params['bandera'];
		$anio = $fecha[0];
		$mes = $fecha[1];
		$pdv = $params['pdv'];
		$pregunta = $params['pregunta'];
		$lId = $params['last-id'];
		
		$pdvQuery = obtenerQueryPdvAcum($pdv);
		$ciudadQuery = obtenerQueryCuidad($ciudad);
		$periodosQuery = obtenerQueryPeriodo($params['periods'],"no_and");
		$paisQuery = obtenerQueryPais($pais);
		$regionQuery = obtenerQueryRegion($region);
		$zonaQuery = obtenerQueryZona($zona);
		$razonQuery = obtenerQueryRazon($unegocio);
		$banderaQuery = obtenerQueryBandera($bandera);
		$lIdQuery = obtenerQueryLastId($lId);
		
		$tablename="dt_encuesta_popsy";
		$query= sprintf("SELECT COUNT(*) as num FROM %s where  %s  %s %s %s %s %s %s %s %s",
						$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$ql =$query;
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$total_results = $row1['num'] + 0;
		
		
		$query= sprintf("SELECT SUM(%s) as num FROM %s where  %s %s %s %s %s %s %s %s %s",
						$pregunta,$tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$penq = $row1['num'] + 0 ;
		
		$promedio = 0.0; 

		if($total_results > 0)
		{
			$promedio = $penq /  $total_results;
		}
		
		return $promedio;
			
	}
	
	function obtener_promedio_acumulado_multi($params)
	{
		$dataResult = array();
		$base = array('x');
		$head = array_merge($base ,$params['preguntas']);
		$dataResult[] = $head;
		
		
		if(!empty($params['periods']))
		{
			foreach($params['periods'] as $period)
			{
					$params['no_headers'] = true;
					$params['new_label'] = $period;
					$params['pregunta'] = $pregunta;
					$tmpParams = $params;
					$tmpParams['periods'] = array($period);
					$row = array();
					//$row[]=$period;
					foreach($params['preguntas'] as $pregunta)
					{
						$tmpParams['pregunta'] =$pregunta;
						$row[] =  redondeado(obtener_promedio_acumulado_pregunta($tmpParams),2);
					}
					
					$insertable = false;
					foreach($row as $r)
					{
						if($r > 0)
						{
							$insertable = true;
						}
					}
					
					if($insertable)
					{
						$nRow = array_merge(array($period),$row);
						$dataResult[] = $nRow;
					}
			}

		}
		else
		{
			$row[]='';
			foreach($params['preguntas'] as $pregunta)
			{
				$row[] = 0;
			}
			$dataResult[] = $row;
		}
		
		if(sizeof($dataResult) == 1)
		{
			$row[]='';
			foreach($params['preguntas'] as $pregunta)
			{
				$row[] = 0;
			}
			$dataResult[] = $row;
		}
		return $dataResult;
	}
	
	function obtener_general_acum_b($params)
	{
		
		$dataResult = array();
		$dataResult[] = array('x','Promotor','Neutro','Detractor');
		
		$fecha = $params['periods'][0];
		$fecha =  explode("-",$fecha);
		
		$pregunta = $params['pregunta'];
		$pais = $params['pais'];
		$ciudad = $params['ciudad'];
		$region = $params['region'];
		$zona = $params['zona'];
		$unegocio = $params['negocio'];
		$bandera = $params['bandera'];
		$anio = $fecha[0];
		$mes = $fecha[1];
		$pdv = $params['pdv'];
		$lId = $params['last-id'];
		
		$pdvQuery = obtenerQueryPdvAcum($pdv);
		$ciudadQuery = obtenerQueryCuidad($ciudad);
		$periodosQuery = obtenerQueryPeriodo($params['periods']);
		$paisQuery = obtenerQueryPais($pais);
		$regionQuery = obtenerQueryRegion($region);
		$zonaQuery = obtenerQueryZona($zona);
		$razonQuery = obtenerQueryRazon($unegocio);
		$banderaQuery = obtenerQueryBandera($bandera);
		$lIdQuery = obtenerQueryLastId($lId);
		 
		$total_results = 0;
		$promotor = 0.0;
		$neutro = 0.0;
		$detractor = 0.0;
				
		
		$tablename="dt_encuesta_popsy";
		$query= sprintf("SELECT COUNT(*) as num FROM %s where `%s` < '%s' %s  %s %s %s %s %s %s %s %s",
						$tablename,$pregunta, 7, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$ql =$query;
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$detractor = $row1['num'];
		
		$query= sprintf("SELECT COUNT(*) as num FROM %s where `%s` = '%s' %s %s %s %s %s %s %s %s %s",
						$tablename,$pregunta, 7, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$neutro = $row1['num'];
		
		$query= sprintf("SELECT COUNT(*) as num FROM %s where `%s` = '%s' %s %s %s %s %s %s %s %s %s",
						$tablename,$pregunta, 8,$periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$neutro = $neutro + $row1['num'] +0 ;
		
		$query= sprintf("SELECT COUNT(*) as num FROM %s where `%s` > '%s' %s %s %s %s %s %s %s %s %s",
						$tablename,$pregunta, 8, $periodosQuery,$pdvQuery ,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$promotor = $row1['num'];
		
		
		$total_results = $detractor + $neutro + $promotor;
		
		if($total_results > 0)
		{
			$detractor = $detractor / $total_results;
			$neutro = $neutro / $total_results;
			$promotor = $promotor / $total_results;
		}
		$detractor = $detractor+0;
		$neutro = $neutro +0;
		$promotor = $promotor +0;
		$pf = sprintf('%s - ',strtoupper($pregunta));
		$dataResult[] = array($pf,$promotor,$neutro,$detractor);
		
		if(isset($params['no_headers']))
		{
			return array($params['new_label'],$promotor,$neutro,$detractor);
		}
		return $dataResult;
	}
	
	function obtener_satisfaccion_general_periodo_b($params)
	{
		$dataResult = array();
		$dataResult[] = array('x','Promotor','Neutro','Detractor');
		if(!empty($params['periods']))
		{	
			foreach($params['periods'] as $p)
			{
				$params['no_headers'] = true;
				$params['new_label'] = $p;
				$tmpParams = $params;
				$tmpParams['periods'] = array($p);
				$temp_res = obtener_general_acum_b($tmpParams)  ;
				
				if($temp_res[1] > 0 || $temp_res[2] > 0 || $temp_res[3] > 0)
				{
					$dataResult[] = $temp_res;
				}
			}
				
		}else
		{
			$dataResult[] = array('x',0,0,0);
		}
		
		if(sizeof($dataResult) == 1)
		{
			$dataResult[] = array('x',0,0,0);
		}
	
		return $dataResult;
	}
	
	function obtener_general_acum_b2($params)
	{
		$dataResult = array();
		$dataResult[] = array('x','Igual O Mejor','Peor');
		
		$pregunta = $params['pregunta'];
		$pais = $params['pais'];
		$ciudad = $params['ciudad'];
		$region = $params['region'];
		$zona = $params['zona'];
		$unegocio = $params['negocio'];
		$bandera = $params['bandera'];
		$pdv = $params['pdv'];
		$lId = $params['last-id'];
		
		$pdvQuery = obtenerQueryPdvAcum($pdv);
		$ciudadQuery = obtenerQueryCuidad($ciudad);
		$periodosQuery = obtenerQueryPeriodo($params['periods']);
		$paisQuery = obtenerQueryPais($pais);
		$regionQuery = obtenerQueryRegion($region);
		$zonaQuery = obtenerQueryZona($zona);
		$razonQuery = obtenerQueryRazon($unegocio);
		$banderaQuery = obtenerQueryBandera($bandera);
		$lIdQuery = obtenerQueryLastId($lId);
		 
		$total_results = 0;
		$mejor = 0.0;
		$peor = 0.0;			
		
		$tablename="dt_encuesta_popsy";
		$query= sprintf("SELECT COUNT(*) as num FROM %s where `%s` > '%s' %s  %s %s %s %s %s %s %s %s",
						$tablename,$pregunta, 1, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery,$zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$ql =$query;
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$mejor = $row1['num'];
		
		$query= sprintf("SELECT COUNT(*) as num FROM %s where `%s` < '%s' %s %s %s %s %s %s %s %s %s",
						$tablename,$pregunta, 2, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery, $zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
		$data = mysql_query($query);
		$row1 = mysql_fetch_assoc($data);
		$peor = $row1['num'];
		
		$total_results = $mejor + $peor ;
		
		if($total_results > 0)
		{
			$mejor = $mejor / $total_results;
			$peor = $peor / $total_results;
		}
		$mejor = $mejor + 0;
		$peor = $peor + 0;
		$pf = sprintf('%s - ',strtoupper($pregunta));
		$dataResult[] = array($pf,$mejor,$peor);
		
		if(isset($params['no_headers']))
		{
			return array($params['new_label'],$mejor,$peor);
		}
		return $dataResult;
	}
	
	function obtener_satisfaccion_general_periodo_b2($params)
	{
		$dataResult = array();
		$dataResult[] = array('x','Igual O Mejor','Peor');
		if(!empty($params['periods']))
		{	
			foreach($params['periods'] as $p)
			{
				$params['no_headers'] = true;
				$params['new_label'] = $p;
				$tmpParams = $params;
				$tmpParams['periods'] = array($p);
				$temp_res = obtener_general_acum_b2($tmpParams) ;
				if($temp_res[1] > 0 || $temp_res[2] > 0 )
				{
					$dataResult[] = $temp_res;
				}
			}
				
		}else
		{
			$dataResult[] = array('x',0,0);
		}
		
		if(sizeof($dataResult) == 1)
		{
			$dataResult[] = array('x',0,0);
		}
	
		return $dataResult;
	}
	
	

	
	function obtener_indice_tienda($prom_acum, $lim_ran_sup, $lim_ran_inf, $indice_alto, $indice_medio, $indice_bajo)
	{
		$resultado = 0.0;
		
		if($prom_acum >= $lim_ran_sup)
		{
			$resultado = $indice_alto;
		}
		else
		{
			if(($prom_acum < $lim_ran_sup) && ($prom_acum > $lim_ran_inf))
			{
				$resultado = $indice_medio;
			}
			else
			{
				$resultado = $indice_bajo;
			}
		}
		
		return $resultado;
	}
	
	function procesar_p1_general_acum_tiendas($params)
	{
		$peso_factor = 0.2;
		$peso_atributo = $peso_factor; 
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p1';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);
		
		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function procesar_p2a_general_acum_tiendas($params)
	{
		$peso_factor = 0.2;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 6; 
		
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p2a';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return $indice;
	}
	
	function procesar_p2b_general_acum_tiendas($params)
	{
		$peso_factor = 0.2;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 6;  
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p2b';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function procesar_p2c_general_acum_tiendas($params)
	{
		$peso_factor = 0.2;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 6;  
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p2c';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function procesar_p2d_general_acum_tiendas($params)
	{
		$peso_factor = 0.2;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 6;  
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p2d';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,1);
	}
	
	function procesar_p2e_general_acum_tiendas($params)
	{
		$peso_factor = 0.2;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 6;  
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p2e';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function procesar_p2f_general_acum_tiendas($params)
	{
		$peso_factor = 0.2;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 6; 
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p2f';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,3);
	}
	
	function procesar_p3a_general_acum_tiendas($params)
	{
		$peso_factor = 0.25;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 8;  
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p3a';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function procesar_p3b_general_acum_tiendas($params)
	{
		$peso_factor = 0.25;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 8;  
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p3b';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function procesar_p3c_general_acum_tiendas($params)
	{
		$peso_factor = 0.25;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 8;  
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p3c';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function procesar_p3d_general_acum_tiendas($params)
	{
		$peso_factor = 0.25;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 8;  
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p3d';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function procesar_p3e_general_acum_tiendas($params)
	{
		$peso_factor = 0.25;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 8;  
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p3e';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function procesar_p3f_general_acum_tiendas($params)
	{
		$peso_factor = 0.25;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 8;  
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p3f';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function procesar_p3g_general_acum_tiendas($params)
	{
		$peso_factor = 0.25;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 8;  
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p3g';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function procesar_p3h_general_acum_tiendas($params)
	{
		$peso_factor = 0.25;
		$peso_atributo = 0.0;
		$peso_atributo = $peso_factor / 8;  
		$limite_rango_superior = 4.0;
		$limite_rango_inferior = 2.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'p3h';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);
		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function procesar_b1_general_acum_tiendas($params)
	{
		$peso_factor = 0.25;
		$peso_atributo = $peso_factor ;
		$limite_rango_superior = 9.0;
		$limite_rango_inferior = 6.9;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = $indice_alto * 0.8;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'b1';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function procesar_b2_general_acum_tiendas($params)
	{
		$peso_factor = 0.1;
		$peso_atributo = 0.1 ;
		$limite_rango_superior = 2.0;
		$limite_rango_inferior = 0.0;
		
		$indice_alto = $peso_atributo * 100.0;
		$indice_medio = 0.0;
		$indice_bajo = 0.0;
		
		$params['pregunta'] = 'b2';
		$promedio_acumulado = obtener_promedio_acumulado_pregunta($params);

		$indice = obtener_indice_tienda($promedio_acumulado, $limite_rango_superior, $limite_rango_inferior, $indice_alto, $indice_medio, $indice_bajo);
		
		return redondeado($indice,2);
	}
	
	function obtener_general_acum_tiendas_v2($params)
	{
//           return "hola";
		$dataResult = array();
		$dataResult[] = array('x','');
		$lId = $params['last-id'];
		$ar =array();
		if(!empty($params['periods']))
		{
			foreach($params['periods'] as $period)
			{
                                                
                            $pais = $params['pais'];
                            $ciudad = $params['ciudad'];
                            $region = $params['region'];
                            $zona = $params['zona'];
                            $unegocio = $params['negocio'];
                            $bandera = $params['bandera'];
                            $pdv = $params['pdv'];
                            $lId = $params['last-id'];
                            
                            $pdvQuery = obtenerQueryPdvAcum($pdv);
                            $ciudadQuery = obtenerQueryCuidad($ciudad);
                            $periodosQuery = obtenerQueryPeriodo($params['periods']);
                            $paisQuery = obtenerQueryPais($pais);
                            $regionQuery = obtenerQueryRegion($region);
                            $zonaQuery = obtenerQueryZona($zona);
                            $razonQuery = obtenerQueryRazon($unegocio);
                            $banderaQuery = obtenerQueryBandera($bandera);
                            $lIdQuery = obtenerQueryLastId($lId);


                                $tablename="dt_encuesta_popsy";
                                $query= sprintf("SELECT DISTINCT `pventa` FROM %s where id > 1 %s  %s %s %s %s %s %s %s ",
                                                $tablename, $periodosQuery,$pdvQuery,$ciudadQuery, $paisQuery, $regionQuery,$zonaQuery, $razonQuery, $banderaQuery, $lIdQuery);
                            $data = mysql_query($query);
                            $tmp_period_results =array();
                            while($row1 = mysql_fetch_assoc($data))
                            {
                                $pregunta = $params['pregunta'];
				
				//obtener los promedios acumulados para el pdv en el periodo
				$tmpParams = $params;
				$tmpParams['periods'] = array($period);
				$tmpParams['pdv'] = $row1["pventa"];
				
				$pp1 = procesar_p1_general_acum_tiendas($tmpParams);
					
				
				$pp2a = procesar_p2a_general_acum_tiendas($tmpParams); 
				
				
				$pp2b = procesar_p2b_general_acum_tiendas($tmpParams);
				
				$pp2c = procesar_p2c_general_acum_tiendas($tmpParams);
								
								
				$pp2d = procesar_p2d_general_acum_tiendas($tmpParams);

				$pp2e = procesar_p2e_general_acum_tiendas($tmpParams);
				
				$pp2f = procesar_p2f_general_acum_tiendas($tmpParams);
				
				$pp3a = procesar_p3a_general_acum_tiendas($tmpParams);
								
				
				$pp3b = procesar_p3b_general_acum_tiendas($tmpParams);

				
				$pp3c = procesar_p3c_general_acum_tiendas($tmpParams);

				
				$pp3d = procesar_p3d_general_acum_tiendas($tmpParams);
												
				
				$pp3e = procesar_p3e_general_acum_tiendas($tmpParams);
				
				
				$pp3f = procesar_p3f_general_acum_tiendas($tmpParams);
				
				
				$pp3g = procesar_p3g_general_acum_tiendas($tmpParams);
				
				$pp3h = procesar_p3h_general_acum_tiendas($tmpParams);
				
				
				$pb1 = procesar_b1_general_acum_tiendas($tmpParams); 
				
				
				$pb2 = procesar_b2_general_acum_tiendas($tmpParams);
				$tmp_period_results[] = $pp1 +$pp2a +$pp2b + $pp2c+$pp2d +$pp2e + $pp2f +$pp3a +$pp3b +$pp3c +$pp3d +$pp3e +$pp3f +$pp3g +$pp3h + $pb1 + $pb2;
				
                            }
//                                 var_dump($tmp_period_results);
                                $indice =0;
                                if(sizeof($tmp_period_results)> 0)
                                {
                                  $indice= array_sum($tmp_period_results)/sizeof($tmp_period_results);
                                }
				$num_datos = hallar_cantidad_datos($tmpParams);
				
				$period = $period."- ".$num_datos." datos" ;

				if($indice > 0 )
				{
					$dataResult[] = array($period,redondeado($indice,2));
				}
				
				if($params['solo_cantidad_datos'])
				{
					return $num_datos;
				}
				
				if($params['no_header'])
				{
					return redondeado($indice,2);
				}
			}
		}
		else
		{
			$dataResult[] = array('',0);
		}
	
		if(sizeof($dataResult) == 1)
		{
			$dataResult[] = array('',0);
		}

		return $dataResult;
	}
	
	function obtener_general_acum_tiendas_relojes($params)
	{
		$dataResult = array();
		$dataResult[] = array('label','value');
		if(!empty($params['periods']))
		{
			$acumulados = array();
			$cant_datos = array();
			foreach($params['periods'] as $period)
			{
				$tmpParams = $params;
				$tmpParams['periods'] = array($period);
				$tmpParams['no_header'] = true;
				$cant_datos[] = hallar_cantidad_datos($tmpParams);
				$pro_temp = obtener_general_acum_tiendas_v2($tmpParams);
				if($pro_temp > 0 || sizeof($params['periods']) == 1)
				{
					$acumulados[] = $pro_temp;
				}
			}
			
			$total = array_sum($acumulados);
			$acumulado =  $total/sizeof($acumulados);
			
			if(isset($params['solo_cantidad_datos']) )
			{
				$nResult = array();
				$datos_acum = array_sum($cant_datos)." datos";
				$datos_ultimo_mes = $params['periods'][sizeof($params['periods']) -1]." - ".$cant_datos[sizeof($cant_datos) -1 ]." datos";
				
				$nResult['acumulado'] = $datos_acum;
				$nResult['ultimo_mes'] = $datos_ultimo_mes;
				return $nResult;
			}
			 
			if($cant_datos[sizeof($cant_datos) -1 ] == 0)
			{
				$dataResult[] = array('Ultimo Mes',0);
			}else
			{
				$dataResult[] = array('Ultimo Mes',$acumulados[sizeof($acumulados) -1]);
			}
			
			$dataResult[] = array('Acumulado',$acumulado);
		}else
		{
			$dataResult[] = array('Ultimo Mes',0);
			$dataResult[] = array('Acumulado',0);
		}
		
		if(sizeof($dataResult) == 1)
		{
			$dataResult[] = array('Ultimo Mes',0);
			$dataResult[] = array('Acumulado',0);
		}
		
		return $dataResult;
		
	}
	
	function obtener_pdvs_segun_filtros($params)
	{
		
		$pais = $params['pais'];
		$ciudad = $params['ciudad'];
		$region = $params['region'];
		$zona = $params['zona'];
		$unegocio = $params['negocio'];
		$pdv = $params['pdv'];
		
		 
		
		$q_pais = "";
		if($pais != "todo")
		{
			$q_pais = "and  `pais` LIKE  '%".$pais."%'";
		}
		
		$q_ciudad = "";
		if($ciudad != "todo")
		{
			$q_ciudad = "and  `ciudad` LIKE  '%".$ciudad."%'";
		}
		
		$q_region = "";
		if($region != "todo")
		{
			$q_region = "and  `regional` LIKE  '%".$region."%'";
		}
		
		$q_zona = "";
		if($zona != "todo")
		{
			$q_zona = "and  `zona` LIKE  '%".$zona."%'";
		}
		
		$q_unegocio = "";
		if($unegocio != "todo")
		{
			$q_unegocio = "and  `unidad_negocio` LIKE  '%".$unegocio."%'";
		}
		
		$q_pdv = "";
		if($pdv != "todo")
		{
			$q_pdv = "and  `c_costo_nombre` LIKE  '%".$pdv."%'";
		}
		
		
		
		$tablename = 'relaciones';
		
		$result = array();
		$query = sprintf("SELECT *  FROM %s where id > 1 %s %s %s %s %s %s", 
						$tablename, $q_pais, $q_ciudad, $q_region, $q_zona, $q_unegocio, $q_pdv );
		$data = mysql_query($query);
		//return $query;
		while($row = mysql_fetch_assoc($data))
		{
			$tmpParams = $params;
			$tmpParams['pdv'] = $row['c_costo_nombre'];
			$tmpParams['no_header'] = true;
			 
			$valor_calculo = obtener_general_acum_tiendas_v2($tmpParams);
			
			$tmpParams['solo_cantidad_datos'] = true;
			$num_datos = obtener_general_acum_tiendas_v2($tmpParams);
			
			$logo = 0;
			
			if($valor_calculo >= 90)
			{
				$logo = 3;
			}
			if(($valor_calculo >= 70) && ($valor_calculo < 90))
			{
				$logo = 2;
			}
			if(($valor_calculo > 0) && ($valor_calculo < 70))
			{
				$logo = 1;
			}
			
			$result[] = array("nombre" => $row['c_costo_nombre'],"latitud" => $row['latitud'],"longitud" => $row['longitud'],
							"valor" => $valor_calculo, "icono" => $logo, "datos" => $num_datos);
		}
		
		return $result; 
	}
	
	
?> 
