<?php
header('Content-Type: text/html; charset=utf-8');

include('lock.php');
include('admin_process.php');

ini_set("log_errors", 1);
ini_set("error_log", "error.log");

if(isset($_GET['pdv_id']))
{
  $pdv = findPdvById($_GET['pdv_id']);
}else
{
  header("Location: index.php");
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
            <li class="active"  style="color:#FFFFFF"><a style="color:#FFFFFF" href="pdvs.php" style="color:#FFFF">Puntos de venta</a></li>
            <li  style="color:#FFFFFF"><a style="color:#FFFFFF" href="users.php" style="color:#FFFF">Usuarios</a></li>
            <li style="color:#FFFFFF"><a style="color:#FFFFFF" href="survey.php" style="color:#FFFF">Survey TO GO</a></li>
                        <li style="color:#FFFFFF"><a style="color:#FFFFFF" href="../security/logout.php" style="color:#FFFF">Salir</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
    <form action="updatePdv.php" method="POST">
      <input type="hidden" name="pdv_id" value="<?php echo $pdv['id']?>">

      <div class="row">
        <div class="col-md-6" > <label for="exampleInputEmail1"> IDENTIFICADOR </label> </div>
        <div class="col-md-7">
          <input type="text" name="c_costo_id" value="<?php echo $pdv['c_costo_id']?>"  size="35">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6" > <label for="exampleInputEmail1"> NOMBRE </label> </div>
        <div class="col-md-7">
          <input type="text" name="c_costo_nombre" value="<?php echo $pdv['c_costo_nombre']?>"  size="35">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6" ><label for="exampleInputEmail1"> PAIS </label></div>
        <div class="col-md-6">
          <input type="text" name="pais" size="35" value="<?php echo $pdv['pais']?>">
        </div>
      </div>
      
      <div class="row">
         <div class="col-md-6" > <label for="exampleInputEmail1"> CIUDAD </label></div>
        <div class="col-md-6">
          <input type="text" name="ciudad" size="35" value="<?php echo $pdv['ciudad']?>">
        </div>
      </div>
      
      <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> REGIONAL </label></div>
        <div class="col-md-6">
          <input type="text" name="regional" size="35" value="<?php echo $pdv['regional']?>">
        </div>
      </div>
      
      <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> ZONA </label></div>
        <div class="col-md-6">
          <input type="text" name="zona" size="35" value="<?php echo $pdv['zona']?>">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6" ><label for="exampleInputEmail1"> DIRECCIÓN </label></div>
        <div class="col-md-6">
          <input type="text" name="direccion" size="35" value="<?php echo $pdv['direccion']?>">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6" ><label for="exampleInputEmail1"> UNIDAD DE NEGOCIO </label></div>
        <div class="col-md-6">
          <input type="text" name="unidad_negocio" size="35" value="<?php echo $pdv['unidad_negocio']?>">
        </div>
      </div>
      
      <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> LATITUD </label></div>
        <div class="col-md-6">
          <input type="text" name="latitud" size="35" value="<?php echo $pdv['latitud']?>">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6" ><label for="exampleInputEmail1"> LONGITUD </label></div>
        <div class="col-md-6">
          <input type="text" name="longitud" size="35" value="<?php echo $pdv['longitud']?>">
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <input type="submit" value="Guardar Punto De Venta">
        </div>
      </div>
    </form>

    </div><!-- /.container -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script>
    </script>
  </body>
</html>
 
