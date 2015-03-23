<?php 
  require_once("../core/conection_to_ci.php");

  function getPollsFor($year, $month, $limit)
  {
    $result = array();
    $query = sprintf("SELECT * FROM `dt_popsy_incognito` WHERE  `anio` = '%s' AND `mes`= '%s' LIMIT %s ", $year, $month, $limit);
    $conection = new CIConection();
    $result = $conection->getConection()->query($query);
    $conection->closeConection();
    return $result; 
  }

  function countPolls($year, $month)
  {
    $query= sprintf("SELECT COUNT(*) as total FROM dt_popsy_incognito`  WHERE  `anio` = '%s' AND `mes`= '%s'" , $year, $month);
    $conection = new CIConection();
    $result = $conection->getConection()->query($query);
    $conection->closeConection();
    return $result['total']; 
  }

  /* PRINTING */
  function printCol($value)
  {
      print("<td>".$value."</td>");
  }


  function printPollsTable($polls, $om, $oy)
  {
    foreach($polls as $poll)
    {
      print("<tr>");
      printf("<td><a href='edit_poll.php?poll_id=%s&or_m=%s&or_a=%s'> %s </a></td>",$poll['id'] ,$om, $oy,$poll['id']);
      printCol($poll['srvid']);
      printCol($poll['fecha']);
      printCol($poll['anio']);
      printCol($poll['mes']);
      printCol($poll['pdvNombre']);
      printCol($poll['pdv_id']);
      printCol($poll['p1']);
      printCol($poll['p2']);
      printCol($poll['p3']);
      printCol($poll['p4']);
      printCol($poll['p5']);
      printCol($poll['p6']);
      printCol($poll['p7']);
      printCol($poll['p8']);
      printCol($poll['p81_rasgos_fisicos']);
      printCol($poll['p82_personas']);
      printCol($poll['p9']);
      printCol($poll['p10']);
      printCol($poll['p11']);
      printCol($poll['p12']);
      printCol($poll['p12b']);
      printCol($poll['p13']);
      printCol($poll['p13b']);
      printCol($poll['14']);
      printCol($poll['15']);
      printCol($poll['16']);
      printCol($poll['17']);
      printCol($poll['p171_rasgos_fisicos']);
      printCol($poll['p18']);
      printCol($poll['p18b']);
      printCol($poll['p18c']);
      printCol($poll['18d']);
      printCol($poll['p19']);
      printCol($poll['p20']);
      printCol($poll['p201_mujeres']);
      printCol($poll['p21']);
      printCol($poll['p211_maquillaje']);
      printCol($poll['p22']);
      printCol($poll['p221_joyas']);
      printCol($poll['p222_hombres']);
      printCol($poll['p23']);
      printCol($poll['p231_afeitados']);
      printCol($poll['p24']);
      printCol($poll['p241_cabello']);
      printCol($poll['p25']);
      printCol($poll['p251_escarapela']);
      printCol($poll['p26']);
      printCol($poll['p261_uniforme']);
      printCol($poll['p27']);
      printCol($poll['p28']);
      printCol($poll['p29']);
      printCol($poll['p30']);
      printCol($poll['p31']);
      printCol($poll['p32']);
      printCol($poll['p321_lugar']);
      printCol($poll['p33']);
      printCol($poll['p331_sucio']);
      printCol($poll['p34']);
      printCol($poll['p35']);
      printCol($poll['p36']);
      printCol($poll['p37']);
      printCol($poll['p38']);
      printCol($poll['nombre_encuestador']);
      printCol($poll['genero']);
      printCol($poll['edad']);
      printCol($poll['telefono']);
      printCol($poll['notified12']);
      printCol($poll['synchronized']);
      print("</tr>");     
    }
  }
