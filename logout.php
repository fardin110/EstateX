<?php
session_start(); 


$_SESSION = array();


session_destroy();

// Redirect to the login page or any other page after logout
header("location: login.php");
exit;
?>
