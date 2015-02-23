<?php

include('lock.php');
include('admin_process.php');

if(!isset($_POST['user_id']))
{
  header("Location: index.php");
}


function updateField($name, $value, $id)
{
  $query = sprintf("UPDATE `synapsis_tracking_popsy`.`dt_usuarios_externos` SET `%s` = '%s' WHERE `dt_usuarios_externos`.`id` = %s;",$name,$value,$id);
  mysql_query($query);
}

function updateUser($datos)
{
  updateField('usuario_email',$datos['usuario_email'],$datos['user_id']);
  if($datos['usuario_clave'] != "")
  {
    updateField('usuario_clave',$datos['usuario_clave'],$datos['user_id']);
  }

  updateField('nivel',strtoupper($datos['nivel']),$datos['user_id']);
  updateField('estado',strtoupper($datos['estado']),$datos['user_id']);
}

updateUser($_POST);

 header("Location: users.php?");
