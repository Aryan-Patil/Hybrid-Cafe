<?php include('partials/admin_head.php'); ?>
<?php include('partials/admin_navbar.php');  ?>
<section class="any_changes">
        <h1 class="h1">Any changes</h1>
        <form action="POST" class="order_form">
            <?php
    if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }
    if(isset($_SESSION['update'])){
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
    if(isset($_SESSION['delete'])){
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }
    if(isset($_SESSION['no-food-found'])){
        echo $_SESSION['no-food-found'];
        unset($_SESSION['no-food-found']);
    }
    ?>
    <br>
   
            <a href="./forms/admin_addfood.php" style="margin: 20px;" class="btn btn-primary">Add food</a>
            <br>
            <table class="table">
                <tr>
                    <th>Sr no.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>price(₹)</th>
                    <th>Discription</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Update</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM tbl_order";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    if ($count>0) {
                        while ($row=mysqli_fetch_assoc($res)) {
                            
                            $id = $row['id'];
                            $name = $row['title'];
                            $image_path = $row['image_path'];
                            $price = $row['price'];
                            $discription = $row['discription'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>
                             <tr>
                                <th><?php echo $sn++ ?></th>
                                <th><?php echo $name; ?></th>
                                <th><?php 
                                            if ($image_path!="") {
                                                ?>
                                                <img style="max-width:100px;" src="<?php echo SITEURL;?>admin/images/<?php echo $image_path; ?>" alt="">
                                                <?php
                                            }
                                            else {
                                                echo "Image not added";
                                            }
                                ?></th>
                                <th><?php echo $price; ?></th>
                                <th><?php echo $discription; ?></th>
                                <th><?php echo $featured; ?></th>
                                <th><?php echo $active; ?></th>
                                <th><a href="./forms/admin_updatefood.php?id=<?php echo $id; ?>" class="btn btn-success">Update food</a>
                                    <a href="<?php echo SITEURL; ?>admin/partials/admin_delete_food.php?id=<?php echo $id; ?>&image_path=<?php echo $image_path; ?>" class="btn m-2 btn-danger">Delete food</a></th>
                             </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <td colspan="8" style='color:red;'>No Data Added.</td>
                        <?php
                    }
                    ?>
                    
               
            </table>
        </form>
    </section>
<?php include('partials/admin_footer.php'); ?>