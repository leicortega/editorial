<?php 

session_start();

unset($_SESSION['rol']);
unset($_SESSION['user']);
unset($_SESSION['n-user']);

header("location:./admin/login.php");

?>