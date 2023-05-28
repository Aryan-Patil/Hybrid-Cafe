<?php
include('config/connection.php');
session_destroy();

header('location:'.SITEURL.'admin/adminlogin.php');
?>