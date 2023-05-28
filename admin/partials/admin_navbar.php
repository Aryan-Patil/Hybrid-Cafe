<?php
include('admin_logincheck.php');
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" ><img style="width: 100px;" src="../images/Logo.png" class="nav_img" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="admin_home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_order.php">Order</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_changes.php">Changes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_analysis.php">Analysis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_admin.php">Admin</a>
        </li>
      </ul>
      <form class="d-flex">
        <a href="./partials/admin_logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="black" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
</svg></a>
      </form>
    </div>
  </div>
</nav>