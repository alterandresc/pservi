<?php
function register_filters($params)
{	
		if (isset($params['periods']))
		{
			$optionArray = $params['periods'];
			$_SESSION['f_periods'] = $optionArray; 			
		}
		else
		{
			$_SESSION['f_periods'] = array();
		}
		
		if (isset($params['pais']))
		{
			$pais = $params['pais'];
			$_SESSION['f_pais'] = $pais; 
		}else
		{
			$_SESSION['f_pais'] = "todo";
		}
		
		if (isset($params['pdv']))
		{
			$pdv = $params['pdv'];
			$_SESSION['f_pdv'] = $pdv; 
			
		}else
		{
			$_SESSION['f_pdv'] = "todo";
		}
		
		if (isset($params['region']))
		{
			$region = $params['region'];
			$_SESSION['f_region'] = $region; 
			
		}else
		{
			$_SESSION['f_region'] = "todo";
		}
		
		if (isset($params['zona']))
		{
			$zona = $params['zona'];
			$_SESSION['f_zona'] = $zona; 
			
		}else
		{
			$_SESSION['f_zona'] = "todo";
		}
		
		if (isset($params['ciudad']))
		{
			$ciudad = $params['ciudad'];
			$_SESSION['f_ciudad'] = $ciudad; 
			
		}else
		{
			$_SESSION['f_ciudad'] = "todo";
		}
		
		if (isset($params['negocio']))
		{
			$negocio = $params['negocio'];
			$_SESSION['f_negocio'] = $negocio ; 	
		}else
		{
			$_SESSION['f_negocio'] = "todo";
		}
		
}


function  get_registered_filters()
	{
		$filters = array();
		if (isset($_SESSION['f_periods']))
		{
			$optionArray = $_SESSION['f_periods'];
			$filters['periods'] = $optionArray; 
			
		}
		if (isset($_SESSION['f_pais']))
		{
			$pais = $_SESSION['f_pais'];
			$filters['select-pais'] = $pais; 
			
		}
		if (isset($_SESSION['f_pdv']))
		{
			$pdv = $_SESSION['f_pdv'];
			$filters['select-PDV'] = $pdv; 
			
		}
		if (isset($_SESSION['f_region']))
		{
			$region = $_SESSION['f_region'];
			$filters['select-region'] = $region; 
			
		}
		if (isset($_SESSION['f_zona']))
		{
			$zona = $_SESSION['f_zona'];
			$filters['select-zona'] = $zona; 
			
		}
		if (isset($_SESSION['f_ciudad']))
		{
			$ciudad = $_SESSION['f_ciudad'];
			$filters['select-ciudad'] = $ciudad; 
			
		}
		if (isset($_SESSION['f_negocio']))
		{
			$negocio = $_SESSION['f_negocio'];
			$filters['select-negocio'] = $negocio ;
		}
		return $filters;
	}
?>
