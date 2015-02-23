<?php
include('_configurar/config.php');
session_start();


if(!isset($_SESSION['registered']) || !($_SESSION['registered'] == true))
{
	header("Location: login.php");
}

//$user_check=$_SESSION['login_user'];

//$ses_sql=mysql_query("select usuario_email,nivel from dt_usuarios_externos where usuario_email='$user_check' ");

//$row=mysql_fetch_array($ses_sql);

//$login_session=$row['usuario_email'];
//$login_nivel=$row['nivel'];


//if(!isset($login_session))
//{
//	header("Location: login.php");
//}
//unset($login_session);
?>
