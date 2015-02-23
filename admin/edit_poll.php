<?php
header('Content-Type: text/html; charset=utf-8');

include('lock.php');
include('admin_process.php');

mysql_set_charset('utf8');

ini_set("log_errors", 1);
ini_set("error_log", "error.log");

$polls = array();
$pdvs = array();
if(isset($_GET['poll_id']))
{
  $poll = findPoll($_GET['poll_id']);
  $pdvs = getPdvsList();
}else
{
  header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
            <li class="active"  ><a href="index.php" style="color:#FFFF"> Encuestas </a></li>
            <li style="color:#FFFFFF"><a style="color:#FFFFFF" href="pdvs.php" style="color:#FFFF">Puntos de venta</a></li>
            <li  style="color:#FFFFFF"><a style="color:#FFFFFF" href="users.php" style="color:#FFFF">Usuarios</a></li>
            <li style="color:#FFFFFF"><a style="color:#FFFFFF" href="survey.php" style="color:#FFFF">Survey TO GO</a></li>
                        <li style="color:#FFFFFF"><a style="color:#FFFFFF" href="../security/logout.php" style="color:#FFFF">Salir</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
    <form action="updatePoll.php" method="POST">
      <input type="hidden" name="poll_id" value="<?php echo $poll['id']?>">
      <input type="hidden" name="om" value="<?php echo $_GET['or_m']?>">
      <input type="hidden" name="oy" value="<?php echo $_GET['or_a']?>">
      <div class="row">
       <div class="col-md-6"> <label for="exampleInputEmail1"> Año </label></div> 
        <div class="col-md-3">
            <div class="form-group">
                  <select id="anio" class="form-control" name="anio" value="<?php echo $poll['periodo']?>">
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
      </div>
      
      <div class="row">
      <div class="col-md-6"> <label for="exampleInputEmail1"> Mes </label></div> 
        <div class="col-md-3">
            <div class="form-group">
                  <select id="mes" class="form-control" name="mes" value="<?php echo $poll['mes']?>" >
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
      </div>
      
      <div class="row">
      <div class="col-md-6"> <label for="exampleInputEmail1"> Punto de venta </label></div> 
        <div class="col-md-7">
            <div class="form-group">
                  <select id="pdventa" class="form-control" name="pdventa" value="<?php echo $poll['c_costo']?>" >
                          <option value="0"></option>
                          <?php
                            foreach($pdvs as $pdvi)
                            {
                              echo sprintf("<option value='%s'> %s ( %s ) </option>",$pdvi['c_costo_id'], $pdvi['c_costo_nombre'], $pdvi['c_costo_id'] );
                            }
                          ?>
                  </select>
            </div> 
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6" > <label for="exampleInputEmail1"> P1 </label> </div>
        <div class="col-md-7">
          <input type="text" name="p1" value="<?php echo $poll['p1']?>"  size="35">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6" ><label for="exampleInputEmail1"> P1 RAZONES </label></div>
        <div class="col-md-6">
          <input type="text" name="p1_razones" size="35" value="<?php echo $poll['p1_razones']?>">
        </div>
      </div>
      
      <div class="row">
         <div class="col-md-6" > <label for="exampleInputEmail1"> P2A </label></div>
        <div class="col-md-6">
          <input type="text" name="p2a" size="35" value="<?php echo $poll['p2a']?>">
        </div>
      </div>
      
      <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> P2B </label></div>
        <div class="col-md-6">
          <input type="text" name="p2b" size="35" value="<?php echo $poll['p2b']?>">
        </div>
      </div>
      
      <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> P2C </label></div>
        <div class="col-md-6">
          <input type="text" name="p2c" size="35" value="<?php echo $poll['p2c']?>">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6" ><label for="exampleInputEmail1"> P2D </label></div>
        <div class="col-md-6">
          <input type="text" name="p2d" size="35" value="<?php echo $poll['p2d']?>">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6" ><label for="exampleInputEmail1"> P2E </label></div>
        <div class="col-md-6">
          <input type="text" name="p2e" size="35" value="<?php echo $poll['p2e']?>">
        </div>
      </div>
      
      <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> P2F </label></div>
        <div class="col-md-6">
          <input type="text" name="p2f" size="35" value="<?php echo $poll['p2f']?>">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6" ><label for="exampleInputEmail1"> P3A </label></div>
        <div class="col-md-6">
          <input type="text" name="p3a" size="35" value="<?php echo $poll['p3a']?>">
        </div>
      </div>
      
      <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> P3B </label></div>
        <div class="col-md-6">
          <input type="text" name="p3b" size="35" value="<?php echo $poll['p3b']?>">
        </div>
      </div>
      
            <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> P3C </label></div>
        <div class="col-md-6">
          <input type="text" name="p3c" size="35" value="<?php echo $poll['p3c']?>">
        </div>
      </div>
      
            <div class="row">
        <div class="col-md-6" ><label for="exampleInputEmail1"> P3D </label></div>
        <div class="col-md-6">
          <input type="text" name="p3d" size="35" value="<?php echo $poll['p3d']?>">
        </div>
      </div>
      
            <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> P3E </label></div>
        <div class="col-md-6">
          <input type="text" name="p3e" size="35" value="<?php echo $poll['p3e']?>">
        </div>
      </div>
      
            <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> P3F </label></div>
        <div class="col-md-6">
          <input type="text" name="p3f" size="35" value="<?php echo $poll['p3f']?>">
        </div>
      </div>
      
            <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> P3G </label></div>
        <div class="col-md-6">
          <input type="text" name="p3g" size="35" value="<?php echo $poll['p3g']?>">
        </div>
      </div>
      
            <div class="row">
        <div class="col-md-6" ><label for="exampleInputEmail1"> P3H </label></div>
        <div class="col-md-6">
          <input type="text" name="p3h" size="35" value="<?php echo $poll['p3h']?>">
        </div>
      </div>
      
            <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> B1 </label></div>
        <div class="col-md-6">
          <input type="text" name="b1" size="35" value="<?php echo $poll['b1']?>">
        </div>
      </div>
      
            <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> B1 RAZONES </label></div>
        <div class="col-md-6">
          <input type="text" name="b1_razones" size="35" value="<?php echo $poll['b1_razones']?>">
        </div>
      </div>
      
                  <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> B2</label></div>
        <div class="col-md-6">
          <input type="text" name="b2" size="35" value="<?php echo $poll['b2']?>">
        </div>
      </div>
      
                  <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> B2 RAZONES </label></div>
        <div class="col-md-6">
          <input type="text" name="b2_razones" size="35" value="<?php echo $poll['b2_razones']?>">
        </div>
      </div>
      
                        <div class="row">
      <div class="col-md-6" >  <label for="exampleInputEmail1"> K1 </label></div>
        <div class="col-md-6">
          <input type="text" name="k1" size="35" value="<?php echo $poll['k1']?>">
        </div>
      </div>
      
                        <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> K2 </label></div>
        <div class="col-md-6">
          <input type="text" name="k2" size="35" value="<?php echo $poll['k2']?>">
        </div>
      </div>
      
                              <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> Nombre </label></div>
        <div class="col-md-6">
          <input type="text" name="nombre" size="35" value="<?php echo $poll['nombre']?>">
        </div>
      </div>
      
                              <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> Genero </label></div>
        <div class="col-md-10">
           <select id="genero" class="form-control" name="genero" value="<?php echo $poll['genero']?>" >
                          <option value="2"> Masculino </option>
                          <option value="1"> Femenino </option>
          </select>
        </div>
      </div>
      
                              <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> Edad </label></div>
        <div class="col-md-6">
          <input type="text" name="edad" size="35" value="<?php echo $poll['edad']?>">
        </div>
      </div>
      
                              <div class="row">
      <div class="col-md-6" >  <label for="exampleInputEmail1"> Telefono </label></div>
        <div class="col-md-6">
          <input type="text" name="telefono" size="35" value="<?php echo $poll['telefono']?>">
        </div>
      </div>
      
                                    <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> Email </label></div>
        <div class="col-md-6">
          <input type="text" name="email" size="35" value="<?php echo $poll['email']?>">
        </div>
      </div>
      
                                          <div class="row">
      <div class="col-md-6" >  <label for="exampleInputEmail1"> Sincronizada (Aparece en hoja de evaluaciones) </label></div>
        <div class="col-md-6">
          <input type="text" name="synchronized" size="35" value="<?php echo $poll['synchronized']?>">
        </div>
      </div>
      
                                                <div class="row">
       <div class="col-md-6" > <label for="exampleInputEmail1"> Notificada (Se notificó via Email en tiempo real) </label></div>
        <div class="col-md-6">
          <input type="text" name="notified" size="35" value="<?php echo $poll['notified']?>">
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <input type="submit" value="Guardar Encuesta">
        </div>
      </div>
    </form>

    </div><!-- /.container -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script>
    $('#mes').val("<?php echo $poll['mes']; ?>");
    $('#anio').val("<?php echo $poll['periodo']; ?>");
    $('#genero').val("<?php echo $poll['genero']; ?>");
    $('#pdventa').val("<?php echo $poll['c_costo']; ?>");
    </script>
  </body>
</html>
 
