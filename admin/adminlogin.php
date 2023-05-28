<?php include('partials/admin_head.php'); ?>

<body>
  <form method="POST" class="add_admin login_form">
    <h1 class="h1">ADMIN LOGIN</h1>
    <br>

    <?php
    if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    if (isset($_SESSION['no-login-message'])) {
      echo $_SESSION['no-login-message'];
      unset($_SESSION['no-login-message']);
    }
    ?>

    <br>
    <div class="row g-3">
      <div style="text-align: center;" class="col-md-6">
        <img class="login_img" src="../images/admin.jpg" alt="">
      </div>
      <div class="col-md-6">
        <br>
        <div class="col-md-8">
          <label for="inputphone" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
        <br>
        <div class="col-md-8">
          <label for="inputphone" class="form-label">Password</label>
          <input type="password" placeholder="Password" name="password" class="form-control">
        </div>
        <br>
        <input type="submit" class="btn btn-primary" name="submit" value="login">
        <a href="../index.php" class="btn btn-primary">Back</a>
      </div>
    </div>
  </form>

  <?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
     $sql = "SELECT * FROM admin_sec WHERE username='$username' AND password='$password'";
     
     $result=mysqli_query($conn,$sql);

     if (mysqli_num_rows($result)==1) {
      //  echo "correct";
       $_SESSION['login'] = "<div> Login Successful.</div>";
       $_SESSION['user'] = $username;
       header('location:'.SITEURL.'admin/admin_home.php');
     }
     else{
      //  echo "incorrect";
      $_SESSION['login'] = "<div style='color:red;'> Failed to login. Please check username and password. </div>";
      header('location:'.SITEURL.'admin/adminlogin.php');
     }
    }
  
?>

<?php include('partials/admin_footer.php'); ?>

