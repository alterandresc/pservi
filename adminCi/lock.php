<?php
session_start();
if(!isset($_SESSION['registered']) || !($_SESSION['registered'] == true))
{
  header("Location: ../login.php?referer=adminCi");
}
?>
