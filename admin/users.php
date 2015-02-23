<?php
header('Content-Type: text/html; charset=utf-8');

include('lock.php');
include('admin_process.php');

ini_set("log_errors", 1);
ini_set("error_log", "error.log");

$pdvs = getUserList();
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
            <li class="active" style="color:#FFFFFF"><a style="color:#FFFFFF" href="users.php" style="color:#FFFF">Usuarios</a></li>
            <li style="color:#FFFFFF"><a style="color:#FFFFFF" href="survey.php" style="color:#FFFF">Survey TO GO</a></li>
			<li style="color:#FFFFFF"><a style="color:#FFFFFF" href="../security/logout.php" style="color:#FFFF">Salir</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <a class="btn btn-default" href="addUser.php">
            <span class="glyphicon glyphicon-plus"> Agregar nuevo usuario</span>
          </a>
        </div>
      </div>
    <div class="row cuerpo">
      <table class="table striped" >
        <thead>
          <tr>
            <th> USUARIO </th>
            <th> CONTRASEÑA </th>
            <th> TIPO </th>
            <th> ACTIVO </th>
          </tr>
        </thead>
        <tbody>
        <?php
          printUsersTable($pdvs);
        ?>
        </tbody>
      </table>
    </div>
    </div><!-- /.container -->
  </body>
</html>
 
