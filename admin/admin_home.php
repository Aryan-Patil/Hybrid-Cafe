<?php include('partials/admin_head.php'); ?>
<?php include('partials/admin_navbar.php');  ?>
<?php
    if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    
    ?>

<?php 
   $sql = "SELECT * FROM `costumer_details` WHERE status='Yes'";
   $res = mysqli_query($conn,$sql);
   $count = mysqli_num_rows($res);
   $av = 0;
   if ($count>0) {
       
       while ($row=mysqli_fetch_assoc($res)) {
         $av++;
       }
      }

      $sql2 = "SELECT * FROM `order_details`";
      $res2 = mysqli_query($conn,$sql2);
      $count2 = mysqli_num_rows($res2);
      $ac= 0;
      if ($count2>0) {
          
        while($row2=mysqli_fetch_assoc($res2)) {
          $quantity = $row2['quantity'];
          $ac = $ac + $quantity;
        }
         }
?>
<br>
<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total no. of Costumer</h5>
        <p class="card-text"><?php echo $av; ?></p>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total dishes served</h5>
        <p class="card-text"><?php echo $ac; ?></p>
      </div>
    </div>
  </div>
</div>
<br>
</div>
    <div style="    max-width: 1000px;
    max-height: 800px;" >
  <canvas id="myChart"></canvas>
</div>
    <?php 
$date=date("Y");
$j=0;
for ($i=($date-2); $i <($date+3); $i++) {
    $bsum = 0;
    $yearn[$j]= $i;
    $j++;
    $sql = "SELECT * FROM `costumer_details` WHERE YEAR(date)='$i'";
$res = mysqli_query($conn,$sql);
$count = mysqli_num_rows($res);
$sn = 0;
if ($count>0) {
    
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

        $bsum = $bsum+$sum;
    }
}
$amount[]=$bsum;
}
// for ($k=0; $k <($j+1); $k++) { 
//     echo $yearn[$k];
//     echo $amount[$k];
// }

?>


<script>
const labels = <?php echo json_encode($yearn); ?>;
const data = {
  labels: labels,
  datasets: [{
    label: 'Yearly Income Generated',
    data: <?php echo json_encode($amount); ?>,
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};
const config = {
  type: 'bar',
  data: data,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
};
const myChart = new Chart(
  document.getElementById('myChart'),
  config
);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="loader.js"></script>

    </body>
</html>