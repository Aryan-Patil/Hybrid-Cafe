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
    <?php
    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_order WHERE id=$id";
        $res = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($res);
        if ($count==1) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $image_path = $row['image_path'];
            $discription = $row['discription'];
            $price = $row['price'];
            $featured = $row['featured'];
            $active = $row['active'];
        }
        else {
            $_SESSION['no-food-found'] = "<div style='color:red;'>Food not found</div>";
            header('location:'.SITEURL.'admin/admin_changes.php');
        }
    }
    else 
    {
        header('location:'.SITEURL.'admin/admin_changes.php');

    }
    ?>
  <form class="order_form" method="POST" enctype="multipart/form-data">
    <h1 class="h1">Add Food</h1>
        <div class="col-md-6">
            <label for="inputname" class="form-label">Name of food :</label>
            <input type="text" name="food_name" class="form-control" value="<?php echo $title; ?>">
        </div>
        <br>
        <div class="col-md-6">
            <label for="inputphone" class="form-label">Discription</label>
            <textarea type="text" id="exampleFormControlTextarea1" name="discription" class="form-control" rows="3"><?php echo $discription; ?></textarea>
        </div>
        <br>
        <div class="col-md-4">
            <label for="inputphone" class="form-label">Price(₹)</label>
            <input type="number" name="price" class="form-control" value="<?php echo $price; ?>">
        </div>
        <br>
        <div class="col-md-6">
            <label for="inputphone" class="form-label">Last Image inserted</label>
            <br>
            <label for="inputphone" class="text-muted form-label"><?php
            if ($image_path!="") {
                
                    ?>
                    <img style="max-width:100px;" src="<?php echo SITEURL;?>admin/images/<?php echo $image_path; ?>" alt="">
                    <?php
                }
                else {
                    echo "Image not added";
            }
            ?></label>
            <input type="hidden" name="current_image" value="<?php echo $image_path; ?>">
    </div>
        <br>
    <div class="col-md-6">
            <label for="inputphone" class="form-label">Insert Image/ Change Image</label>
            <input type="file" name="image">
    </div>
    <br>
    <div class="row g-4">
        <div class="col-md-4">
            <label for="featured" class="form-label">Featured</label>
    <select name="featured" id="featured" class="form-select">
      <option value="Yes"<?php if ($featured=="Yes") {
          echo "selected";
      } ?> >Yes</option>
      <option value="No" <?php
      if ($featured=="No") {
          echo"selected";
      }?> >No</option>
    </select>
        </div>
        <div class="col-md-4">
        <label for="active" class="form-label">Active</label>
        <select name="active" id="active" class="form-select">
      <option value="Yes"<?php if ($active=="Yes") {
          echo "selected";
      } ?> >Yes</option>
      <option value="No" <?php
      if ($active=="No") {
          echo"selected";
      }?> >No</option>
    </select>
        </div>
    </div>
    <br>
    <div class="row g-4">
        <div class="col-md-4">
            <a href="../admin_changes.php" class="btn btn-primary">Back</a>
        </div>
        <div class="col-md-4">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
           <input type="submit" class="btn btn-primary" name="submit" value="Update Food">
        </div>        
    </div>
  </form>
  <?php
if (isset($_POST['submit'])) 
{
     $id = $_POST['id'];
     $food_name = $_POST['food_name'];
     $discription = $_POST['discription'];
     $price = $_POST['price'];
     $featured = $_POST['featured'];
     $active = $_POST['active'];
     $current_image = $_POST['current_image'];


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
         $path = "../images/".$current_image;
        unlink($path);
        }
        else {
            $image_name = $current_image;
        }
     }
     else {
         $image_name = $current_image;
     }


    $sql2 = "UPDATE tbl_order SET title = '$food_name', image_path = '$image_name', discription = '$discription', price = '$price', featured = '$featured', active = '$active' WHERE id=$id ";

    $res2 = mysqli_query($conn,$sql2);

    if($res2==TRUE){
        $_SESSION['update'] = "food Updated successfully";
        header("location:".SITEURL.'admin/admin_changes.php');
    }
    else {
        $_SESSION['update'] = "Failed to update food";
        header("location:".SITEURL.'admin/admin_changes.php');
    }
}
?>
  <?php include('partials/admin_footer.php'); ?>
 

