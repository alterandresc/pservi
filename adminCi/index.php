<?php
header('Content-Type: text/html; charset=utf-8');

include('lock.php');
include('admin_process.php');

ini_set("log_errors", 1);
ini_set("error_log", "ci_error.log");

$polls = array();
$total = 0;

$mes ="";
$anio = "";
$limit= 100;
if(isset($_GET['limit']))
{
  $limit= $_GET['limit'];
}
if(isset($_GET['anio']) && isset($_GET['mes']))
{
  $mes = $_GET['mes'];
  $anio = $_GET['anio'];
  $polls = getPollsFor($_GET['anio'], $_GET['mes'], $limit);
  $total = countPolls($_GET['anio'], $_GET['mes']);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Popsy / Gelarti / Juan Valdez</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../vendor/css/starter-template.css" rel="stylesheet">
    
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header" style="color:#FFFFFF">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="color:#FFFF"> Popsy CI ADMIN</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php" style="color:#FFFF"> Encuestas </a></li>
            <li style="color:#FFFFFF"><a style="color:#FFFFFF" href="pdvs.php" style="color:#FFFF">Puntos de venta</a></li>
            <li style="color:#FFFFFF"><a style="color:#FFFFFF" href="users.php" style="color:#FFFF">Usuarios</a></li>
            <li style="color:#FFFFFF"><a style="color:#FFFFFF" href="survey.php" style="color:#FFFF">Survey TO GO</a></li>
			<li style="color:#FFFFFF"><a style="color:#FFFFFF" href="../security/logout.php" style="color:#FFFF">Salir</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
    <form action="." method="GET">
      <div class="row">
        <div class="col-md-3">
            <div class="form-group">
              <label for="exampleInputEmail1"> Año </label>
                  <select id="anio" class="form-control" name="anio" >
                          <option value="2014"> 2014 </option>
                          <option value="2015"> 2015 </option>
                          <option value="2016"> 2016 </option>
                          <option value="2017"> 2017 </option>
                          <option value="2018"> 2018 </option>
                          <option value="2019"> 2019 </option>
                          <option value="2020"> 2020 </option>
                          <option value="2021"> 2021 </option>
                          <option value="2022"> 2022 </option>
                          <option value="2023"> 2023 </option>
                          <option value="2024"> 2024 </option>
                          <option value="2025"> 2025 </option>
                  </select>
            </div>  
        </div>
        <div class="col-md-3">
            <div class="form-group">
              <label for="exampleInputEmail1"> Año </label>
                  <select id="mes" class="form-control" name="mes" >
                          <option value="1"> (01) Enero </option>
                          <option value="2"> (02) Febrero </option>
                          <option value="3"> (03) Marzo </option>
                          <option value="4"> (04) Abril </option>
                          <option value="5"> (05)  Mayo </option>
                          <option value="6"> (06) Junio </option>
                          <option value="7"> (07) Julio </option>
                          <option value="8"> (08) Agosto </option>
                          <option value="9"> (09) Septiembre </option>
                          <option value="10"> (10) Octubre </option>
                          <option value="11"> (11) Noviembre </option>
                          <option value="12"> (12) Diciembre </option>
                  </select>
            </div> 
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1"> # Máximo de registros a cargar </label>
              <input type="text" value="<?php echo $limit?>" name="limit" id="limit">
            </div> 
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <input type="submit" value="Buscar Encuestas">
        </div>
      </div>
    </form>
      <div class="row">
        <br>
        <br>
        <div class="col-md-3">
          <label for="exampleInputEmail1"> Total Registros </label>
          <?php echo $total;?>
        </div>
      </div>
    <div class="row cuerpo">
      <table class="table striped" >
        <thead>
          <tr>
            <th> ID </th>
            <th> SURVEY ID </th>
            <th> FECHA </th>
            <th> PERIODO </th>
            <th> MES </th>
            <th> PDV </th>
            <th> PDV ID</th>
            <th> P1 </th>
            <th> P2 </th>
            <th> P3 </th>
            <th> P4 </th>
            <th> P5 </th>
            <th> P6 </th>
            <th> p7 </th>
            <th> P8 </th>
            <th> P8 Rasgos Físicos </th>
            <th> P8 Personas </th>
            <th> P9 </th>
            <th> p10 </th>
            <th> P11 </th>
            <th> P12 </th>
            <th> P12b </th>
            <th> P13</th>
            <th> p13b </th>
            <th> p14 </th>
            <th> p15 </th>
            <th> p16 </th>
            <th> p17 </th>
            <th> p17 Rasgos Físicos </th>
            <th> p18 </th>
            <th> p18B </th>
            <th> p18C </th>
            <th> p18D </th>
            <th> p19 </th>
            <th> p20 </th>
            <th> p20 Mujeres </th>
            <th> p21 </th>
            <th> p21 Maquillaje </th>
            <th> p22 </th>
            <th> p22 Joyas </th>
            <th> p22 Hombres </th>
            <th> p23 </th>
            <th> p23 Afeitados </th>
            <th> p24 </th>
            <th> p24 Cabello </th>
            <th> p25 </th>
            <th> p25 Escarapela </th>
            <th> p26 </th>
            <th> p26 Uniforme </th>
            <th> p27 </th>
            <th> p28 </th>
            <th> p29 </th>
            <th> p30 </th>
            <th> p31 </th>
            <th> p32 </th>
            <th> p32 Lugar </th>
            <th> p33 </th>
            <th> p33 Sucio </th>
            <th> p34 </th>
            <th> p35 </th>
            <th> p36 </th>
            <th> p37 </th>
            <th> p38 </th>
            <th> NOMBRE </th>
            <th> GENERO </th>
            <th> EDAD </th>
            <th> TELEFONO </th>
            <th> SINCRONIZADA </th>
            <th> NOTIFICADA </th>
          </tr>
        </thead>
        <tbody>
        <?php
          printPollsTable($polls, $mes, $anio);
        ?>
        </tbody>
      </table>
    </div>
    </div><!-- /.container -->
  </body>
</html>
 
