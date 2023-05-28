<?php
session_start();    
define('SITEURL','http://localhost/hybrid_cafe/');
define('LOCALHOST','localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD','');
define('DB_NAME','hotel-management');
$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die(mysqli_error());
?>