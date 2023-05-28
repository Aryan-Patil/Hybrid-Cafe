<div style="    max-width: 1000px;
    max-height: 400px;" >
  <canvas id="myCharta"></canvas>
<?php 
$b = 0;
if ($month%2==0) {
    if ($month==2) {
    if( (0 == $year % 4) and (0 != $year % 100) or (0 == $year % 400) )  {
        $lastdate=29;
    }
    else {
        $lastdate=28;
    }
 }else {
    $lastdate=30;
 }
}else {
    $lastdate=31;
}
for ($a=1; $a <=$lastdate; $a++) {
    $bsum4 = 0;
    $mom[$b]= $a;
    $b++;
    $sql4= "SELECT * FROM `costumer_details` WHERE DAY(date)=$a AND MONTH(date)=$month AND Year(date)=$year";
$res4 = mysqli_query($conn,$sql4);
$count4 = mysqli_num_rows($res4);
$sn4 = 0;
if ($count4>0) {
    
    while ($row4=mysqli_fetch_assoc($res4)) {
        $sn++;
        $id4 = $row4['id'];
        $sql24 = "SELECT * FROM `order_details` WHERE costumer_id='$id4'";
$res24 = mysqli_query($conn,$sql24);
$count24 = mysqli_num_rows($res24);
$sum4 =0;
    if ($count24>0) {
            while ($rowe4=mysqli_fetch_assoc($res24)) {
                $quantity4 = $rowe4['quantity'];
                $foodid4= $rowe4['food_id'];
                $sql34 = "SELECT * FROM `tbl_order` WHERE id='$foodid4'";
            $res34 = mysqli_query($conn,$sql34);
            $rowe4=mysqli_fetch_assoc($res34);
            $price4 = $rowe4['price'];
            $aq4=$quantity4*$price4;
             $sum4= $sum4 + $aq4;
                }
        }

        $bsum4 = $bsum4+$sum4;
    }
}
$amount4[]=$bsum4;
}

// for ($k=0; $k <$lastdate; $k++) { 
//     echo $mom[$k];
//     echo $amount4[$k];
// }

 ?>



<script>

const labels = <?php echo json_encode($mom); ?>;
const data = {
  labels: labels,
  datasets: [{
    label: 'Monthly Income generated',
    data: <?php echo json_encode($amount4); ?>,
    fill: false,
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.1
  }]
};
const config2 = {
  type: 'line',
  data: data,
};

const myCharta = new Chart(
  document.getElementById('myCharta'),
  config2
);
</script>