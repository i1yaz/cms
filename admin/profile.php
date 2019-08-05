<?php include "includes/admin_header.php" ?>


<?php 
if (!isset($_SESSION['role'])) {

    header("Location: ../index.php");
}
?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome To Admin
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" value="<?php echo $the_user_firstname; ?>" class="form-control" name="user_firstname" required  > 
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" value="<?php echo $the_user_lastname; ?>" class="form-control" name="user_lastname" required >
    </div>

    <div class="form-group">
        <select class="" name="user_role" id="">
        <option value="admin"><?php echo $the_user_role; ?></option>
        <?php 
        if ($the_user_role == 'admin') {
            echo "<option value='subscriber'>subscriber</option>";
        }else {
            echo "<option value='admin'>admin</option>";
        }
        ?>

        </select>
        
    </div>
    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div> -->
    <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" value="<?php echo $the_user_name; ?>" class="form-control" name="user_name" required>
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" value="<?php echo $the_user_email ?>" class="form-control" name="user_email" required>
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" value="<?php echo $the_user_password ?>" class="form-control" name="user_password" required>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" Value="Sign Up">
    </div>

</form>
                  
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php include "includes/admin_footer.php" ?>