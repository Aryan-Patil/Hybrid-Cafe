<?php include('partials/admin_head.php'); ?>
<?php include('partials/admin_navbar.php');  ?>
<div style="margin:50px;margin-left:80px;margin-right:80px;">
    <h3>Yearly Analysis</h3>
    <br>
    <form action="" method="POST">
        <div class="col" style="width:300px;">
    <label for="inputyear" class="form-label">Year</label>
            <select class="form-select" name="year"  aria-label="Default select example">
                <?php
                $date=date('Y');
                for ($i=2021; $i <=$date; $i++) { 
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php
                }
                ?>
              </select>
              </div>
              <br>
              <input type="submit" name="submit" value="Search">
              <a href="admin_analysis.php" style="margin-left:70px;" class="btn btn-primary">Back</a>
    </form>
<?php 
if (isset($_POST['submit'])) {
    $year=$_POST['year'];
    $date=date("Y");
$sql = "SELECT * FROM `costumer_details` WHERE YEAR(date)='$year'";
$res = mysqli_query($conn,$sql);
$count = mysqli_num_rows($res);
?>
<br>
<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" style="background-color:rgb(232, 232, 232);"  type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        Costumer Details
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
<table class="table">
                <tr>
                    <th>Sr no.</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>total Price</th>
                </tr>
<?php
$sn = 0;
if ($count>0) {
    $bsum = 0;
    while ($row=mysqli_fetch_assoc($res)) {
        $sn++;
        $id = $row['id'];
        $number = $row['contact'];
        $name = $row['name'];



        $sql2 = "SELECT * FROM `order_details` WHERE costumer_id='$id'";
$res2 = mysqli_query($conn,$sql2);
$count2 = mysqli_num_rows($res2);
$sum =0;
    if ($count2>0) {
            while ($rowe=mysqli_fetch_assoc($res2)) {
                $quantity = $rowe['quantity'];
                $foodid = $rowe['food_id'];
                $sql3 = "SELECT * FROM `tbl_order` WHERE id='$foodid'";
            $res3 = mysqli_query($conn,$sql3);
            $rowe=mysqli_fetch_assoc($res3);
            $price = $rowe['price'];
            $aq=$quantity*$price;
             $sum= $sum + $aq;
             
                }
        }

        ?>
        <tr>
            <td><?php echo $sn; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $number; ?></td>
            <td><?php echo $sum; ?></td>
    </tr>
    
        <?php
        $bsum = $bsum+$sum;
    }
 
}
?>
</table>
</div>
    </div>
</div>
  <br>
  <?php include('pa_month.php'); ?>
  <br>
  <div > Total no. of costumer: <?php echo $sn/2;?></div>
  <div class="row">
  <div class="col" >Total Income Generated: <?php echo $bsum;?> Rs</div>
  <div class="col" >Average Income Generated: <?php echo number_format($bsum/($sn/2), 2);?> Rs</div>
  </div>
<br>
<div class="row">
                    <h6>No. of intem served</h6>
<?php


        $sql5 = "SELECT * FROM `tbl_order` WHERE active='Yes'";
        $res5 = mysqli_query($conn,$sql5);
        $count5 = mysqli_num_rows($res5);
        
        if ($count5>0) {
            while ($row5=mysqli_fetch_assoc($res5)) {
                
                $id5 = $row5['id'];
                $name5 = $row5['title'];
                $dsum = 0;
                $sql7 = "SELECT * FROM `costumer_details` WHERE YEAR(date)='$year'";
                $res7 = mysqli_query($conn,$sql7);
                $count7 = mysqli_num_rows($res7);
                if ($count7>0) {
                    while ($row7=mysqli_fetch_assoc($res7)) {
                        $id7 = $row7['id'];
                        $sql6 = "SELECT *FROM `order_details` WHERE food_id=$id5 AND costumer_id=$id7";
                        $res6 = mysqli_query($conn,$sql6);
                        $count6 = mysqli_num_rows($res6);
                        if ($count6>0) {
                            while ($row7=mysqli_fetch_assoc($res6)) {
                                $quan=$row7['quantity'];
                                $dsum= $dsum+$quan;
                            }
                        }
                    }
                }
                ?>
                <div class="col"><?php echo $name5; ?>: <?php echo $dsum; ?></div>
                
                <?php
            }
        }
    }
?>
</div>
</div>
    </div>
</div>
<?php include('partials/admin_footer.php'); ?>