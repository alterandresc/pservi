<?php
session_start();
unset($_SESSION['registered']);
header("Location: ../login.php"); 
?>
