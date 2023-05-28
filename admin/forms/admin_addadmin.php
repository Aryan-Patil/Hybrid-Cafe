<?php include('../partials/config/connection.php') ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./form.css">
    <title>Hybrid Cafe</title>
</head>

<body>
<form class="order_form" method="POST" action="">
    <h1>Add Admin</h1>
        <div class="col-md-6">
            <label for="inputname" class="form-label">Name :</label>
            <input type="text" name="full_name" class="form-control" placeholder="Name">
        </div>

        <div class="col-md-6">
            <label for="inputphone" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username">
        </div>

    <div class="col-md-6">
            <label for="inputphone" class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
    </div>
    <br>
    <div class="row g-4">
        <div class="col-md-4">
            <a href="../admin_admin.php" class="btn btn-primary">Back</a>
        </div>
        <div class="col-md-4">
           <input type="submit" class="btn btn-primary" name="submit" value="Add Admin">
        </div>        
    </div>
        
</form>
<?php include('partials/admin_footer.php'); ?>
<?php
if (isset($_POST['submit'])) 
{
     $full_name = $_POST['full_name'];
     $username = $_POST['username'];
     $password = md5($_POST['password']);

    $sql = "INSERT INTO admin_sec SET
    full_name = '$full_name',
    username = '$username',
    password = '$password'
    ";
    
    $res = mysqli_query($conn,$sql) or die(mysqli_error());
    if($res==TRUE){
        $_SESSION['add'] = "Admin Added successfully";
        header("location:".SITEURL.'admin/admin_admin.php');
    }
    else {
        $_SESSION['add'] = "Admin Failed successfully";
        header("location:".SITEURL.'admin/admin_admin.php');
    }
}
?>