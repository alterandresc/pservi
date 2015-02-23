<?php

	function getFilterParams()
	{
		$filterPrams = array();
		if (isset($_POST['periods']))
		{
			$optionArray = $_POST['periods'];
			$filterPrams['periods'] = $optionArray; 
			
		}
		if (isset($_POST['select-pais']))
		{
			$pais = $_POST['select-pais'];
			$filterPrams['pais'] = $pais; 
			
		}
		if (isset($_POST['select-PDV']))
		{
			$pdv = $_POST['select-PDV'];
			$filterPrams['pdv'] = $pdv; 
			
		}
		if (isset($_POST['select-region']))
		{
			$region = $_POST['select-region'];
			$filterPrams['region'] = $region; 
			
		}
		if (isset($_POST['select-zona']))
		{
			$zona = $_POST['select-zona'];
			$filterPrams['zona'] = $zona; 
			
		}
		if (isset($_POST['select-ciudad']))
		{
			$ciudad = $_POST['select-ciudad'];
			$filterPrams['ciudad'] = $ciudad; 
			
		}
		if (isset($_POST['select-negocio']))
		{
			$negocio = $_POST['select-negocio'];
			$filterPrams['negocio'] = $negocio ; 	
		}
		if (isset($_POST['nombre_grafica']))
		{
			$grafica = $_POST['nombre_grafica'];
			$filterPrams['nombre_grafica'] = $grafica ; 
			
		}if (isset($_POST['pregunta']))
		{
			$pregunta = $_POST['pregunta'];
			$filterPrams['pregunta'] = $pregunta ; 
			
		}
		if (isset($_POST['preguntas']))
		{
			$preguntas = $_POST['preguntas'];
			$filterPrams['preguntas'] = $preguntas ; 
			
		}
		
		if (isset($_POST['tipo_peticion']))
		{
			$preguntas = $_POST['tipo_peticion'];
			$filterPrams['tipo_peticion'] = $preguntas ; 
		}
		if (isset($_POST['filtros_por']))
		{
			$preguntas = $_POST['filtros_por'];
			$filterPrams['filtros_por'] = $preguntas ; 
		}
		if (isset($_POST['valor_de_filtro']))
		{
			$preguntas = $_POST['valor_de_filtro'];
			$filterPrams['valor_de_filtro'] = $preguntas ; 
		}
		if (isset($_POST['solo_cantidad_datos']))
		{
			$preguntas = $_POST['solo_cantidad_datos'];
			$filterPrams['solo_cantidad_datos'] = $preguntas ; 
		}
		if (isset($_POST['register']))
		{
			$preguntas = $_POST['register'];
			$filterPrams['register'] = $preguntas ; 
		}
		if (isset($_POST['select-bandera']))
		{
			$preguntas = $_POST['select-bandera'];
			$filterPrams['bandera'] = $preguntas ; 
		}
		if (isset($_POST['last-id']))
		{
			$preguntas = $_POST['last-id'];
			$filterPrams['last-id'] = $preguntas ; 
		}
		return $filterPrams;
	}

?> 
