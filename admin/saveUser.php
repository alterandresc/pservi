<?php

include('lock.php');
include('admin_process.php');

function saveUser($datos)
{
  $query = sprintf("INSERT INTO `synapsis_tracking_popsy`.`dt_usuarios_externos` (
          `id` ,
          `usuario_email` ,
          `usuario_clave` ,
          `nivel` ,
          `estado`
          )
          VALUES (
          NULL , '%s', '%s', '%s', '%s'
          );",
          $datos['usuario_email'],
          $datos['usuario_clave'],
          $datos['nivel'],
          $datos['estado']);
  mysql_query($query);
}

saveUser($_POST);
header("Location: users.php?");
