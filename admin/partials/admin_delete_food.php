<?php include('config/connection.php'); ?>
<?php
if (isset($_GET['id']) AND isset($_GET['image_path'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_path'];
    if ($image_name!="") {
        $path = "../images/".$image_name;
        unlink($path);
    }

$sql = "DELETE FROM tbl_order WHERE id=$id";
$res = mysqli_query($conn,$sql);

if ($res== true) {
    
    $_SESSION['delete']="Food Deleted Successfully";
    header('location:'.SITEURL.'admin/admin_changes.php');
}
else {
    $_SESSION['delete']="Failed To Delete Food. Try Again Later.";
    header('location:'.SITEURL.'admin/admin_changes.php');
}
}
?>