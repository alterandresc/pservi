<?php
 
	require_once('conection.php');
	
	function actualizar_pventas_nulos(){
		$query = "SELECT * FROM `dt_encuesta_popsy` WHERE pventa is null and c_costo is not null";
		$data = mysql_query($query);
		while ($row = mysql_fetch_assoc($data))
		{
			$query2= sprintf("SELECT * FROM `relaciones` WHERE c_costo_id  = '%s'",$row['c_costo']);
			$data2 = mysql_query($query2);
			$row2 = mysql_fetch_assoc($data2);
			
			echo  $row['id']." ".$row['c_costo']." ".$row2['c_costo_nombre']." ".$row2['pais']." ".$row2['ciudad']." ".$row2['regional']." ".$row2['zona'];
			
			
			$query3 = sprintf("UPDATE `dt_encuesta_popsy` SET `pventa` = '%s',
								`pais` = '%s',
								`ciudad` = '%s',
								`regional` = '%s',
								`zona` = '%s' WHERE `dt_encuesta_popsy`.`id` = %s;",$row2['c_costo_nombre'],$row2['pais'],$row2['ciudad'],$row2['regional'],$row2['zona'],$row['id']);
								
								
			$data3 = mysql_query($query3);
			if($data3)
			{
				echo " Bien"; 
			}else
			{
				echo "no ";
				}
			echo "<br>"; 
		}
	
}

function actualizar_por_pventa(){
		$query = "SELECT * FROM `dt_encuesta_popsy` WHERE c_costo = '' and pventa is not null";
		$data = mysql_query($query);
		while ($row = mysql_fetch_assoc($data))
		{
			$query2= sprintf("SELECT * FROM `relaciones` WHERE c_costo_nombre  = '%s'",$row['pventa']);
			$data2 = mysql_query($query2);
			$row2 = mysql_fetch_assoc($data2);
			
			echo  $row['id']." ".$row['pventa']." ".$row2['c_costo_id'];
			
			
			$query3 = sprintf("UPDATE `dt_encuesta_popsy` SET `razon_social` = '%s',
								`pais` = '%s',
								`ciudad` = '%s',
								`regional` = '%s',
								`zona` = '%s',
								`c_costo` = '%s'
							  WHERE `dt_encuesta_popsy`.`id` = %s;",$row2['unidad_negocio'],$row2['pais'],$row2['ciudad'],$row2['regional'],$row2['zona'],$row2['c_costo_id'],$row['id']);
								
			
								
			$data3 = mysql_query($query3);
			if($data3)
			{
				echo " Bien"; 
			}else
			{
				echo "no ";
				}
			echo "<br>"; 
		}
	
}

function actualizar_razon_social_nulos(){
		$query = "SELECT * FROM `dt_encuesta_popsy` WHERE razon_social is null and c_costo is not null";
		$data = mysql_query($query);
		while ($row = mysql_fetch_assoc($data))
		{
			$query2= sprintf("SELECT * FROM `relaciones` WHERE c_costo_id  = '%s'",$row['c_costo']);
			$data2 = mysql_query($query2);
			$row2 = mysql_fetch_assoc($data2);
			
			echo  $row['id']." ".$row['c_costo']." ".$row2['unidad_negocio'];
			
			
			$query3 = sprintf("UPDATE `dt_encuesta_popsy` SET `razon_social` = '%s'
							  WHERE `dt_encuesta_popsy`.`id` = %s;",$row2['unidad_negocio'],$row['id']);
								
			
								
			$data3 = mysql_query($query3);
			if($data3)
			{
				echo " Bien"; 
			}else
			{
				echo "no ";
				}
			echo "<br>"; 
		}
	
}

function actualizar_por_pventa_y_c_costo(){
		$query = "SELECT * FROM `dt_encuesta_popsy` WHERE c_costo is not null and pventa is not null and ciudad is null";
		$data = mysql_query($query);
		while ($row = mysql_fetch_assoc($data))
		{
			$query2= sprintf("SELECT * FROM `relaciones` WHERE c_costo_nombre  = '%s'",$row['pventa']);
			$data2 = mysql_query($query2);
			$row2 = mysql_fetch_assoc($data2);
			
			echo  $row['id']." ".$row['pventa']." ".$row2['c_costo_id'];
			
			
			$query3 = sprintf("UPDATE `dt_encuesta_popsy` SET `razon_social` = '%s',
								`pais` = '%s',
								`ciudad` = '%s',
								`regional` = '%s',
								`zona` = '%s'
							  WHERE `dt_encuesta_popsy`.`id` = %s;",$row2['unidad_negocio'],$row2['pais'],$row2['ciudad'],$row2['regional'],$row2['zona'],$row['id']);
								
			
								
			$data3 = mysql_query($query3);
			if($data3)
			{
				echo " Bien"; 
			}else
			{
				echo "no ";
				}
			echo "<br>"; 
		}
	}

	//actualizar_pventas_nulos();
	//actualizar_razon_social_nulos();
	//actualizar_por_pventa();
	
	//actualizar_por_pventa_y_c_costo();
function actualizar_latitudes_y_longitudes($nombre, $latitud, $longitud)
{
	$query = sprintf("UPDATE `visor`.`relaciones` SET `latitud` = '%s', `longitud` = '%s'  WHERE `relaciones`.`c_costo_nombre` = '%s';",
	 $latitud,$longitud,$nombre);
	 $data2 = mysql_query($query);
}
		
actualizar_latitudes_y_longitudes($_POST['nombre'], $_POST['latitud'], $_POST['longitud']);
