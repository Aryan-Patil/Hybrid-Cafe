<?php include('config/connection.php'); ?>
<?php
$id = $_GET['id'];
$sql = "DELETE FROM admin_sec WHERE id=$id";
$res = mysqli_query($conn,$sql);
if ($res== true) {
    $_SESSION['delete']="Admin Deleted Successfully";
    header('location:'.SITEURL.'admin/admin_admin.php');
}
else {
    $_SESSION['delete']="Failed To Delete Admin. Try Again Later.";
    header('location:'.SITEURL.'admin/admin_admin.php');
}