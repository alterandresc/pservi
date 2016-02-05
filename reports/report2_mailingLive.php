<?php 
	error_reporting (5);

	require_once('../core/conection.php');
	require_once('../core/process_util.php');
	
	function areItemsLoud($poll, $items = array())
	{
	  $status = true;
	  
	  foreach($items as $item)
	  {
	    if( in_array($poll[$item], array("3","4","5")))
	    {
	      $status = false;
	    }
	  }
	  
	  return $status;
	}
	
	function isLousP1($poll)
	{
	  $elements = array("p1");
	  return areItemsLoud($poll,$elements);
	}
	function isLousP2($poll)
	{
	  $elements = array("p2a","p2b","p2c","p2d","p2e","p2f");
	  return areItemsLoud($poll,$elements);
	}
	
	function isLousP3($poll)
	{
	  $elements = array("p3a","p3b","p3c","p3d","p3e","p3f","p3g","p3h");
	  return areItemsLoud($poll,$elements);
	}
	
	function isNotificable($poll)
	{
	    if(isLousP1($poll) || isLousP2($poll) || isLousP3($poll))
	    {
	      return true;
	    }else
	    {
	      return false;
	    }
	}
	
	function getUnnotifiedPolls()
	{
	  $result = array();
	  
	  //id maximo
	  $max_id = 0;
	  $query = "SELECT * FROM  `dt_encuesta_popsy` WHERE `live_notified` = 0 ORDER BY `id` ASC LIMIT 100;";
	  $max_id_data = mysql_query($query);
	  while ($id_row = mysql_fetch_assoc($max_id_data))
	  {
	    $max_id = $id_row["id"];
	  }
	  
	  $periods_query = "SELECT * FROM `dt_encuesta_popsy` WHERE `live_notified` = 0 group by `nombre`, `genero`,`edad` order by `id`  limit 100;";
	  $periods_data = mysql_query($periods_query);
	  $mails = array();
	  while ($mail_row = mysql_fetch_assoc($periods_data))
	  {

	      $result["centros"][] = $mail_row;
	    
	  }
	  
	  //bandera de notificados on 
	  $modificar_query = sprintf("UPDATE `dt_encuesta_popsy` SET `live_notified` = 1  WHERE `dt_encuesta_popsy`.`id` <= %s ",$max_id);
	   $periods_data_2 = mysql_query($modificar_query);
	  //
	  return $result; 
	}
	
	$result = getUnnotifiedPolls();
	$encoded  = json_encode($result);
	header('Content-Type: application/json');
	echo($encoded);
	?>
	

