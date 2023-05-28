<?php include('admin/partials/config/connection.php'); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="order.css">
    <title>Hybrid Cafe</title>
</head>

<body>
    
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand"><img src="./images/Logo.png" class="nav_img" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img src="./images/Logo.png" class="nav_img_2"
                            alt=""></h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link " href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="order.php">Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./admin/adminlogin.php">Admin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <form method="POST" class="row order_form g-3">
        <?php
    if (isset($_SESSION['placed'])) {
        echo $_SESSION['placed'];
        unset($_SESSION['placed']);
    }
    ?>
    
    <br>
    <h1>Costumer Details</h1>
    
        <div class="row">
        <div style="margin-bottom:10px;" class="col-md-6">
            <label for="inputname" class="form-label">Name :</label>
            <input type="text" name="name" class="form-control" placeholder="Name">
        </div>
        <div style="margin-bottom:10px;" class="col-md-6">
            <label for="inputphone" class="form-label">Contact no. :</label>
            <input type="number" name="contact" min="1000000000"max="9999999999" class="form-control" placeholder="Contact no.">
        </div>
        <div style="margin-bottom:20px;" class="col-md-3">
            <label for="inputtableno" class="form-label">Table No.</label>
            <select class="form-select" name="table_no"  aria-label="Default select example">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
        </div>
        <h3>Menu</h3>
        <input type="text" name3="" id="myInput" style="width:300px;margin-top:15px;margin-bottom:20px;" placeholder="Name of food item" onkeyup="myFunction()">
        <br>
        <table id="myTable" class="table">
            <tr>
                <th>Sr no.</th>
                <th>Name</th>
                <th>Image</th>
                <th>price(₹)</th>
                <th>Quantity</th>
            </tr>
            <?php
                $sn = 1;
    $sql = "SELECT * FROM tbl_order WHERE active='Yes'";
    
    $res = mysqli_query($conn,$sql);
    if ($res == true) {
        $count = mysqli_num_rows($res);
        $foodid = array();
        $data = array();
        if ($count>0) {
            while ($rows=mysqli_fetch_assoc($res)) {
                
                $id = $rows['id'];
                $food_name = $rows['title'];
                $image_path = $rows['image_path'];
                $price = $rows['price'];
                $active = $rows['active'];
                
                ?>
                <input type="hidden" name="foodid[]" value="<?php echo $id; ?>" >
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $food_name; ?></td>
                    <td><?php if ($image_path!="") {
                                                ?>
                                                <img style="max-width:100px;" src="<?php echo SITEURL;?>admin/images/<?php echo $image_path; ?>" alt="">
                                                <?php
                                            }
                                            else {
                                                echo "Image not available";
                                            }
                                            ?></td>
                    <td><?php echo $price; ?></td>
                    <td><div class="form_group" ><input type="number" value="0" name="quantity[]" class="prc"  min="0" max="20"></div></td>
                </tr>
                <?php
            }
            
        }
    }
    ?>
        </table>
        
        <br>
        <div class="col-12">
        <input type="submit" class="btn btn-primary" name="submit" value="Place Order">
          </div>
    </form>
    <?php
    if (isset($_POST['submit'])) 
    {
        $data= $_POST['quantity'];
        $foodid= $_POST['foodid'];
        $name = $_POST['name'];
        $contact = $_POST['contact'];
            
        $table_no = $_POST['table_no'];
        $date = date("Y-m-d");
        $sum =0;
        for ($i=0; $i < count($data); $i++) { 
                $sum = $sum + $data[$i];
        }
        if ($sum==0) {
            $_SESSION['placed'] = "<div style='color:red;'>Please Order Something</div>";
            header("location:".SITEURL.'order.php');
        }
        else {
           $sql = "INSERT INTO costumer_details (table_no,name,contact,date) VALUES ($table_no,'$name',$contact,'$date')";
 
           $res =  mysqli_query($conn,$sql);
 
           if ($res==true) {
            //    echo "jh";
            $sql2 = "SELECT * FROM costumer_details WHERE name='$name' AND table_no='$table_no' AND contact='$contact' AND date='$date'";
            $res2 = mysqli_query($conn,$sql2);
            $rows2=mysqli_fetch_assoc($res2);
            $id2 = $rows2['id'];
            // echo $id2;
            for ($i=0; $i <count($data); $i++) { 
                // echo "hi";
                if ($data[$i]!=0) {
                    // echo "hig";
                    $sql3 = "INSERT INTO order_details (costumer_id,food_id,quantity) VALUES ('$id2','$foodid[$i]','$data[$i]')";
                    $res3 =  mysqli_query($conn,$sql3);
                }
            }
           }
           


           $_SESSION['placed'] = "<div style='color:green;'>Order placed</div>
           <a href='order_display.php?id=$id2' style='width:100px;margin:10px;' class='btn btn-dark'>View Bill</a>
           ";
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
    <script src="search.js"></script>
    <script>
        
    </script>
</body>

</html>
