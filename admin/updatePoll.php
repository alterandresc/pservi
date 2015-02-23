<?php

include('lock.php');
include('admin_process.php');

$pdv = array();
if(isset($_POST['poll_id']))
{
  $pdv = findPdv($_POST['pdventa']);
}else
{
  header("Location: indexa.php");
}


function updateField($name, $value, $id)
{
  $query = sprintf("UPDATE `synapsis_tracking_popsy`.`dt_encuesta_popsy` SET `%s` = '%s' WHERE `dt_encuesta_popsy`.`id` = %s;",$name,$value,$id);
  mysql_query($query);
}

function updatePoll($datos, $pdv)
{
  updateField('periodo',$datos['anio'],$datos['poll_id']);
  updateField('mes',$datos['mes'],$datos['poll_id']);
  updateField('pventa',$pdv['c_costo_nombre'],$datos['poll_id']);
 
  updateField('pais',$pdv['pais'],$datos['poll_id']);
  updateField('ciudad',$pdv['ciudad'],$datos['poll_id']);
  updateField('regional',$pdv['regional'],$datos['poll_id']);
  updateField('zona',$pdv['zona'],$datos['poll_id']);
  updateField('c_costo',$pdv['c_costo_id'],$datos['poll_id']);
  updateField('razon_social',$pdv['unidad_negocio'],$datos['poll_id']);
  
  updateField('p1',$datos['p1'],$datos['poll_id']);
  updateField('p1_razones',$datos['p1_razones'],$datos['poll_id']);
  updateField('p2a',$datos['p2a'],$datos['poll_id']);
  updateField('p2b',$datos['p2b'],$datos['poll_id']);
  updateField('p2c',$datos['p2c'],$datos['poll_id']);
  updateField('p2d',$datos['p2d'],$datos['poll_id']);
  updateField('p2e',$datos['p2e'],$datos['poll_id']);
  updateField('p2f',$datos['p2f'],$datos['poll_id']);
  
  updateField('p3a',$datos['p3a'],$datos['poll_id']);
  updateField('p3b',$datos['p3b'],$datos['poll_id']);
  updateField('p3c',$datos['p3c'],$datos['poll_id']);
  updateField('p3d',$datos['p3d'],$datos['poll_id']);
  updateField('p3e',$datos['p3e'],$datos['poll_id']);
  updateField('p3f',$datos['p3f'],$datos['poll_id']);
  updateField('p3g',$datos['p3g'],$datos['poll_id']);
  updateField('p3h',$datos['p3h'],$datos['poll_id']);
  
  updateField('b1',$datos['b1'],$datos['poll_id']);
  updateField('b1_razones',$datos['b1_razones'],$datos['poll_id']);
  updateField('b2',$datos['b2'],$datos['poll_id']);
  updateField('b2_razones',$datos['b2_razones'],$datos['poll_id']);
  
  updateField('K1',$datos['k1'],$datos['poll_id']);
  updateField('K2',$datos['k2'],$datos['poll_id']);
  
  updateField('nombre',$datos['nombre'],$datos['poll_id']);
  updateField('genero',$datos['genero'],$datos['poll_id']);
  updateField('edad',$datos['edad'],$datos['poll_id']);
  updateField('telefono',$datos['telefono'],$datos['poll_id']);
  updateField('email',$datos['email'],$datos['poll_id']);
  
  updateField('synchronized',$datos['synchronized'],$datos['poll_id']);
  updateField('notified',$datos['notified'],$datos['poll_id']);

}

updatePoll($_POST, $pdv);

$om = $_POST['om'];
$oy = $_POST['oy'];

 header("Location: index.php?mes=$om&anio=$oy");
