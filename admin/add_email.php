<?php 

	require_once('../core/conection.php');
	
	$email = $_POST["email_address"];
	$type = $_POST["type"];
	$value = $_POST["value"];
	
	
	$query= sprintf("INSERT INTO `synapsis_tracking_popsy`.`users_to_notify` (`id`, `email`, `type`, `value`) VALUES (NULL, '%s','%s','%s');",$email, $type, $value);
	
	$data = mysql_query($query);

	
	//header( 'Location: edit_mails.php' ) ;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Popsy</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../vendor/css/starter-template.css" rel="stylesheet">
    
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  </head>
<body>
  <h1> Agregar Email </h1>
	<div id="messages">
		

	  <div class="alert alert-success">
	    <p>
	      <h2>
		El correo fue añadido satisfactoriamente
	      </h2>
	    </p>
	  </div>
	  <a href="edit_all.php"> << Volver</a>
	</div>
	
	<div class="container ad-container" id="show_section">

	</div>
	<div id="add_section">

	</div>
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html> 
