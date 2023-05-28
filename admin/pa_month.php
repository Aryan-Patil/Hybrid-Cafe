<div style="    max-width: 1000px;
    max-height: 600px;" >
  <canvas id="myCharta"></canvas>
<?php 
$b = 0;
for ($a=1; $a <13; $a++) {
    $bsum4 = 0;
    $mom[$b]= $a;
    $b++;
    $sql4= "SELECT * FROM `costumer_details` WHERE MONTH(date)=$a AND YEAR(date)=$year";
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
// for ($k=0; $k <12; $k++) { 
//     echo $mom[$k];
//     echo $amount4[$k];
// }

 ?>



<script>

const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
  ];
const data = {
  labels: labels,
  datasets: [{
    label: <?php echo json_encode($year); ?>,
    data: <?php echo json_encode($amount4); ?>,
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(201, 203, 207, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(201, 203, 207, 0.2)',
'rgba(255, 205, 86, 0.2)',
'rgba(201, 203, 207, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(201, 203, 207, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)',
      'rgba(255, 99, 132, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 159, 64)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(255, 99, 132)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)',
      'rgb(255, 159, 64)'
    ],
    borderWidth: 1
  }]
};
const config2 = {
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

const myCharta = new Chart(
  document.getElementById('myCharta'),
  config2
);
</script>