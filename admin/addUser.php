<?php
header('Content-Type: text/html; charset=utf-8');

include('lock.php');
include('admin_process.php');

ini_set("log_errors", 1);
ini_set("error_log", "error.log");

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
            <li class="active"  style="color:#FFFFFF"><a style="color:#FFFFFF" href="users.php" style="color:#FFFF">Usuarios</a></li>
            <li style="color:#FFFFFF"><a style="color:#FFFFFF" href="survey.php" style="color:#FFFF">Survey TO GO</a></li>
                        <li style="color:#FFFFFF"><a style="color:#FFFFFF" href="../security/logout.php" style="color:#FFFF">Salir</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
    <form action="saveUser.php" method="POST">
      <input type="hidden" name="user_id" value="">

      <div class="row">
        <div class="col-md-6" > <label for="exampleInputEmail1"> USUARIO </label> </div>
        <div class="col-md-7">
          <input type="text" name="usuario_email" value=""  size="35">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6" > <label for="exampleInputEmail1"> CONTRASEÑA </label> </div>
        <div class="col-md-7">
          <input type="text" name="usuario_clave" value=""  size="35">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6" ><label for="exampleInputEmail1"> TIPO DE USUARIO </label></div>
        <div class="col-md-6">
          <select id="nivel" class="form-control" name="nivel" value="" >
                            <option value="1"> Cliente </option>
                            <option value="2"> Administrador </option>
          </select>
        </div>
      </div>
      
      <div class="row">
         <div class="col-md-6" > <label for="exampleInputEmail1"> ESTADO </label></div>
        <div class="col-md-6">
          <select id="estado" class="form-control" name="estado" value="" >
              <option value="1"> Activado </option>
              <option value="2"> Desactivado </option>
          </select>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <input type="submit" value="Guardar Usuario">
        </div>
      </div>
    </form>

    </div><!-- /.container -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script>
    </script>
  </body>
</html>
 
