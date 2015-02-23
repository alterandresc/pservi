<?php
header('Content-Type: text/html; charset=utf-8');

include('lock.php');
include('admin_process.php');

ini_set("log_errors", 1);
ini_set("error_log", "error.log");

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
          <a class="navbar-brand" href="#" style="color:#FFFF"> Popsy ADMIN</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="index.php" style="color:#FFFF"> Encuestas </a></li>
            <li style="color:#FFFFFF"><a style="color:#FFFFFF" href="pdvs.php" style="color:#FFFF">Puntos de venta</a></li>
            <li  style="color:#FFFFFF"><a style="color:#FFFFFF" href="users.php" style="color:#FFFF">Usuarios</a></li>
            <li class="active" style="color:#FFFFFF"><a style="color:#FFFFFF" href="survey.php" style="color:#FFFF">Survey TO GO</a></li>
			<li style="color:#FFFFFF"><a style="color:#FFFFFF" href="../security/logout.php" style="color:#FFFF">Salir</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      <div class="row cuerpo">
        <div class="col-md-4">
          <form action="." method="GET">
          </form>
        </div>
      </div>
      <div class="row cuerpo">
        <div class="col-md-16" >
          <div id="getSurvey" class="btn btn-default" > Obtener datos Survey To GO Popsy</div>
          <div id="getSurveyJV" class="btn btn-default" > Obtener datos Survey To GO Juan Valdez</div>
        </div>
      </div>
      
      <div id="polls_container">
        <div class="row">
          <div class="col-md-16" >
          </div>
        </div>
      </div>

    </div><!-- /.container -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script>
      $('#getSurvey').click(function() {
        $.post( "../reports/getDataFromSurveyTG.php", function( data ) {
          data.forEach(function(entry) {
            $('#polls_container').append('<div class="row"><div class="col-md-20" >'+entry+' </div></div>');
          });
        }, "json");
      });
      
      $('#getSurveyJV').click(function() {
        $.post( "../reports/getDataFromSurveyTGJV.php", function( data ) {
          data.forEach(function(entry) {
            $('#polls_container').append('<div class="row"><div class="col-md-20" >'+entry+' </div></div>');
          });
        }, "json");
      });
    </script>
  </body>
</html>
 
