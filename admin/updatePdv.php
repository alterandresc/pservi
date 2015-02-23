<?php

include('lock.php');
include('admin_process.php');

if(isset($_POST['pdv_id']))
{
  $pdv = findPdvById($_POST['pdv_id']);
}else
{
  header("Location: index.php");
}


function updateField($name, $value, $id)
{
  $query = sprintf("UPDATE `synapsis_tracking_popsy`.`relaciones` SET `%s` = '%s' WHERE `relaciones`.`id` = %s;",$name,$value,$id);
  mysql_query($query);
}

function updatePdv($datos)
{
  updateField('c_costo_nombre',strtoupper($datos['c_costo_nombre']),$datos['pdv_id']);
  updateField('c_costo_nombre_legible',strtoupper($datos['c_costo_nombre']),$datos['pdv_id']);
 
  updateField('pais',strtoupper($datos['pais']),$datos['pdv_id']);
  updateField('ciudad',strtoupper($datos['ciudad']),$datos['pdv_id']);
  updateField('regional',strtoupper($datos['regional']),$datos['pdv_id']);
  updateField('zona',strtoupper($datos['zona']),$datos['pdv_id']);
  updateField('direccion',strtoupper($datos['direccion']),$datos['pdv_id']);
  updateField('c_costo_id',strtoupper($datos['c_costo_id']),$datos['pdv_id']);
  updateField('unidad_negocio',strtoupper($datos['unidad_negocio']),$datos['pdv_id']);
  updateField('latitud',strtoupper($datos['latitud']),$datos['pdv_id']);
  updateField('longitud',strtoupper($datos['longitud']),$datos['pdv_id']);
}

updatePdv($_POST);

 header("Location: pdvs.php?show=true");
