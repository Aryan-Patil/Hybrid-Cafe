<?php include('partials/admin_head.php'); ?>
<?php include('partials/admin_navbar.php');  ?>
<section class="admin_order">
        <h1 class="h1">Check Order </h1>
        <?php
    if (isset($_SESSION['completed'])) {
        echo $_SESSION['Completed'];
        unset($_SESSION['Completed']);
    }
    ?>
                <?php
                $sql = "SELECT * FROM `costumer_details` WHERE status='No'";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                $sn =1;
                $sp=1;
                    if ($count>0) {
                        while ($row=mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $date = $row['date'];
                            $table_no = $row['table_no'];
                          ?>
                          <form method="POST" class="order_form">
                          
                          <div class="row g-3">
                          <div class="col-md-2">Date :</div>
                          <div class="col-md-2"> <?php echo $date; ?></div>
                        </div>
                        <div class="row g-3">
                          <div class="col-md-2">Name :</div>
                          <div class="col-md-2"> <?php echo $name; ?></div>
                          </div>
                          <div class="row g-3">
                          <div class="col-md-2">Table no. :</div>
                          <div class="col-md-2"> <?php echo $table_no; ?></div>
                        </div>
                        <br>
            <table class="table">
                <tr>
                    <th>Sr no.</th>
                    <th>Name</th>
                    <th>Quantity</th>
                </tr>
                <?php
                $sql2 = "SELECT * FROM `order_details` WHERE costumer_id=$id";
                $res2 = mysqli_query($conn,$sql2);
                $count2 = mysqli_num_rows($res2);
                if ($count>0) {
                while ($row2=mysqli_fetch_assoc($res2)) {
                    $foodid = $row2['food_id'];
                    $quantity = $row2['quantity'];
                    $id1 = $row2['id'];
                    $sql3="SELECT * FROM `tbl_order` WHERE id=$foodid";
                    $res3 = mysqli_query($conn,$sql3);
                    $row3=mysqli_fetch_assoc($res3);
                    $food_name=$row3['title'];
                    
                
                ?>
                <tr>
                <th><?php echo $sn; ?></th>
                <th><?php echo $food_name; ?></th>
                <th><?php echo $quantity; ?></th>
                </tr>
            
                          <?php 
                          $sn++; 
                          }
                        }
                          ?>
                          </table>
                          <br>

            <input name="ordercompleted" class="btn btn-primary" type="submit" value="Order Completed" >
            <input name="orderdelete" class="btn btn-danger" type="submit" value="Delete Order" >
            <input type="hidden" name="id1" value="<?php echo $id; ?>">
            <?php
            $ap=$_POST['ordercompleted'];
            
            if (isset($ap)) {
                $ax=$_POST['id1'];

                $sql4 ="UPDATE `costumer_details` SET status='Yes' WHERE id=$ax";
                $res4 = mysqli_query($conn,$sql4);
                
                if ($res4==true) {
                    $_SESSION['completed'] = "Order Completed successfully";
        header("location:".SITEURL.'admin/admin_order.php');
                }
            }

            if (isset($_POST['orderdelete'])) {
                $ax = $_POST['id1'];
                $sql5 ="DELETE FROM `costumer_details` WHERE id=$ax";
                $res5 = mysqli_query($conn,$sql5);
                
                if ($res5==true) {
                    $sql6 ="DELETE FROM `order_details` WHERE costumer_id=$ax";
                $res6 = mysqli_query($conn,$sql6);
                if ($res6==true) {
                    $_SESSION['completed'] = "Order deleted successfully";
                     header("location:".SITEURL.'admin/admin_order.php');
                      }
                }
            }

            $sp++; 

            ?>
        </form>
                          <?php
                }
                
            }
                ?>
            
                
            
    </section>
<?php include('partials/admin_footer.php'); ?>