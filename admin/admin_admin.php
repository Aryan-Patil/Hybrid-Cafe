<?php include('partials/admin_head.php'); ?>
<?php include('partials/admin_navbar.php');  ?>
<section class="admin_update">
        <h1 class="h1">Admin</h1>
        <form class="order_form">
            <a style="margin: 20px;" class="btn btn-primary" href="./forms/admin_addadmin.php">Add Admin</a>
<br>
            <?php
    if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    if(isset($_SESSION['delete'])){
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }
    ?>
    <br>
    <br>
            <table class="table">
                <tr>
                    <th>Sr no.</th>
                    <th>Name</th>
                    <th>username</th>
                    <th>Delete</th>
                </tr>
                <?php
                $sn = 1;
    $sql = "SELECT * FROM admin_sec";
    $res = mysqli_query($conn,$sql);
    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count>0) {
            while ($rows=mysqli_fetch_assoc($res)) {
                $id = $rows['id'];
                $full_name = $rows['full_name'];
                $username = $rows['username'];
                ?>
                <tr>
                    <th><?php echo $sn++ ?></th>
                    <th><?php echo $full_name ?></th>
                    <th><?php echo $username ?></th>
                    <th><a href="<?php echo SITEURL; ?>admin/partials/delete_admin.php?id=<?php echo$id; ?>" class="btn btn-danger">Delete Admin</a></th>
                </tr>
                <?php
            }
        }
        else{

        }
    }
    ?>
                
            </table>
        </form>
    </section>
<?php include('partials/admin_footer.php'); ?>