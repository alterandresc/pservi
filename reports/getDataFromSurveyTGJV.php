<?php
/** Error reporting */
error_reporting(E_ALL);

  // Conexi´on
  $cona=mysqli_connect("localhost","synapsis_vsr","vsr123=","synapsis_tracking_popsy");
//   $cona=mysqli_connect("localhost","root","sky123","synapsis_tracking_popsy");


  function insertPoll($map_array,$con)
  {
    $insert_query = sprintf("INSERT INTO `synapsis_tracking_popsy`.`dt_encuesta_popsy` (`id`,
                                                              `fecha`,
                                                              `periodo`,
                                                              `mes`,
                                                              `pventa`,
                                                              `p1`, 
                                                              `p1_razones`,
                                                              `p2a`,
                                                              `p2b`, 
                                                              `p2c`,
                                                              `p2d`,
                                                              `p2e`, 
                                                              `p2f`, 
                                                              `p3a`, 
                                                              `p3b`,
                                                              `p3c`,
                                                              `p3d`,
                                                              `p3e`, 
                                                              `p3f`,
                                                              `p3g`, 
                                                              `p3h`, 
                                                              `b1`,
                                                              `b1_razones`,
                                                              `b2`,
                                                              `b2_razones`,
                                                              `k1`,
                                                              `k2`,
                                                              `pais`,
                                                              `ciudad`, 
                                                              `regional`,
                                                              `zona`, 
                                                              `direccion`,
                                                              `c_costo`,
                                                              `razon_social`,
                                                              `nombre`, 
                                                              `genero`,
                                                              `edad`,
                                                              `telefono`,
                                                              `email`,
                                                              `hora_inicio`,
                                                              `hora_final`,
                                                              `latitud`,
                                                              `longitud`,
                                                              `time_stamp`,
                                                              `encuestador`,
                                                              `bandera`, 
                                                              `synchronized`,
                                                              `notified`, 
                                                              `live_notified`, 
                                                              `srvid`) 
                                                              VALUES (NULL,
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s', 
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s', 
                                                              '%s',
                                                              '%s', 
                                                              '%s', 
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s',
                                                              '%s', 
                                                              '%s',
                                                              '%s', 
                                                              '%s',
                                                              '%s',
                                                              '%s', 
                                                              '%s', 
                                                              '%s',
                                                              'jv',
                                                              '0', 
                                                              '0', 
                                                              '0',
                                                              '%s');",
                                                              $map_array['FECHA'],
                                                              $map_array['PERIODO'],
                                                              $map_array['MES'],
                                                              $map_array['PVENTA'],
                                                              $map_array['P1'],
                                                              $map_array['P1_RAZONES'],
                                                              $map_array['P2A'],
                                                              $map_array['P2B'],
                                                              $map_array['P2C'],
                                                              $map_array['P2D'],
                                                              $map_array['P2E'],
                                                              $map_array['P2F'],
                                                              $map_array['P3A'],
                                                              $map_array['P3B'],
                                                              $map_array['P3C'],
                                                              $map_array['P3D'],
                                                              $map_array['P3E'],
                                                              $map_array['P3F'],
                                                              $map_array['P3G'],
                                                              $map_array['P3H'],
                                                              $map_array['B1'],
                                                              $map_array['B1_RAZONES'],
                                                              $map_array['B2'],
                                                              $map_array['B2_RAZONES'],
                                                              $map_array['K1'],
                                                              $map_array['K2'],
                                                              $map_array['PAIS'],
                                                              $map_array['CIUDAD'],
                                                              $map_array['REGIONAL'],
                                                              $map_array['ZONA'],
                                                              $map_array['DIRECCION'],
                                                              $map_array['C_COSTO'],
                                                              $map_array['RAZON_SOCIAL'],
                                                              $map_array['NOMBRE'],
                                                              $map_array['GENERO'],
                                                              $map_array['EDAD'],
                                                              $map_array['TELEFONO'],
                                                              $map_array['EMAIL'],
                                                              $map_array['HORA_INICIO'],
                                                              $map_array['HORA_FINAL'],
                                                              $map_array['LATITUD'],
                                                              $map_array['LONGITUD'],
                                                              $map_array['TIMESTAMP'],
                                                              $map_array['ENCUESTADOR'],
                                                              $map_array['SRVID']);

      if(!mysqli_query($con,$insert_query))
      {
        echo "ERROR INSERTANDO SRVID: ".$map_array['SRVID'].PHP_EOL;
      }
      else
      {
	echo "ENCUESTA INSERTADA CON SRVID: ".$map_array['SRVID'].PHP_EOL;
      }
    //echo $insert_query;
  }

  function getPDVInfo($pdv_id, $con)
  {
    $query_map = sprintf("SELECT * FROM `pdvs_map` WHERE  `sheet_index` = '%s' ",$pdv_id);
    $result_map = mysqli_query($con,$query_map );
    $result_f_map = mysqli_fetch_assoc($result_map);
    $query = sprintf("SELECT * FROM `relaciones` WHERE  `c_costo_nombre` LIKE '%s' ",$result_f_map['pdv_nombre']);
    $result = mysqli_query($con,$query);
    return mysqli_fetch_assoc($result);
  }

  function existPoll($srvid, $flag, $con)
  {
    $query = sprintf("SELECT * FROM `dt_encuesta_popsy`  WHERE `dt_encuesta_popsy`.`srvid` = '%s' AND  `dt_encuesta_popsy`.`bandera` = '%s';",$srvid,$flag );
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)>= 1)
    {
      return true;
    }
    return false;
  }

  function buildMappedPoll($datos, $con)
  {
//   PROCESS PDV INFO
    $pdv_info = getPDVInfo($datos[33], $con); 
    $pdv_pais = $pdv_info['pais'];
    $pdv_ciudad = $pdv_info['ciudad'];
    $pdv_regional= $pdv_info['regional'];
    $pdv_zona = $pdv_info['zona'];
    $pdv_nombre = $pdv_info['c_costo_nombre'];
    $pdv_id = $pdv_info['c_costo_id'];
    $pdv_unidad = $pdv_info['unidad_negocio'];
    
//  PRCESS DATE INFO
    $date = $datos[2];
    $date_parts = explode(" ", $date);
    $date_parts_day = explode("/",$date_parts[0]);
    $day = $date_parts_day[1];
    $month = $date_parts_day[0];
    $year = $date_parts_day[2];
    $timestamp = $year."-".$month."-".$day." ".$date_parts[1].":00";

    $map_array = array();
    $map_array['FECHA'] = $datos[2]; //OK
    $map_array['PERIODO'] = $year; //OK
    $map_array['MES'] = $month; //OK
    $map_array['PVENTA'] = $pdv_nombre; //OK
    $map_array['P1'] = $datos[35]; //
    $map_array['P1_RAZONES'] = $datos[36]; //OK
    $map_array['P2A'] = $datos[37];  //OK
    $map_array['P2B'] = $datos[38]; //OK
    $map_array['P2C'] = $datos[39]; //OK
    $map_array['P2D'] = $datos[40]; //OK
    $map_array['P2E'] = $datos[41]; //OK
    $map_array['P2F'] = $datos[42]; //OK
    $map_array['P3A'] = $datos[43]; //OK
    $map_array['P3B'] = $datos[44]; //OK
    $map_array['P3C'] = $datos[45]; //OKOK
    $map_array['P3D'] = $datos[46];; //OK
    $map_array['P3E'] = $datos[47]; //OKOK
    $map_array['P3F'] = $datos[48]; //OK
    $map_array['P3G'] = $datos[49]; //OK
    $map_array['P3H'] = $datos[50]; //OK
    $map_array['B1'] = $datos[51]; //
    $map_array['B1_RAZONES'] = $datos[52]; //
    $map_array['B2'] = $datos[53]; //
    $map_array['B2_RAZONES'] = $datos[54]; //
    $map_array['K1'] = $datos[55]; //
    $map_array['K2'] = ""; //OK
    $map_array['PAIS'] = $pdv_pais;  //OK
    $map_array['CIUDAD'] = $pdv_ciudad; //OK
    $map_array['REGIONAL'] = $pdv_regional; //OK
    $map_array['ZONA'] = $pdv_zona; //OK
    $map_array['DIRECCION'] = ""; //OK
    $map_array['C_COSTO'] = $pdv_id; //OK
    $map_array['RAZON_SOCIAL'] = $pdv_unidad; //OK
    $map_array['NOMBRE'] = $datos[28]; //OK
    $map_array['GENERO'] = $datos[29]; //OK
    $map_array['EDAD'] = $datos[30]; //OK
    $map_array['TELEFONO'] = $datos[32]; //OK
    $map_array['EMAIL'] = $datos[31]; //OK
    $map_array['HORA_INICIO'] = $date_parts[1]; //OK
    $map_array['HORA_FINAL'] = $date_parts[1]; //OK
    $map_array['LATITUD'] = 0; //OK
    $map_array['LONGITUD'] = 0; //OK
    $map_array['TIMESTAMP'] = $timestamp; //OK
    $map_array['ENCUESTADOR'] = $datos[26]; //OK
    $map_array['BANDERA'] = "jv"; //OK 
    $map_array['SYNCHRONIZED'] = 0;  //OK
    $map_array['NOTIFIED'] = 0; //OK
    $map_array['LIVE_NOTIFIED'] = 0;  //OK
    $map_array['SRVID'] = $datos[0];
    return $map_array;
 }

 
 //   CONEXION

//   FILE DOWNLOAD
  $date = date("y_m_d_H_i_s");
  $new_filename = sprintf("files/new_eval_jv_%s.csv",$date);
  $cmd_to_execute = sprintf("wget http://synapsis-rs.org/popsy/juan.csv -O %s", $new_filename);
  exec($cmd_to_execute);
  $result = array();
  header('Content-Type: application/json');

  //   DUMP FILE IN  DATABASE
  $fila = 1;
  //$new_filename = "juan.CSV";
  if (($gestor = fopen($new_filename, "r")) !== FALSE) {
      $msj = "NO_ENTRY".PHP_EOL;
      while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        if($fila > 1)
        {
          $poll = buildMappedPoll($datos,$cona);
          if(!existPoll($poll['SRVID'],$poll['BANDERA'], $cona))
          {
            insertPoll($poll,$cona);
            $result[] = "[OK] ENCUESTA CON SRVID: ".$poll['SRVID']." HA SIDO INSERTADA EN EL SISTEMA".PHP_EOL;
          }else
          {
            $result[] = "[ERROR] ENCUESTA CON SRVID: ".$poll['SRVID']." YA EXISTE EN EL SISTEMA".PHP_EOL;
          }
        }
        $fila++;
      }
      exec(sprintf("echo '%s' > info_%s.log",$msj,$date));
      echo json_encode($result);
      fclose($gestor);
  }

  mysqli_close($cona);
?>
