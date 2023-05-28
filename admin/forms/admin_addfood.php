<?php include('../partials/config/connection.php') ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="form.css">
  <title>Admin Login</title>
</head>

<body>
  <form class="order_form" method="POST" enctype="multipart/form-data">
    <h1 class="h1">Add Food</h1>
        <div class="col-md-6">
            <label for="inputname" class="form-label">Name of food :</label>
            <input type="text" name="food_name" class="form-control" placeholder="Name">
        </div>
        <br>
        <div class="col-md-6">
            <label for="inputphone" class="form-label">Discription</label>
            <textarea type="text" id="exampleFormControlTextarea1" name="discription" class="form-control" rows="3"></textarea>
        </div>
        <br>
        <div class="col-md-4">
            <label for="inputphone" class="form-label">Price(₹)</label>
            <input type="number" name="price" class="form-control" placeholder="Price">
        </div>
        <br>
    <div class="col-md-6">
            <label for="inputphone" class="form-label">Insert Image</label>
            <input type="file" name="image">
    </div>
    <br>
    <div class="row g-4">
        <div class="col-md-4">
            <label for="featured" class="form-label">Featured</label>
    <select name="featured" id="featured" class="form-select">
      <option value="Yes" >Yes</option>
      <option value="No" selected>No</option>
    </select>
        </div>
        <div class="col-md-4">
            <label for="active" class="form-label">Active</label>
            <select name="active"  id="active" class="form-select">
                <option value="Yes" selected>Yes</option>
                <option value="No">No</option>
              </select>
        </div>
    </div>
    <br>
    <div class="row g-4">
        <div class="col-md-4">
            <a href="../admin_changes.php" class="btn btn-primary">Back</a>
        </div>
        <div class="col-md-4">
           <input type="submit" class="btn btn-primary" name="submit" value="Add Food">
        </div>        
    </div>
  </form>

  <?php include('partials/admin_footer.php'); ?>
<?php
if (isset($_POST['submit'])) 
{
    
     $food_name = $_POST['food_name'];
     $discription = $_POST['discription'];
     $price = $_POST['price'];
     $featured = $_POST['featured'];
     $active = $_POST['active'];

    //  print_r($_FILES['image']['tmp_name']);
     if(isset($_FILES['image']['name'])){
         $image_name = $_FILES['image']['name'];
         if ($image_name!="") {
         
            $source_path = $_FILES['image']['tmp_name'];
            $ext = end(explode('.',$image_name));
            $image_name = "Food".rand(0000,9999).'.'.$ext;
            $destination_path = "../images/". $image_name;
            $upload = move_uploaded_file($source_path,$destination_path);
            if($upload==false){
                $_SESSION['upload']= "<div style='color:red;'>Failed to upload Image.</div>";
                header("location:".SITEURL.'admin/admin_changes.php');
                die();
         }
        }
     }
     else {
         $image_name = "";
     }


    $sql = "INSERT INTO tbl_order SET title = '$food_name', image_path = '$image_name', discription = '$discription', price = '$price', featured = '$featured', active = '$active' ";

    $res = mysqli_query($conn,$sql);

    if($res==TRUE){
        $_SESSION['add'] = "food Added successfully";
        header("location:".SITEURL.'admin/admin_changes.php');
    }
    else {
        $_SESSION['add'] = "Failed to add food";
        header("location:".SITEURL.'admin/admin_changes.php');
    }
}
?>