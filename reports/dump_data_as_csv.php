<?php 

$cona=mysqli_connect("localhost","synapsis_vsr","vsr123=","synapsis_tracking_popsy");

$query = sprintf("SELECT * FROM dt_encuesta_popsy WHERE mes = '2' and periodo = '2015'");
$resultado = mysqli_query($cona,$query);


header('Content-Type: text/html; charset=utf-8');
/*header('Content-Disposition: attachment; filename=data.csv');*/

// create a file pointer connected to the output stream
// $output = fopen('php://output', 'w');

  $dumped = true;
  echo "<table>";
  while (($row = mysqli_fetch_assoc($resultado)))
  {
    if( $dumped)
    {
      echo "<tr>";
      foreach($row as $key => $value)
      {
        echo "<td>".$key."</td>";
      }
      echo "</tr>";
    }
    $dumped = false;
    if( !$dumped)
    {
      echo "<tr>";
      foreach($row as $key => $value)
      {
        echo "<td>".$value."</td>";
      }
      echo "</tr>";
    }
  }
  echo "</table>";
mysqli_close($cona);