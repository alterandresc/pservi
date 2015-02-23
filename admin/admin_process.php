<?php
require_once('../core/conection.php');

function getPollsFor($year, $month, $limit)
{
  $result = array();
  $query= sprintf("SELECT * FROM dt_encuesta_popsy WHERE  `periodo` = '%s' AND `mes`= '%s' LIMIT %s" , $year, $month, $limit);
  $data = mysql_query($query);
  while( $row = mysql_fetch_assoc($data))
  {
    $result[] = $row;
  }
  return $result;
}

function countPolls($year, $month)
{
  $query= sprintf("SELECT COUNT(*) as total FROM dt_encuesta_popsy WHERE  `periodo` = '%s' AND `mes`= '%s'" , $year, $month);
  $data = mysql_query($query);
  $row = mysql_fetch_assoc($data);
  return $row['total'];
}

function findPoll($id)
{
  $query= sprintf("SELECT * FROM dt_encuesta_popsy WHERE  `id` = '%s'", $id);
  $data = mysql_query($query);
  $row = mysql_fetch_assoc($data);
  
  return $row;
}

function findUser($id)
{
  $query= sprintf("SELECT * FROM dt_usuarios_externos WHERE  `id` = '%s'", $id);
  $data = mysql_query($query);
  $row = mysql_fetch_assoc($data);
  
  return $row;
}

function getPdvsList()
{
  $result = array();
  $query= sprintf("SELECT * FROM relaciones ORDER BY c_costo_nombre ASC");
  $data = mysql_query($query);
  while( $row = mysql_fetch_assoc($data))
  {
    $result[] = $row;
  }
  return $result;
}

function findPdv($c_costo)
{
  $query= sprintf("SELECT * FROM relaciones  WHERE  `c_costo_id` = '%s'", $c_costo);
  $data = mysql_query($query);
  $row = mysql_fetch_assoc($data);
  return $row;
}

function findPdvById($id)
{
  $query= sprintf("SELECT * FROM relaciones  WHERE  `id` = '%s'", $id);
  $data = mysql_query($query);
  $row = mysql_fetch_assoc($data);
  return $row;
}

function getUserList()
{
  $result = array();
  $query= sprintf("SELECT * FROM dt_usuarios_externos ORDER BY usuario_email ASC");
  $data = mysql_query($query);
  while( $row = mysql_fetch_assoc($data))
  {
    $result[] = $row;
  }
  return $result;
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
    printCol($poll['periodo']);
    printCol($poll['mes']);
    printCol($poll['pventa']);
    printCol($poll['c_costo']);
    printCol($poll['p1']);
    printCol($poll['p1_razones']);
    printCol($poll['p2a']);
    printCol($poll['p2b']);
    printCol($poll['p2c']);
    printCol($poll['p2d']);
    printCol($poll['p2e']);
    printCol($poll['p2f']);
    printCol($poll['p3a']);
    printCol($poll['p3b']);
    printCol($poll['p3c']);
    printCol($poll['p3d']);
    printCol($poll['p3e']);
    printCol($poll['p3f']);
    printCol($poll['p3g']);
    printCol($poll['p3h']);
    printCol($poll['b1']);
    printCol($poll['b1_razones']);
    printCol($poll['b2']);
    printCol($poll['b2_razones']);
    printCol($poll['k1']);
    printCol($poll['k2']);
    printCol($poll['nombre']);
    printCol($poll['genero']);
    printCol($poll['edad']);
    printCol($poll['telefono']);
    printCol($poll['email']);
    printCol($poll['synchronized']);
    printCol($poll['notified']);
    
    print("</tr>");
  }
}

function printPdvsTable($pdvs)
{
  foreach($pdvs as $pdv)
  {
    print("<tr>");
    printf("<td><a href='edit_pdv.php?pdv_id=%s'> %s </a></td>", $pdv['id'], $pdv['c_costo_id']);
    printCol($pdv['c_costo_nombre']);
    printCol($pdv['pais']);
    printCol($pdv['ciudad']);
    printCol($pdv['regional']);
    printCol($pdv['zona']);
    printCol($pdv['direccion']);
    printCol($pdv['unidad_negocio']);
    printCol($pdv['latitud']);
    printCol($pdv['longitud']);
    print("</tr>");
  }

  return 0;
}

function translateUserType($type)
{
  $return = "CLIENTE";
  
  switch ($type) {
    case 1:
        $return = "CLIENTE";
        break;
    case 2:
        $return = "ADMINISTRADOR";
        break;
  }
  
  return $return;
}

function translateState($state)
{
  $return = "ACTIVADO";
  
  switch ($state) {
    case 2:
        $return = "DESACTIVADO";
        break;
    case 1:
        $return = "ACTIVADO";
        break;
  }
  
  return $return;
}

function printUsersTable($users)
{
  foreach($users as $user)
  {
    print("<tr>");
    printf("<td><a href='edit_user.php?user_id=%s'> %s </a></td>", $user['id'], $user['usuario_email']);
    printCol("******");
    printCol(translateUserType($user['nivel']));
    printCol(translateState($user['estado']));
    print("</tr>");
  }
}