<?php include('admin/partials/admin_head.php'); ?>
<div class="" style="margin-left:90px;margin-right:90px;margin-top:40px;" >
<div id="invoice">
  


       <?php
       $id23=$_GET['id'];
    // $id23=52;
                $sql = "SELECT * FROM `costumer_details` WHERE id='$id23'";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                $sn =1;
                $sp=1;
                    if ($count>0) {
                        while ($row=mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $date = $row['date'];
                            $contact = $row['contact'];
                            $table_no = $row['table_no'];
                          ?>
                          <form method="POST" class="order_form">
                          <div class="" style="text-align:right;margin-right:30px;">Date :<?php echo $date; ?></div>
                          <img src="images/logo.png"style="width:100px" alt="" srcset="">
  <br>
                        <h2 style="text-align:center;">Invoice</h2>
                        <br>
                        <div class="row">
                          <div class="col">Name : <?php echo $name; ?></div>
                          <div class="col">Contact : <?php echo $contact; ?> </div>
                          <div class="col">Table no. : <?php echo $table_no; ?></div>
                        </div>
                        <br>
            <table class="table">
                <tr>
                    <th>Sr no.</th>
                    <th>Food Name</th>
                    <th>Quantity</th>
                    <th>Total(Rs)</th>
                </tr>
                <?php
                $sql2 = "SELECT * FROM `order_details` WHERE costumer_id=$id";
                $res2 = mysqli_query($conn,$sql2);
                $count2 = mysqli_num_rows($res2);
                $total=0;
                if ($count>0) {
                while ($row2=mysqli_fetch_assoc($res2)) {
                    $foodid = $row2['food_id'];
                    $quantity = $row2['quantity'];
                    $id1 = $row2['id'];
                    $sql3="SELECT * FROM `tbl_order` WHERE id=$foodid";
                    $res3 = mysqli_query($conn,$sql3);
                    $row3=mysqli_fetch_assoc($res3);
                    $food_name=$row3['title'];
                    $food_price = $row3['price'];
                    $price= $food_price*$quantity;
                    $total =$total + $price;
                ?>
                <tr>
                <td><?php echo $sn; ?></td>
                <td><?php echo $food_name; ?></td>
                <td><?php echo $quantity; ?></td>
                <td><?php echo $price; ?></td>
                </tr>
            
                          <?php 
                          $sn++; 
                          }
                        }
                        $sp++; 
                          ?>
                          </table>
                          <br>
                          <h4>TOTAL : <?php echo $total; ?>Rs</h4>
        </form>
                          <?php
                }
                
            }
                ?>
                <br>
                </div>
                <button onclick="generatepdf()"  class="btn btn-primary">Download Invoice</button>
                <a href="index.php"  class="btn btn-primary">Back</a>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
                <script>
                  function generatepdf(){
  const element = document.getElementById('invoice');
  var opt = {
  margin:       1,
  filename:     'invoice.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2 },
  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
};
  html2pdf()
  .set(opt)
  .from(element)
  .save();
}
                </script>
<?php include('admin/partials/admin_footer.php'); ?>