<?php

session_start();
if (!isset($_SESSION['n-user'])) {
	header("location:login.php");
}

?> 