<?php 

	function getCascadeFiltersValues($params)
	{
		switch ($params['filtros_por']) {
			case 'inicializar_paises':
				return inicializar_paises($params);
				break;
			case 'pais':
				return obtener_filtros_pais($params);
				break;
			case 'region':
				return obtener_filtros_region($params);
				break;
			case 'zona':
				return obtener_filtros_zona($params);
				break;
			case 'ciudad':
				return obtener_filtros_ciudad($params);
				break;
			case 'unidades_negocio':
				return obtener_filtros_razon_social($params);
				break;
			default:
				return $params['filtros_por'];
		}
	}
	
	function inicializar_paises($params)
	{
		$result = array();
		$tablename = "relaciones";
		
		$query = "SELECT DISTINCT `pais` FROM `relaciones` LIMIT 10;";
		$data = mysql_query($query);
		while ($row = mysql_fetch_assoc($data))
		{
			$result['paises'][] = $row['pais'];           
		}
		return $result;
	}
	
	function obtener_filtros_pais($params)
	{
		$result = array();
		$tablename = "relaciones";
		
		$query = sprintf("SELECT DISTINCT `regional` FROM `%s` WHERE pais = '%s'",$tablename, $params['valor_de_filtro']);
		
		$data = mysql_query($query);
		while ($row = mysql_fetch_assoc($data))
		{
			$result['regiones'][] = $row['regional'];           
		}
		mysql_free_result($data);
		
		return $result;
	}
	
	function obtener_filtros_region($params)
	{
		$result = array();
		$tablename = "relaciones";
		
		$query = sprintf("SELECT DISTINCT `zona` FROM `%s` WHERE regional = '%s'",$tablename, $params['valor_de_filtro']);
		 
		
		$data = mysql_query($query);
		while ($row = mysql_fetch_assoc($data))
		{
			$result['zonas'][] = $row['zona'];           
		}
		mysql_free_result($data);
		
		return $result;
	}
	
	function obtener_filtros_zona($params)
	{
		$result = array();
		$tablename = "relaciones";
		
		$query = sprintf("SELECT DISTINCT `ciudad` FROM `%s` WHERE zona = '%s'",$tablename, $params['valor_de_filtro']);
		 
		
		$data = mysql_query($query);
		while ($row = mysql_fetch_assoc($data))
		{
			$result['ciudades'][] = $row['ciudad'];           
		}
		mysql_free_result($data);
		
		return $result;
	}
	
	function obtener_filtros_razon_social($params)
	{
		$result = array();
		$tablename = "relaciones";
		
		$query = sprintf("SELECT DISTINCT `unidad_negocio` FROM `%s` LIMIT 0 , 30",$tablename);
		 
		
		$data = mysql_query($query);
		while ($row = mysql_fetch_assoc($data))
		{
			$result['unidades'][] = $row['unidad_negocio'];           
		}
		mysql_free_result($data);
		
		return $result;
	}
	
	function obtener_filtros_ciudad($params)
	{
		$result = array();
		$tablename = "relaciones";
		
		$query = sprintf("SELECT DISTINCT `c_costo_nombre`, `c_costo_nombre_legible` FROM `%s` WHERE ciudad = '%s'",$tablename, $params['valor_de_filtro']);
		 
		
		$data = mysql_query($query);
		while ($row = mysql_fetch_assoc($data))
		{
			$result['pdvs'][] = array("c_costo_nombre" => $row['c_costo_nombre'], "nombre_legible" => $row['c_costo_nombre_legible']  );           
		}
		mysql_free_result($data);
		
		return $result;
	}
?> 
