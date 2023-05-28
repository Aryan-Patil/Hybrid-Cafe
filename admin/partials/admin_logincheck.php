<?php
if (!isset($_SESSION['user'])) {
    $_SESSION['no-login-message'] = "<div style='color:red;'>Please login to acess Admin Panel.</div>";
    header('location:'.SITEURL.'admin/adminlogin.php');
}
?>